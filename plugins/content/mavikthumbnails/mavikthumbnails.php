<?php
/**
 * @package Joomla
 * @subpackage mavikThumbnails 2
 * @copyright 2014 Vitaliy Marenkov
 * @author Vitaliy Marenkov <admin@mavik.com.ua>
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * Plugin automatic replaces big images to thumbnails.
 */
use Plugin\Content\MavikThumbnails\ImgTag;

defined('_JEXEC') or die();

require_once 'imgtag.php';
require_once 'decorators/DecoratorAbstract.php';
jimport('mavik.thumb.generator');

class plgContentMavikThumbnails extends JPlugin
{
    const FOR_CLASS = 1;
    const EXCEPT_CLASS = 2;

    /**
     * Original parameters of plugin
     * 
     * @var JRegistry
     */
    private $originalParams;

    /**
     * @var plgContentMavikThumbnailsImgTag
     */
    public $imgTag;

    /**
     * @var MavikThumbInfo
     */
    public $imageInfo;

    /**
     * Thumbnail generator
     * 
     * @var MavikThumbGenerator
     */
    private $generator;

    /**
     * @var array Array of plgContentMavikThumbnailsDecoratorAbstract
     */
    private $decorators;

    /**
     * @var stdClass
     */
    public $item;

    /**
     * @var JRegistry
     */
    public $itemParams;
    
    /**
     * Ratio for image (for hover and retina)
     * 
     * @var float
     */
    public $ratio;

    /**
     * @var string
     */
    public $context;

    /**
     * @var array
     */
    private $contextParams;

    /**
     * Meta-tag og:image is setted
     * 
     * @var boolean
     */
    public static $ogImageIsSetted = false;

    public function __construct(&$subject, $config = array())
    {
        if (\JFactory::getApplication()->isAdmin()) {
            return false;
        }

        parent::__construct($subject, $config);
        
        $this->initContextParams();
        $this->imgTag = new ImgTag();
        $this->initAddons();

        /**
         * Thumbnail generator
         */
        $generatorParams = $this->getGeneratorParams();
        $this->generator = new MavikThumbGenerator($generatorParams);
    }

    public function onContentPrepare($context, &$item, &$params, $page)
    {
        // Define ID for item. It needs for grouping all images of item.
        if (!isset($item->id)) {
            $item->id = uniqid();
        }
        
        $this->item = $item;
        $this->context = $context;
        $this->itemParams = $params;

        if($this->params->get('context_show')) {
            $item->text = "[&nbsp;<b>$context</b>&nbsp;] ".$item->text;
        }

        if(!empty($this->contextParams)) {
            $this->initParams();
        }

        $decorator = $this->getDecorator();
        $decorator->item();

        $this->addons($context, $item, $params, $page);
        
        // Replace img-tags
        $regex = '#<img\s.*?>#is';
        $item->text = preg_replace_callback($regex, array($this, "imageReplacer"), $item->text);

        $decorator->item();
        return '';
    }
    
