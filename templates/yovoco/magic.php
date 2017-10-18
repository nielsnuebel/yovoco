<?php defined('_JEXEC') or die;

// variables
$app 		= JFactory::getApplication();
$doc 		= JFactory::getDocument();
$params 	= $app->getParams();
$templateparams 	= $app->getTemplate(true)->params;
$headdata 	= $doc->getHeadData();
$menu 		= $app->getMenu();
$active 	= $app->getMenu()->getActive();
$pageclass 	= $params->get('pageclass_sfx');
$tpath 		= $this->baseurl.'/templates/'.$this->template;
$assets 	= $tpath . '/assets';

$isFrontpage  = false;
$active_alias = '';

if ($active)
{
	$defaultmenuitems = array($menu->getDefault()->id, $menu->getDefault(JFactory::getLanguage()->getTag())->id);
	$isFrontpage = in_array($active->id, $defaultmenuitems);
	$active_alias = $active->alias;
}


// parameter
$googlefont = $templateparams->get('googlefont');

$pagetype 	= $templateparams->get('pagetype', 'multipage');
$hidecontentwrapper = $templateparams->get('hidecontentwrapper', 0);
$showsystemoutput = $templateparams->get('showsystemoutput', 1);

// advanced parameter
if ($app->isSite()) {
  // disable js
  if ( $templateparams->get('disablejs') ) {
    $fnjs=$templateparams->get('fnjs');
    if (trim($fnjs) != '') {
      $filesjs=explode(',', $fnjs);
      $head = (array) $headdata['scripts'];
      $newhead = array();         
      foreach($head as $key => $elm) {
        $add = true;
        foreach ($filesjs as $dis) {
          if (strpos($key,$dis) !== false) {
            $add=false;
            break;
          } 
        }
        if ($add) $newhead[$key] = $elm;
      }
      $headdata['scripts'] = $newhead;
    } 
  } 
  // disable css
  if ( $templateparams->get('disablecss') ) {
    $fncss=$templateparams->get('fncss');
    if (trim($fncss) != '') {
      $filescss=explode(',', $fncss);
      $head = (array) $headdata['styleSheets'];
      $newhead = array();         
      foreach($head as $key => $elm) {
        $add = true;
        foreach ($filescss as $dis) {
          if (strpos($key,$dis) !== false) {
            $add=false;
            break;
          } 
        }
        if ($add) $newhead[$key] = $elm;
      }
      $headdata['styleSheets'] = $newhead;
    } 
  }
  $doc->setHeadData($headdata); 
}

// generator tag
$this->setGenerator(null);

// force latest IE & chrome frame
//$doc->setMetadata('x-ua-compatible', 'IE=edge,chrome=1');


if ($googlefont !='') $doc->addStyleSheet("https://fonts.googleapis.com/css?family=".$googlefont);

//Add CSS and Javascript
$doc->addStyleSheet($tpath.'/css/style.css');
$doc->addScript($tpath.'/js/frontend.js');

$jquerypath = $tpath.'/js/frontend.js';
$tmpScripts = array();
$tmpScripts = $doc->_scripts;


unset( $tmpScripts[$this->baseurl.'/media/widgetkit/js/jquery.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery.min.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery-noconflict.js'] );
//unset( $tmpScripts[$this->baseurl.'/media/system/js/caption.js'] );

$neuScript = array();

$neuScript[$jquerypath] = $tmpScripts[$jquerypath];
foreach($tmpScripts as $key=> $value)
{
	if($key != $jquerypath)
	{
		$neuScript[$key] = $value;
	}
}
$doc->_scripts = $neuScript;



?>