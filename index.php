<?php
ini_set("display_errors", 1);
error_reporting( E_ALL | E_NOTICE );

define("BASE_DIR", dirname( __FILE__ ) . "/");
define("APP_DIR", BASE_DIR . "app/");
define("THEME_DIR", BASE_DIR . "themes/default/");
define("TEMPLATE_DIR", THEME_DIR . "templates/");

@require("config.php");

@require(APP_DIR . "classes/class.page.php");
@require(APP_DIR . "classes/class.mustache.php");
@require(APP_DIR . "classes/class.db.php");

// Templating system
$m = new Mustache();

if(isset($_GET["controller"])){
	$controller = preg_replace("/[^a-zA-Z0-9\s]/", "", (string) $_GET["controller"]);
}else{
	$controller = "index";
}

if(isset($_GET["action"])){
	$action = preg_replace("/[^a-zA-Z0-9\s]/", "", (string) $_GET["action"]);
}else{
	$action = "";
}

function __autoload($page){
	$filename = APP_DIR . "/pages/page.$page.php";

	if(file_exists($filename)){
		require $filename;
	}else{
		require APP_DIR . "/pages/page.fourohfour.php";
	}
}

$DB = new DB();

if(class_exists($controller)){
	$page = new $controller($m);
}else{
	$page = new FourOhFour($m);
}

// Page title and prefix
$page->setTitle($config["site"]["title"]);
$page->setPrefix($page->getPrefix());

if(method_exists($page, "_pageStart")){
	$page->_pageStart();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$page->post();
}else{
	$page->get($action);
}

if(method_exists($page, "_pageEnd")){
	$page->_pageEnd();
}
