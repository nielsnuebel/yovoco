<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Helper for mod_contact
 *
 * @package     Joomla.Site
 * @subpackage  mod_contact
 *
 * @since       1.6
 */
class ModContactHelper
{

	public static function getJavascript($formfields, $module)
	{
		$js = array();

		$js[] = '$(function () {';

				$js[] = "if($('#modcontact-form').length>0) {";
				$js[] = "$('#modcontact-form').validate({";
					$js[] = "submitHandler: function(form) {";
						$js[] = "$('.submit-button').button('loading');";
						$js[] = "$.ajax({";
							$js[] = "type: 'POST',";
							$js[] = "url: '".JUri::current()."?option=com_ajax&module=contact&format=raw',";
							$js[] = "data: {";
							foreach($formfields as $field)
							{
								$js[] = "'".$field->name."': $('#modcontact-form #".$field->name."').val(),";
							}
								$js[] = "'module_id': ".$module->id.",";
								$js[] = "'message': $('#modcontact-form #message').val(),";
							$js[] = "},";
							$js[] = "dataType: 'json',";
							$js[] = "success: function (data) {";
								$js[] = "if (data.sent == 'yes') {";
									$js[] = "$('#MessageSent').removeClass('hidden');";
									$js[] = "$('#MessageNotSent').addClass('hidden');";
									$js[] = "$('.submit-button').removeClass('btn-default').addClass('btn-success').prop('value', '".JText::_('MOD_CONTACT_MESSAGE_SENT')."');";
									$js[] = "$('#modcontact-form .form-control').each(function() {";
										$js[] = "$(this).prop('value', '').parent().removeClass('has-success').removeClass('has-error');";
									$js[] = "});";
								$js[] = "} else {";
									$js[] = "$('#MessageNotSent').removeClass('hidden');";
									$js[] = "$('#MessageSent').addClass('hidden');";
								$js[] = "}";
							$js[] = "}";
						$js[] = "});";
					$js[] = "},";
					$js[] = "errorPlacement: function(error, element) {";
						$js[] = "error.insertBefore( element );";
					$js[] = "},";
					$js[] = "onkeyup: false,";
					$js[] = "onclick: false,";
					$js[] = "rules: {";
					foreach($formfields as $field)
					{
						if($field->email or $field->required or $field->minlength)
						{
							$js[]= $field->name.": {";
							if($field->required) $js[] = "required: true,";
							if($field->email) $js[] = "email: true,";
							if($field->minlength) $js[] = "minlength: ".$field->minlength.",";
							$js[]= "},";
						}
					}
					$js[] = "},";
					$js[] = "messages: {";
					foreach($formfields as $field)
					{
						if($field->email or $field->required or $field->minlength)
						{
							$js[]= $field->name.": {";
							if($field->required and $field->requiredmessage) $js[] = "required: '".$field->requiredmessage."',";
							if($field->email and $field->emailmessage) $js[] = "email: '".$field->emailmessage."',";
							if($field->minlength and $field->minlengthmessage) $js[] = "minlength: '".$field->minlengthmessage."',";
							$js[]= "},";
						}
					}
					$js[] = "},";
					$js[] = "errorElement: 'span',";
					$js[] = "highlight: function (element) {";
						$js[] = "$(element).parent().removeClass('has-success').addClass('has-error');";
						$js[] = "$(element).siblings('label').addClass('hide');";
					$js[] = "},";
					$js[] = "success: function (element) {";
						$js[] = "$(element).parent().removeClass('has-error').addClass('has-success');";
						$js[] = "$(element).siblings('label').removeClass('hide');";
					$js[] = "}";
				$js[] = "});";
			$js[] = "};";
		$js[] = '});';

		return implode("\n",$js);
	}

	/**
	 * replace tags with data within the text
	 *
	 * @param   string  $text  the text
	 * @param   mixed   $data  the data
	 *
	 * @return  string
	 */
	protected static function replacePlaceHolders($text, $data)
	{
		foreach ($data as $placeHolder => $value)
		{
			if (is_string($value))
			{
				$text = str_replace('{' . $placeHolder . '}', $value, $text);
			}
		}
		return $text;
	}

	public static function getAjax()
	{
		$app = JFactory::getApplication();
		$input = $app->input;

		$module = JTable::getInstance('Module', 'JTable', array());
		$module->load($input->get('module_id'));

		$modulparams = json_decode($module->params);
		$formfields = ModContactHelper::getRepeatable($modulparams->fields);
		$data = ModContactHelper::getFormDataArray($formfields,$input);


		$fromname       = ModContactHelper::replacePlaceHolders($modulparams->fromname,$data);
		$mailfrom       = ModContactHelper::replacePlaceHolders($modulparams->mailfrom,$data);
		$emailSubject   = ModContactHelper::replacePlaceHolders($modulparams->subject,$data);
		$emailBodyAdmin = ModContactHelper::replacePlaceHolders($modulparams->body,$data);

		$recipients = explode(",",$modulparams->recipient);

		foreach($recipients as $recipient )
		{
			$sent = JFactory::getMailer()->sendMail($mailfrom, $fromname, $recipient, $emailSubject, $emailBodyAdmin);
		}

		if ($sent){
			$emailResult = array ('sent'=>'yes');
		} else{
			$emailResult = array ('sent'=>'no');
		}

		echo json_encode($emailResult);
		$app->close();
	}

	public static function getRepeatable($repeatablefield)
	{
		$repeatablefield = json_decode($repeatablefield);
		foreach ($repeatablefield as $key => $values)
		{
			$i = 0;
			foreach ($values as $value)
			{
				if (!isset($result[$i])) $result[$i] = new stdClass();
				$result[$i]->$key = $value;
				$i++;
			}
		}

		return $result;
	}
	
	public static function getFormDataArray($formfields, $input)
	{
		$data = array();
		$data['message'] = $input->get('message','','STRING');
		foreach($formfields as $field)
		{
			$data[$field->name] = $input->get($field->name,'','STRING');
		}
		return $data;
	}
}
