<?php
$data="";

require_once("../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../app/bootstrap.php';

if (DEBUGOUT){
error_reporting(E_ALL);
ini_set("display_errors", 1);
//$data .= "<pre>" . print_r($_REQUEST,true) . "</pre>";
//$data .= "<pre>" . print_r($_SESSION,true) . "</pre>";
//$data .= "<pre>" . print_r($auth,true) . "</pre>";
}

$smarty->compileAllTemplates();

//UpdatePageTable();


//$data .= "<h1>". IsPageBlockedByACL("abcde") . "</h1>";

//$page = GetRoutedPage();


//require_once(PAGE_DIR . "/" . $page . '.php');







?>
