<?php

//echo '<pre>'.print_r($_SERVER, true).'</pre>'; die();

// Adresse comunne pour toutes nos redirections
$mainUrl = 'http://'.$_SERVER['SERVER_NAME'].str_replace('/'.basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);

// On rajoute 'http:/' devant l'adresse passée par Privoxy
// Pour déterminer l'url de la ressource que l'on redirige
$requestedUrl = 'http:/'.$_SERVER['PATH_INFO'];

// Liste des différents cdn supportés avec leur modèle d'url
$angularjsPatterns = include('patterns/angularjs.php');
$dojoPatterns = include('patterns/dojo.php');
$extcorePatterns = include('patterns/extcore.php');
$jqueryPatterns = include('patterns/jquery.php');
$mootoolsPatterns = include('patterns/mootools.php');
$prototypePatterns = include('patterns/prototype.php');
$scriptaculousPatterns = include('patterns/scriptaculous.php');
$swfobjectPatterns = include('patterns/swfobject.php');
$threejsPatterns = include('patterns/threejs.php');
$webfontPatterns = include('patterns/webfont.php');

/*

Non géré pour le moment, en attente d'une solution viable

jQuery Mobile
    snippet: <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.min.js"></script> 
    site: http://jquerymobile.com/ 

jQuery UI
    snippet: <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> 
    site: http://jqueryui.com/ 

*/


/* AngularJS
   snippet: <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> 
   site: http://angularjs.org 
*/
if (preg_match('/('.implode('|', $angularjsPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/angularjs.php');
	
	$cdn = new Angularjs($matches[2]);
}

/* Dojo
   snippet: <script src="//ajax.googleapis.com/ajax/libs/dojo/1.10.1/dojo/dojo.js"></script> 
   site: http://dojotoolkit.org/ 
*/
if (preg_match('/('.implode('|', $dojoPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/dojo.php');
	
	$cdn = new Dojo($matches[2]);
}

/* Ext Core
   snippet: <script src="//ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js"></script> 
   site: https://www.sencha.com/products/extcore/ 
*/
if (preg_match('/('.implode('|', $extcorePatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/extcore.php');
	
	$cdn = new Extcore($matches[2]);
}

/* jQuery
	 Marche pour les versions min ou normale => force à télécharger la version min si absente
	 snippet: <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
   snippet: <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
   site: http://jquery.com/ 
*/
if (preg_match('/('.implode('|', $jqueryPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/jquery.php');
	
	$cdn = new Jquery($matches[2]);
}

/* MooTools
   snippet: <script src="//ajax.googleapis.com/ajax/libs/mootools/1.5.1/mootools-yui-compressed.js"></script> 
   site: http://mootools.net/ 
*/
if (preg_match('/('.implode('|', $mootoolsPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/mootools.php');
	
	$cdn = new Mootools($matches[2]);

}

/* Prototype
   snippet: <script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.2.0/prototype.js"></script> 
   site: http://prototypejs.org/ 
*/
if (preg_match('/('.implode('|', $prototypePatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/prototype.php');
	
	$cdn = new Prototype($matches[2]);

}

/* script.aculo.us
    snippet: <script src="//ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script> 
    site: http://script.aculo.us/ 
*/
if (preg_match('/('.implode('|', $scriptaculousPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/scriptaculous.php');
	
	$cdn = new Scriptaculous($matches[2]);

}

/* SWFObject
   snippet: <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script> 
   site: http://code.google.com/p/swfobject/ 
*/
if (preg_match('/('.implode('|', $swfobjectPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/swfobject.php');
	
	$cdn = new Swfobject($matches[2]);

}

/* three.js
	 Marche pour les versions min ou normale => force à télécharger la version min si absente
   snippet: <script src="//ajax.googleapis.com/ajax/libs/threejs/r67/three.min.js"></script> 
   site: http://threejs.org/ 
*/
if (preg_match('/('.implode('|', $threejsPatterns).')/i', $requestedUrl, $matches))
{
	require_once('classes/threejs.php');
	
	$cdn = new Threejs($matches[2]);

}

/* Web Font Loader
   snippet: <script src="//ajax.googleapis.com/ajax/libs/webfont/1.5.3/webfont.js"></script> 
   site: https://github.com/typekit/webfontloader 
*/
if (preg_match('/('.implode('|', $webfontPatterns).')/i', $requestedUrl, $matches))
{

//echo '<pre>'.print_r($matches, true).'</pre>'; die();
	
	require_once('classes/webfont.php');
	
	$cdn = new Webfont($matches[2]);

}

// Fichier local manquant ?
if (!file_exists($cdn->getFilename()))
{
	// On télécharge et stocke
	$cdn->get();
}

// On redirige vers notre ressource locale
$requestedUrl = $mainUrl.$cdn->file;

// On redirige et sort du script
header("Status: 302 Found", true, 302);
header("Location: {$requestedUrl}");

?>
