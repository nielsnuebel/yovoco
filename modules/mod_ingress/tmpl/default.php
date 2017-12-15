<?php
defined('_JEXEC') or die;

JHtml::_('script', 'system/html5fallback.js', false, true);
		JHtml::_('script', 'mod_ingress/moment.min.js', false, true);
		JHtml::_('script', 'mod_ingress/bootstrap3-datetimepicker.min.js', false, true);
		JHtml::_('script', 'mod_ingress/locales/bootstrap3-datetimepicker.de.js', false, true);
		JHtml::_('stylesheet', 'mod_ingress/bootstrap3-datetimepicker.min.css', false, true);
?>
<div class="mod-ingress">
	<form id="ingressform" action="<?php echo JUri::current() . '?option=com_ajax&module=ingress&format=raw&module_id=' . $module->id.'&Itemid=' . $Itemid; ?>" method="post">
		<div class="form-group">
			<input type="email" autocomplete="username" class="form-control" id="f101" name="f101" placeholder="<?= JText::_('MOD_INGRESS_EMAIL')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="f102" name="f102" placeholder="<?= JText::_('MOD_INGRESS_FIRSTNAME')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="f103" name="f103" placeholder="<?= JText::_('MOD_INGRESS_LASTNAME')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<label for="f104"><?= JText::_('MOD_INGRESS_GENDER')?></label><br>
			<label class="radio-inline"><input type="radio" name="f104" id="f1041" value="1" checked> <?= JText::_('MOD_INGRESS_GENDER_1')?></label>
			<label class="radio-inline"><input type="radio" name="f104" id="f1042" value="2"> <?= JText::_('MOD_INGRESS_GENDER_2')?></label>
		</div>
		<div class="form-group">
		<?php
		$date = JFactory::getDate();
		$value = $date->toSql();
		$doc = JFactory::getDocument();
		$lang = substr(JFactory::getDocument()->getLanguage(), 0, 2);

		$doc->addScriptDeclaration("$(function () {
                jQuery('#datetimepicker_birthday').datetimepicker({
                    locale: '" . $lang . "',
                    format: '" . JText::_('MOD_INGRESS_DATE_FORMAT') . "',
                    icons: {
                        date: 'fa fa-calendar',
	                    previous: 'fa fa-arrow-left',
	                    next: 'fa fa-arrow-right'
                    }
                });
            });");

		$html = array();
        $html[] = '<label for="f105">' . JText::_('MOD_INGRESS_BIRTHDAY') . '</label>';
        $html[] = '<div id="datetimepicker_birthday" class="input-group date">';
            $html[] = '<input type="text" class="form-control" value="' . $value . '" name="f105" id="f105">';
			$html[] = '<span class="input-group-addon">';
				$html[] = '<span class="fa fa-calendar"></span>';
			$html[] = '</span>';
		$html[] = '</div>';


		echo implode("\n", $html);
		?>
		<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="f106" name="f106" placeholder="<?= JText::_('MOD_INGRESS_PLZ')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<input autocomplete="password" type="password" class="form-control" name="password" id="password" placeholder="<?= JText::_('MOD_INGRESS_PASSWORD')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group">
			<input autocomplete="off" type="password" class="form-control" name="password_repeat" id="password_repeat" placeholder="<?= JText::_('MOD_INGRESS_PASSWORD_REPEAT')?>">
			<small class="help-block form-control-feedback"></small>
		</div>
		<div class="form-group ingress">
			<small class="help-block form-control-feedback"></small>
		</div>
		<input type="hidden" name="module_id" value="<?= $modul->id?>">
		<input type="hidden" name="REMOTE_ADDR" value="<?= $_SERVER['REMOTE_ADDR'] ?>">
		<button type="submit" class="btn btn-yovoco submitingress"><?= JText::_('MOD_INGRESS_SEND')?></button>
		<p class="submit-info"><?= JText::_('MOD_INGRESS_SUBMIT_INFO'); ?></p>
	</form>
	<h3 class="ingress-success"><?= JText::_('MOD_INGRESS_RESPONSE_STATUS_31');?></h3>
</div>
<script type="application/javascript">
	var form = jQuery('#ingressform');
	jQuery('.form-group').find('small.help-block').hide();
	jQuery('.ingress-success').hide();
    form.bind('keypress', function (e) {
        var targettedElement = jQuery(event.target)[0].nodeName.toLowerCase();
        if(e.keyCode == 13 && targettedElement != 'textarea')
        {
            return false;
        }
    });

    jQuery('button.submitingress').click( function(evt) {
      jQuery('.form-group', form).removeClass('has-error has-feedback');
      jQuery('.form-group').find('small.help-block').hide();
      jQuery.ajax( {
        type: "POST",
        url: form.attr( 'action' ),
        dataType: "json",
        data: form.serialize(),
        success: function(response){
            if(response.data.error){
                error = response.data.error;
                console.log(error);
                Object.keys(error).forEach(function (key) {
                    if(key != 'global')
                    {
                        jQuery('input#' + key).parents('.form-group').addClass('has-error');
                        jQuery('input#' + key).parents('.form-group').find('small.help-block').show().html(error[key]);
                    }
                    else {
                        jQuery('.form-group.ingress').addClass('has-error');
                        jQuery('.form-group.ingress small.help-block').show().html(error[key]);
                    }
                });
            }
            else{
                jQuery('.ingress-success').show();
                jQuery(form).hide();
            }
        },
        error: function(data,errorThrown){
            console.log(errorThrown)
        }
      });
      evt.preventDefault();
      return false;
    });
</script>