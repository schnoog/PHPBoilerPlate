<?php

/**
 * Default template for the ajax backend
 * 
 */


/** Including the basics */
require_once("../../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../../app/bootstrap_ajax.php';

if (DEBUGOUT){
error_reporting(E_ALL);
ini_set("display_errors", 1);
//$data .= "<pre>" . print_r($_REQUEST,true) . "</pre>";
//$data .= "<pre>" . print_r($_SESSION,true) . "</pre>";
//$data .= "<pre>" . print_r($auth,true) . "</pre>";
}

$smarty->compileAllTemplates();