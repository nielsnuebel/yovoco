<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
//TODO-Niels Zeile 37 checken ob gesetzt
// Create a shortcut for params.
$params = $this->item->params;
$attribs = json_decode($this->item->attribs);
$canEdit = $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
if ($params->get('access-view')) :
	$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
else :
	$menu = JFactory::getApplication()->getMenu();
	$active = $menu->getActive();
	$itemId = $active->id;
	$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
	$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
	$link = new JUri($link1);
	$link->setVar('return', base64_encode($returnURL));
endif; ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#faq_<?php echo $this->item->columncounter;?>" aria-expanded="true" class="collapsed">
				<?php echo $this->escape($this->item->title); ?>
			</a>
		</h4>
	</div>
	<div id="faq_<?php echo $this->item->columncounter;?>" class="panel-collapse collapse <?php echo ($this->item->columncounter == 1)?'in':'';?>" aria-expanded="true">
		<div class="panel-body">
			<?php echo $this->item->text; ?>
		</div>
	</div>
</div>
<!-- blogpost end -->