    /**
     * Replace img-tag
     * 
     * @param array $matches
     * @return string
     */
    public function imageReplacer(&$matches)
    {   
        // Create ImgTag Object
        $imgStr = is_array($matches) ? $matches[0] : $matches;
        $this->imgTag->parse($imgStr);
        $decorator = $this->getDecorator();
        
        $this->setOgImage();
        
        // Check classes
        $thumbnailsFor = $this->imgTag->getAttribute('data-resize-type') !== null
            ? $this->imgTag->getAttribute('data-resize-type')
            : $this->params->get('thumbnails_for')
        ;
        $class = $this->params->get('class');
        if ( $thumbnailsFor && $class ) {
            $imgClasses = explode(' ', $this->imgTag->getAttribute('class'));
            $myClasses = preg_split('/\W+/', $class);
            $classFind = array_intersect($imgClasses, $myClasses);
            if (
                ($thumbnailsFor == self::FOR_CLASS && !$classFind) ||
                ($thumbnailsFor == self::EXCEPT_CLASS && $classFind)
            ) {
                return $imgStr;
            }
        }
         
        /**
         * Generate thumbnail
         */
        $resizeType = $this->imgTag->getAttribute('data-resize-type');
        if ($resizeType) {
            $this->generator->setResizeType($resizeType);
        }
        
        // Ratio for hover-effect if it needs
        if ( $this->params->get('hover') && $decorator->hoverAllowed() ) {
            $this->ratio = $this->params->get('hover_ratio', 2);
        } else {
            $this->ratio = 1;
        }
        $this->ratio *= JFactory::getApplication()->getUserState('mavikthumbnails.display.ratio', 1);
        
        $this->imageInfo = $this->generator->getThumb(
                $this->imgTag->getAttribute('src'),
                $this->imgTag->getWidth(),
                $this->imgTag->getHeight(),
                $this->imgTag->isSizeInPixels(),
                $this->ratio
        );
        if ($this->imageInfo->thumbnail->path) {
            $this->imgTag->setAttribute('src', $this->imageInfo->thumbnail->url);
            $this->imgTag->setHeight($this->imageInfo->thumbnail->height);
            $this->imgTag->setWidth($this->imageInfo->thumbnail->width);
            //$this->imgTag->setAttribute('onload', "mavikThumbnailsHover(this, {$this->imageInfo->thumbnail->width}, {$this->imageInfo->thumbnail->height}, {$this->imageInfo->thumbnail->realWidth}, {$this->imageInfo->thumbnail->realHeight})");
        }

        // Decorate img-tag
        return $decorator->decorate();
    }

    /**
     * Get decorator for current context
     * 
     * @return Plugin\Content\MavikThumbnails\DecoratorAbstract
     */
    private function getDecorator()
    {
        if (!isset($this->decorators[$this->context])) {
            $path = JPATH_PLUGINS . '/content/mavikthumbnails/decorators/context/' . $this->context . '.php';
            if ($this->params->get('context_processing') && JFile::exists($path)) {
                require_once $path;
                $class = 'Decorator' . str_replace('.', '', str_replace('_', '', ucfirst($this->context)));
            } else {
                $popupType = $this->params->get('popuptype', 'none');
                $class = 'Decorator' . ucfirst($popupType);
                require_once 'decorators/popups/' . $popupType . '/' . $class . '.php';
            }
            $class = 'Plugin\\Content\\MavikThumbnails\\' . $class;
            $this->decorators[$this->context] = new $class($this);
        }

        return $this->decorators[$this->context];
    }

    /**
     * Init addons of pligin
     */
    private function initAddons()
    {
        $path = JPATH_PLUGINS . '/content/mavikthumbnails/addons';
        if (JFolder::exists($path)) {
            $files = JFolder::files($path, '.*\.php$', false, true);
            foreach ($files as $file) {
                require_once $file;
            }
        }
    }

    private function addons($context, &$item, &$params, $page)
    {
        if (class_exists('Plugin\Content\MavikThumbnails\Retina') && $this->params->get('retina')) {
            $retina = new Plugin\Content\MavikThumbnails\Retina($this, $context, $item, $params, $page);
            $retina->process();
        }
                
        if (class_exists('Plugin\Content\MavikThumbnails\Gallery') && $this->params->get('gallery')) {
            $gallery = new Plugin\Content\MavikThumbnails\Gallery($this, $context, $item, $params, $page);
            $gallery->process();
        }
        
        if (class_exists('Plugin\Content\MavikThumbnails\ArticleImages') && $this->params->get('article_images')) {
            $articleImages = new Plugin\Content\MavikThumbnails\ArticleImages($this, $context, $item, $params, $page);
            $articleImages->process();
        }        
    }
    
