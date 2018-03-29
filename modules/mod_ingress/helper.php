<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ingress
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Helper for mod_ingress
 *
 * @package     Joomla.Site
 * @subpackage  mod_ingress
 *
 * @since       1.6
 */
class ModIngressHelper
{
	public static function getAjax()
	{
		$app = JFactory::getApplication();
		$input = $app->input;

		$ingressData = self::getFormData($input);
		$ingressData = self::validateData($ingressData);

		if(isset($ingressData['error']) && $ingressData['error'])
		{
			echo new JResponseJson($ingressData, null, false);
			$app->close();
		}

		$response = self::sendToIngress($ingressData);

		$ingressStatus = json_decode($response);

		if ($ingressStatus->status < 31)
		{
			$translateStatus = self::translateStatus($ingressStatus);
			echo new JResponseJson($translateStatus, null, false);
			$app->close();
		}
		else {
			echo new JResponseJson($ingressData, null, false);
			$app->close();
		}
	}

	protected static function translateStatus($ingressStatus)
	{
		$status = $ingressStatus->status;

		// Username
		if (in_array($status, array(11, 8, 1, 2,22)))
		{
			$error['error']['f101'] = JText::_('MOD_INGRESS_RESPONSE_ERROR_' . $status);
		}

		// Passwort
		if (in_array($status, array(3, 4, 5, 6, 13, 14, 15, 16, 17, 18, 19, 20)))
		{
			$error['error']['password'] = JText::_('MOD_INGRESS_RESPONSE_ERROR_' . $status);
		}

		// Panelbedingungen
		if (in_array($status, array(7)))
		{
			$error['error']['global'] = JText::_('MOD_INGRESS_RESPONSE_ERROR_' . $status);
		}

		// Datensatz nicht Speichern
		if (in_array($status, array(12)))
		{
			$error['error']['global'] = JText::_('MOD_INGRESS_RESPONSE_ERROR_' . $status);
		}

		// Undifiened
		if (in_array($status, array(21)))
		{
			$error['error']['global'] = $ingressStatus->error;
		}

		// User already exist
		if (in_array($status, array(23)))
		{
			$error['error']['global'] = JText::_('MOD_INGRESS_RESPONSE_ERROR_' . $status);
		}

		return $error;
	}

	protected static function sendToIngress($data)
	{
		// Paneldomain, z.B. https://www.panelingress.de/
		$url = 'https://d426.keyingress.de/i_p/';
		// ID der Portalseite "Registrierung"
		$id_registration = 15;

		$fields = array();
		$fields['content_type'] = 'application-json';
		$fields['panel_send'] = 1;
		/*$fields['crm_send'] = 1;
		$fields['crm_s'] = 1;*/
		$fields['privacy'] = 1;
		$fields['conditions'] = 1;
		$fields['ID'] = $id_registration;

		$fields = array_merge($fields, $data);

		unset($fields['error']);

		$postdata = '';

		foreach ($fields as $name => $value)
		{
			$postdata .= '&' . $name . '=' . urlencode($value);
		}

		// Daten per POST senden
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		// Content-Type, damit keyingress in Form eines json-Strings antwortet
		// Connection: close, damit die Verbindung nach der Nutzung vollständig geschlossen wird
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		// damit keine direkte Ausgabe bei curl_exec erfolgt
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result_sent_json = curl_exec($ch);
		curl_close($ch);

		return $result_sent_json;
	}

	protected static function getFormData($data)
	{
		$ingressData = array();

		$neededData = array(
			'f101' => 'f101', // E-Mail
			'f102' => 'f102', // Firstname
			'f103' => 'f103', // Lastname
			'f104' => 'f104', // Gender
			'f105' => 'f105', // Birthday
			'f106' => 'f106', // CityCode
			'password' => 'password',
			'password_repeat' => 'password_repeat',
			'login' => 'f101',
			'REMOTE_ADDR' => 'REMOTE_ADDR',
			'select_language' => 'lang',
		);

		foreach($neededData as $key => $value)
		{
			$ingressData[$key] = $data->get($value, null, 'RAW');
		}

		return $ingressData;
	}

	protected static function validateData($ingressData)
	{
		if (is_null($ingressData['f101']) || $ingressData['f101'] == "")
		{
			$ingressData['error']['f101'] = JText::_('MOD_INGRESS_EMAIL_REQUIRED');
		}
		elseif (!filter_var($ingressData['f101'], FILTER_VALIDATE_EMAIL)) {
		    $ingressData['error']['f101'] = JText::_('MOD_INGRESS_EMAIL_FAILED');
		}
		else {
			$ingressData['login'] = $ingressData['f101'];
		}

		if (is_null($ingressData['f102']) || $ingressData['f102'] == "")
		{
		    $ingressData['error']['f102'] = JText::_('MOD_INGRESS_FIRSTNAME_REQUIRED');
		}
		elseif(strlen($ingressData['f102']) < $min = 4)
		{
			$ingressData['error']['f102'] = JText::sprintf('MOD_INGRESS_FIRSTNAME_MIN', $min);
		}

		if (is_null($ingressData['f103']) || $ingressData['f103'] == "")
		{
		    $ingressData['error']['f103'] = JText::_('MOD_INGRESS_LASTNAME_REQUIRED');
		}
		elseif(strlen($ingressData['f103']) < $min = 4)
		{
			$ingressData['error']['f103'] = JText::sprintf('MOD_INGRESS_LASTNAME_MIN', $min);
		}

		if (is_null($ingressData['f105']) || $ingressData['f105'] == "")
		{
			$ingressData['error']['f105'] = JText::_('MOD_INGRESS_BIRTHDAY_REQUIRED');
		}

		if (is_null($ingressData['f106']) || $ingressData['f106'] == "")
		{
		    $ingressData['error']['f106'] = JText::_('MOD_INGRESS_PLZ_REQUIRED');
		}
		elseif(strlen($ingressData['f106']) < $min = 4)
		{
			$ingressData['error']['f106'] = JText::sprintf('MOD_INGRESS_PLZ_MIN', $min);
		}

		if (is_null($ingressData['password']) || $ingressData['password'] == "")
		{
		    $ingressData['error']['password'] = JText::_('MOD_INGRESS_PASSWORD_REQUIRED');
		}
		elseif(strlen($ingressData['password']) < $min = 8)
		{
			$ingressData['error']['password'] = JText::sprintf('MOD_INGRESS_PASSWORD_MIN', $min);
		}
		elseif($ingressData['password'] != $ingressData['password_repeat'])
		{
			$ingressData['error']['password_repeat'] = JText::_('MOD_INGRESS_PASSWORD_NO_MATCH');
		}

		// Remove Error Key when not error exist
		if(!count($ingressData['error']))
		{
			$ingressData['error'] = false;
		}

		// ISO CountryCode
		$ingressData['select_language'] = substr($ingressData['select_language'], 0, 2);

		return $ingressData;
	}
}
