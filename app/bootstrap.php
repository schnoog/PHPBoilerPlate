<?php

//use Klein\Klein;

# Constants
define('DEBUG', TRUE);
define('APP_DIR', __DIR__);
define('CACHE_DIR', APP_DIR . '/cache');
define('VENDOR_DIR', APP_DIR . '/vendor');
define('VIEW_DIR', APP_DIR . '/view');
define('PAGE_DIR', APP_DIR . "/pages");
define('TEMPLATE_DIR',APP_DIR . '/templates/');
define('FUNCTION_DIR', APP_DIR . "/func");
define('MAINTEMPLATE_DIR',APP_DIR . '/templates/');
define('AJAXTEMPLATE_DIR',APP_DIR . '/templates_ajax/');
define('AJAXFRONTEND_DIR',FRONTEND_DIR . "/ajax/");
define('LANGUAGEDIR',APP_DIR.'/locale/');

require_once(APP_DIR . "/config/main_config.php");
// Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(APP_DIR . '/templates/');
$smarty->setCompileDir(APP_DIR . '/smarty/templates_c/');
$smarty->setConfigDir(APP_DIR . '/smarty/configs/');
$smarty->setCacheDir(APP_DIR . '/smarty/cache/');
$smarty->addPluginsDir(APP_DIR . '/smarty/plugins/');

if (DEBUG){
    $smarty->setCacheLifetime(1); // 30 seconds
   // $smarty->debugging = true;
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
$navdata['login']['loggedin']=false;
$navdata['admin']['visible']=false;



if ($auth->isLoggedIn()) {
    $navdata['login']['loggedin']=true;
    $_SESSION['isadmin'] = false;
    $navdata['login']['displayname'] = $auth->getUsername();
    for ($x=0;$x < count($Settings['admin']['adminroles']);$x++){
        if ($auth->hasRole($Settings['admin']['adminroles'][$x])) {
            $_SESSION['isadmin'] = true;
            $navdata['admin']['visible']=true;
        }
    }

}


// Include all php files in app/func

foreach (glob(FUNCTION_DIR . '/*.php') as $filename)
{
    include_once $filename;
}
// Generate Navigation


$navdata['login']['socialprovider'] = getAllowedSocialProviders();
$navdata['navtree'] = GenerateNavigation();
$data="";
// Set CSRFToken
setCSRFToken();
$GlobalOutput=array();

// UserSettings
$ud=0;
if ($auth->isLoggedIn()) $ud = $auth->getUserId();
$UserSettings = new Usersettings($ud);
$UserSettings->parseUserIn();
$userlang="";
$userlang = $UserSettings->getSingleSetting("language");
if (strlen($userlang)== 5) $_SESSION['lang'] = $userlang;
error_log("Userlang " .$userlang . " loaded");
// Language spin up (from SESSION['lang'] if available)
SetUserLang($userlang);













/*
// Register routers
(new PortfolioRouter())->create($klein);

// Run!
$klein->dispatch();
*/