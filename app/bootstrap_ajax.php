<?php

//use Klein\Klein;

# Constants
# Constants
define('DEBUG', true);
define('APP_DIR', __DIR__);
define('CACHE_DIR', APP_DIR . '/cache');
define('VENDOR_DIR', APP_DIR . '/vendor');
define('VIEW_DIR', APP_DIR . '/view');
define('PAGE_DIR', APP_DIR . "/pages");
define('TEMPLATE_DIR', APP_DIR . '/templates_ajax/');
define('MAINTEMPLATE_DIR', APP_DIR . '/templates/');
define('AJAXTEMPLATE_DIR', APP_DIR . '/templates_ajax/');
define('FUNCTION_DIR', APP_DIR . "/func");
define('AJAXFRONTEND_DIR', FRONTEND_DIR . "/");
define('LANGUAGEDIR', APP_DIR.'/locale/');


require_once(APP_DIR . "/config/main_config.php");
// Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(APP_DIR . '/templates_ajax/');
$smarty->setCompileDir(APP_DIR . '/smarty/templates_c/');
$smarty->setConfigDir(APP_DIR . '/smarty/configs/');
$smarty->setCacheDir(APP_DIR . '/smarty/cache/');
$smarty->addPluginsDir(APP_DIR . '/smarty/plugins/');

if (DEBUG) {
    $smarty->setCacheLifetime(1); // 30 seconds
}
//meekro
DB::$user = $Settings['db']['user'];
DB::$password = $Settings['db']['password'];
DB::$dbName = $Settings['db']['dbname'];
DB::$host = $Settings['db']['host']; //defaults to localhost if omitted
DB::$port = $Settings['db']['port']; // defaults to 3306 if omitted
DB::$encoding = 'utf8mb4'; // defaults to latin1 if omitted

// Anti XSS
use voku\helper\AntiXSS;

$antiXss = new AntiXSS();

// Auth
$connstring = $Settings['db']['dbdriver'] . ":host=" . $Settings['db']['host'] . ";dbname=" . $Settings['db']['dbname'] .";charset=utf8mb4" ;
$dbX = new \PDO($connstring, $Settings['db']['user'], $Settings['db']['password']);
$auth = new \Delight\Auth\Auth($dbX);
// Auth done, now set the navigation



// Include all php files in app/func

foreach (glob(FUNCTION_DIR . '/*.php') as $filename) {
    include_once $filename;
}
// Set CSRFToken

$GlobalOutput=array();




// UserSettings
$ud=0;
if (isset($_REQUEST['token'])) {
    $tokencheck = checkCSRFToken($_REQUEST['token']);
}
if ($tokencheck) {
    list($dp, $userrole, $ud)= explode(":", $tokencheck);
}
$UserSettings = new Usersettings($ud);
$UserSettings->parseUserIn();
$userlang="";
$userlang = $UserSettings->getSingleSetting("language");
// Language spin up (from SESSION['lang'] if available)
SetUserLang($userlang);














/*
// Register routers
(new PortfolioRouter())->create($klein);

// Run!
$klein->dispatch();
*/
