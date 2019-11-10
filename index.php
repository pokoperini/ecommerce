<?php
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

ini_set('display_errors', true);

/*
 *---------------------------------------------------------------
 * TEMPLATE RESOURCES
 *---------------------------------------------------------------
 */
session_start();
require_once("vendor/autoload.php");
require_once("functions.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

/*
 *---------------------------------------------------------------
 * ROUTES
 *---------------------------------------------------------------
 */
	
$app->get("/", function() {

	$page = new Page();

	$page->setTpl("index");

});

$app->get("/carrinho", function() {

	$page = new Page();

	$page->setTpl("carrinho");

});

/*
 *---------------------------------------------------------------
 * ADMIN ROUTES 
 *---------------------------------------------------------------
 */

$admin = "/admin";

$app->get( $admin , function() {

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get( $admin . '/login' , function() {

	$page = new PageAdmin([
		'header' => false,
		'footer' => false
	]);

	$page->setTpl("login");

});

$app->post( $admin . '/login' , function() {
	
	User::login(post('login'), post('password'));

	header("Location: /admin");
	exit;
});

$app->get( $admin . '/logout' , function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

/*
 *---------------------------------------------------------------
 * TEMPLATE RUN
 *---------------------------------------------------------------
 */


$app->run();


 ?>