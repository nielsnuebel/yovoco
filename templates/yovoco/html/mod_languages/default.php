<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_languages/template.css', array(), true);
?>
<ul class="language <?php echo $moduleclass_sfx ?>">
<?php foreach ($list as $language) : ?>
	<?php if ($params->get('show_active', 0) || !$language->active):?>
		<li class="<?php echo $language->active ? 'lang-active' : '';?>" dir="<?php echo JLanguage::getInstance($language->lang_code)->isRTL() ? 'rtl' : 'ltr' ?>">
		<a href="<?php echo $language->link;?>">
		<?php if ($params->get('image', 1)):?>
			<?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true);?>
		<?php else : ?>
			<?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?>
		<?php endif; ?>
		</a>
		</li>
	<?php endif;?>
<?php endforeach;?>
</ul>


