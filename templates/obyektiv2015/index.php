<?php
defined('_JEXEC') or die;
 
$ItemId = JFactory::getApplication()->input->getInt('ItemId',0);
if ( $ItemId == 0){
	require_once __DIR__ .'/template.php';
} else {
	if(JFile::exists(__DIR__ .'/template--menu-id-'.$ItemId.'.php')) {
		require_once __DIR__ .'/template--menu-id-'.$ItemId.'.php';
	} else {
		require_once __DIR__ .'/template.php';
	}
}

?>