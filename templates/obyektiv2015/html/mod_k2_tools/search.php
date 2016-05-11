<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

/*
Important note:
If you wish to use the live search option, it's important that you maintain the same class names for wrapping elements, e.g. the wrapping div and form.
*/

//joomla redefinition variables
$template_name = JFactory::getApplication()->getTemplate();
$redefinition_name = basename(__FILE__, '.php');
$redefinition_path_and_name = '/templates/' . $template_name . '/html/mod_k2_tools/' . $redefinition_name;

?>

<!--JOOMLA REDEFINITION: html/mod_k2_tools/<?php echo $redefinition_name; ?>.php-->
<link rel="stylesheet" href="<?php echo $redefinition_path_and_name . '.css'; ?>">

<div id="k2ModuleBox<?php echo $module->id; ?>" class="<?php echo $redefinition_name; ?> / k2SearchBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); if($params->get('liveSearch')) echo ' k2LiveSearchBlock'; ?>">
	<form action="<?php echo $action; ?>" method="get" autocomplete="off" class="k2SearchBlockForm">

		<input type="text" value="<?php echo $text; ?>" name="searchword" maxlength="<?php echo $maxlength; ?>" size="<?php echo $width; ?>" alt="<?php echo $button_text; ?>" class="inputbox" onblur="if(this.value=='') this.value='<?php echo $text; ?>';" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" />

		<?php if($button): ?>
		<?php if($imagebutton): ?>
		<input type="image" value="<?php echo $button_text; ?>" class="button" onclick="this.form.searchword.focus();" src="<?php echo JURI::base(true); ?>/components/com_k2/images/fugue/search.png" />
		<?php else: ?>
		<input type="submit" value="<?php echo $button_text; ?>" class="button" onclick="this.form.searchword.focus();" />
		<?php endif; ?>
		<?php endif; ?>

		<input type="hidden" name="categories" value="<?php echo $categoryFilter; ?>" />
		<?php if(!$app->getCfg('sef')): ?>
		<input type="hidden" name="option" value="com_k2" />
		<input type="hidden" name="view" value="itemlist" />
		<input type="hidden" name="task" value="search" />
		<?php endif; ?>
		<?php if($params->get('liveSearch')): ?>
		<input type="hidden" name="format" value="html" />
		<input type="hidden" name="t" value="" />
		<input type="hidden" name="tpl" value="search" />
		<?php endif; ?>
	</form>

	<?php if($params->get('liveSearch')): ?>
	<div class="k2LiveSearchResults"></div>
	<?php endif; ?>
</div>

<!--<script src="<?php echo $redefinition_path_and_name . '.js'; ?>" async></script>-->