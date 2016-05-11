#Joomla componets markup
```php

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

?>

<!--ICONS-->

<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $baseUrl; ?>/icons/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/icons/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/icons/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/icons/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/icons/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/icons/favicon-128.png" sizes="128x128" />
<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="<?php echo $baseUrl; ?>/icons/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="<?php echo $baseUrl; ?>/icons/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="<?php echo $baseUrl; ?>/icons/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="<?php echo $baseUrl; ?>/icons/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="<?php echo $baseUrl; ?>/icons/mstile-310x310.png" />

<!--JOOMLA HEAD-->
<jdoc:include type="head" />

<!--JOOMLA MESSAGE-->
<jdoc:include type="message" />

<!--JOOMLA COMPONENT-->
<jdoc:include type="component" />

<!--JOOMLA MODULE: main-menu-->
<jdoc:include type="modules" name="main-menu" style="nowrap" />


<?php if ($isHome) { ?>
<?php } else { ?>
<?php } ?>

<?php require __DIR__ . '/blocks/header/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/'. $baseUrl.'/blocks/site-header/site-header.php'; ?>

```