    /**
     * Set meta-tag og:image
     * 
     * For images in "Images and links" it works too because this addon call imageReplacer.
     * 
     * @return void
     */
    private function setOgImage()
    {
        $document = JFactory::getDocument();
        
        if ( self::$ogImageIsSetted || !($document instanceof JDocumentHTML) ) {
            return;
        }
        
        // Verify context
        $context = $this->params->get('og_image', 'selected');
        switch ($context) {
            case 'selected':
                $allowContext = explode("\n", $this->params->get('og_image_context', 'com_content.article'));
                if (!in_array($this->context, $allowContext)) {
                    return;
                }
                break;
            case 'all':
                if (strpos($this->context, 'com_') !== 0) {
                    return;
                }
                break;
            default :
                return;
        }
        
        $imageInfo = $this->generator->getThumb(
                $this->imgTag->getAttribute('src'),
                $this->params->get('og_image_width_max', 1200),
                $this->params->get('og_image_height_max', 1200),
                true
        );
        
        if ($imageInfo->thumbnail->path) {
            $src = $imageInfo->thumbnail->url;
        } else {
            if (
                $imageInfo->original->width < $this->params->get('og_image_width_min', 200) ||
                $imageInfo->original->height < $this->params->get('og_image_height_min', 200)
            ) {
                return;
            }
            $src = $imageInfo->original->url;
        }
        
        if ( !strpos($src, '://') ) {
            $uri = JUri::getInstance();
            $ds = strpos($src, '/') === 0 ? '' : '/';
            $src = $uri->getScheme().'://'.$uri->getHost().$ds.$src;
        }
        
        $document->addCustomTag("<meta property=\"og:image\" content=\"{$src}\" />");
        self::$ogImageIsSetted = true;
    }

    /**
     * Set parameters for current context
     */
    private function initParams()
    {
        $app = JFactory::getApplication();
        $params = new Joomla\Registry\Registry;

        if (empty($this->originalParams)) {
            $this->originalParams = clone $this->params;
        } else {
            $this->params = clone $this->originalParams;
        }

        // Find all appropriate conditions and set parameters
        foreach ($this->contextParams as $context) {
            foreach ($context->conditions as $condition) {
                switch ($condition->type) {
                    case 'context':
                        if (!in_array($this->context, $condition->value)) {
                            continue 3;
                        }
                        break;
                    case 'property':
                        if (
                            !isset($this->item->{$condition->name}) ||
                            !in_array($this->item->{$condition->name}, $condition->value)
                        ) {
                            continue 3;
                        }
                        break;
                    case 'request':
                        if (!in_array($app->input->get($condition->name), $condition->value)) {
                            continue 3;
                        }
                        break;
                }
            }
            // Set parameters
            foreach ($context->settings as $settings) {
                $params->set($settings->name, $settings->value);
            }
            $this->params->merge($params);
        }

        $this->generator->setParams($this->getGeneratorParams());
    }

    protected function initContextParams()
    {
        $this->contextParams = (array) json_decode($this->params->get('context_settings', ''));
        foreach ($this->contextParams as &$params) {
            foreach ($params->conditions as &$condition) {
                $condition->value = explode(',', str_replace(' ', '', $condition->value));
            }
        }
    }

    /**
     * Get parameters of thumbnail generator
     *
     * @return array
     */
    protected function getGeneratorParams()
    {
        return array(
            'resizeType' => $this->params->def('resize_type', 'fill'),
            'thumbDir' => $this->params->def('thumbputh', 'images/thumbnails'),
            'remoteDir' => $this->params->def('remoteputh', 'images/remote'),
            'quality' => $this->params->def('quality', 80),
            'defaultSize' => $this->params->def('default_size', ''),
            'defaultWidth' => $this->params->def('default_width', 0),
            'defaultHeight' => $this->params->def('default_height', 0),
            'dirPermessions' => octdec($this->params->def('dir_permissions', '0777')),
            'subDirs' => $this->params->def('subdirectories', 1),
        );
    }
}
