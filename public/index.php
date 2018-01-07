<?php
$data="";

require_once("../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../app/bootstrap.php';

if (DEBUGOUT) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}




$page = GetRoutedPage();


require_once(PAGE_DIR . "/" . $page . '.php');
