<?php
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$doc = JFactory::getDocument();
$menu = $app->getMenu()->getActive();

$Itemid = $app->input->getInt('Itemid');
require JModuleHelper::getLayoutPath('mod_ingress', $params->get('layout', 'default'));
