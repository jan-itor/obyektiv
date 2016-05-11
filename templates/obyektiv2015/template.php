<?php

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$user = JFactory::getUser();
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$ruri = substr($_SERVER['REQUEST_URI'], 1);
$curi = JUri::current();
$isHome = ($curi == JUri::base() || $ruri == '' || $ruri == 'index.php');
$baseUrl = $this->baseUrl .'/templates/'. $this->template;
$bid = ($isHome) ? 'g-home':'g-page';
$bclass = $browser .' page-'. $itemid;
if ($ruri == '404')
$bclass.= ' e404';

$bclass.= ' '.str_replace('/', '_', $ruri);

if ($isHome)
$this->setTitle($sitename);

if (!$isHome)
{
    //Делаем редирект со слэша на без. Делаем именно, через PHP, т.к. через .htaccess ломается админка.
    $parseUrl = parse_url($_SERVER["REQUEST_URI"]);
    $explodeUrl = explode("/", $parseUrl["path"]);
    if (mb_strlen(end($explodeUrl)) < 1)
    {
        array_pop($explodeUrl);
        $explodeUrl = array_filter($explodeUrl);
        foreach ($explodeUrl as $url)
        {
            $buildUrl .= "/".$url;
        }
        if (sizeof($parseUrl["query"]) > 0)
        {
            $buildUrl .= "?".$parseUrl["query"];    
        }
        
        header("HTTP/1.1 301 Moved Permanently"); 
        header("Location: $buildUrl"); 
        die();
    }
}

?>

<!DOCTYPE html>

<html lang="ru">

<head>

    <?php require __DIR__ . '/_head.php'; ?>

</head>

<body>

    <?php require __DIR__ . '/blocks/header/header.php'; ?>

    <?php if ($isHome) { ?>

        <?php require __DIR__ . '/blocks/main-carousel/main-carousel.php'; ?>

        <main class="grid">

            <!--grid row 1-->
            <div class="grid__row">
                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror-->
                    <jdoc:include type="modules" name="navigaror" style="nowrap" />

                </div>
                <div class="grid__item grid__item--small">

                    <!--JOOMLA MODULE: search-->
                    <jdoc:include type="modules" name="search" style="nowrap" />

                    <?php require __DIR__ . '/blocks/hotline/hotline.php'; ?>

                </div>
            </div>


            
            <!--grid row 2-->
            <div class="grid__row">
                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror2-->
                    <jdoc:include type="modules" name="navigaror2" style="nowrap" />

                </div>
                <div class="grid__item grid__item--small">

                    <!--JOOMLA MODULE: banners-->
                    <jdoc:include type="modules" name="banners" style="nowrap" />

                </div>
            </div>
               

            
            <!--grid row 3-->
            <div class="grid__row">
                <div class="grid__item grid__item--small grid__item--news">
                    <h3 class="grid__title">Новости</h3>

                    <!--JOOMLA MODULE: navigaror4-->
                    <jdoc:include type="modules" name="navigaror4" style="nowrap" />

                    <!--BTN-TRAMSPARENT-->
                    <a href="/novosti" class="grid__btn-wrap / btn-transparent" target="_blank">Все новости</a>

                    <?php require __DIR__ . '/blocks/social/social.php'; ?>

                </div>
                <div class="grid__item grid__item--big">

                    <!--JOOMLA MODULE: navigaror3-->
                    <jdoc:include type="modules" name="navigaror3" style="nowrap" />

                </div>
                
            <!--VIDEO_BLOCK-->
            <div class="grid__row pd_left video_block_home">
                <jdoc:include type="modules" name="video_block" style="nowrap" />
            </div>
            <!--/VIDEO_BLOCK-->                
            </div>
            
            <div class="seoTxtHome">
                <h1>Севастопольская онлайн газета «Объектив»</h1>
                <p>«Объектив» - это независимая российская газета, которая успешно развивает новые форматы средств массовой информации. Мы приветствуем беспристрастие и объективность, поэтому в наших публикациях вы никогда не найдете исковерканные факты или данные, выгодные какой-либо политической силе или органам власти.</p>
 
<p>Наша газета создана компанией «Медиа коммандер груп», основной целью которой является своевременное и достоверное информирование всех читателей о политических, экономических, культурных, общественных новостях на территории Севастополя, Крыма, России и всего мира.</p>

<p>В отличие от многих других газет Севастополя, в нашем издании можно найти как информационные сводки и материалы, так и аналитические статьи и журналистские расследования.</p>

<p>Ежедневный мониторинг всех важных событий онлайн газеты «Объектив» позволяет предоставлять нашим читателям полную картину о происходящем. Эксклюзивные материалы о медицине, криминале, образовании и других сферах нашей жизни, интересные интервью с известными людьми в категории «Лицом к лицу», полезные рекомендации раздела «Свой дом» и многое другое вы всегда можете найти на нашем информационном портале.</p>
            </div>
            
        </main>

    <?php } else { ?>

        <?php require __DIR__ . '/blocks/internal-subheader/internal-subheader.php'; ?>

        <main class="grid grid--internal">
            <div class="grid__item grid__item--big / typography">    
                <jdoc:include type="modules" name="breadcrumbs" />
         
                <!--JOOMLA MESSAGE-->
                <jdoc:include type="message" />

                <!--JOOMLA COMPONENT-->
                <jdoc:include type="component" />
                <jdoc:include type="modules" name="after_content" />
            </div>
</div><!--k2 missing tag fix-->
            <div class="grid__item grid__item--small grid__item--news / js-sticky-aside">
                <h3 class="grid__title">Новости</h3>

                <!--JOOMLA MODULE: navigaror4-->
                <jdoc:include type="modules" name="navigaror4" style="nowrap" />

                <!--BTN-TRAMSPARENT-->
                <a href="/novosti" class="grid__btn-wrap / btn-transparent" target="_blank">Все новости</a>

                <?php require __DIR__ . '/blocks/social/social.php'; ?>

            </div>
        </main>

    <?php } ?>

    <?php require __DIR__ . '/blocks/footer/footer.php'; ?>

</body>

</html>