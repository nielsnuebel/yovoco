<?php
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$doc = JFactory::getDocument();
$menu = $app->getMenu()->getActive();

$formfields = ModContactHelper::getRepeatable($params->get('fields'));

$js = ModContactHelper::getJavascript($formfields,$module);
$doc->addScriptDeclaration($js);

require JModuleHelper::getLayoutPath('mod_contact', $params->get('layout', 'default'));
?>

