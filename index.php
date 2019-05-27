<?php
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

ini_set('display_errors', false);

/*
 *---------------------------------------------------------------
 * TEMPLATE RESOURCES
 *---------------------------------------------------------------
 */

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;

$app = new Slim();

$app->config('debug', true);

/*
 *---------------------------------------------------------------
 * ROUTES
 *---------------------------------------------------------------
 */

$pages = array(
	array(
		'route' => "/",
		// 'data'  => [],
		'file'  => "index"
	),
	array(
		'route' => "carrinho",
		// 'data'  => [],
		'file'  => "carrinho"
	),
	// array(
	// 	'route' => "",
	// 	// 'data'  => [],
	// 	'file'  => ""
	// ),
);


foreach ($pages as $p) {

	$data = $p['data'];
	$file = $p['file'];
	
	$app->get($p['route'], function() {

		global $data , $file;

		$page = $data ? new Page($data) : new Page();
	
		$page->setTpl($file);
	
	});
}


/*
 *---------------------------------------------------------------
 * TEMPLATE RUN
 *---------------------------------------------------------------
 */


$app->run();


 ?>