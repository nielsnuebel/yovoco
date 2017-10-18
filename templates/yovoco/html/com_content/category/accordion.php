<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');
?>
<div class="item-page">
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<h1 class="contentheadline"> <?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) : ?>
			<span class="subheading-category"><?php echo $this->category->title; ?></span>
		<?php endif; ?>
	</h1>
<?php endif; ?>

<?php if ($this->params->get('show_description', 1)) : ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
		<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
	<?php endif; ?>
<?php endif; ?>

<?php if (empty($this->intro_items)) : ?>
	<?php if ($this->params->get('show_no_articles', 1)) : ?>
		<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>
<?php endif; ?>

<?php if (!empty($this->intro_items)) : ?>
	<div class="panel-group collapse-style-1" id="accordion">
	<?php foreach ($this->intro_items as $key => &$item) : ?>
		<?php
		$item->columncounter = $key + 1;
		$this->item = & $item;
		echo $this->loadTemplate('item');
		?>
	<?php endforeach; ?>
	</div>
<?php endif; ?>


<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right"><?php echo $this->pagination->getPagesCounter(); ?> </p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
</div>
