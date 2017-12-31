<?php
$data="";

require_once("../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../app/bootstrap.php';

if (DEBUGOUT){
error_reporting(E_ALL);
ini_set("display_errors", 1);
}

$tmp = "Facebooks";

$xx = ( isSocialProviderAllowed($tmp) ? "ALLOWED" : "FORBIDDEN"  );

echo "<h2>Provider $tmp -- " . $xx . "</h2>";







function isSocialProviderAllowed($providertocheck){
    global $Settings;
        foreach($Settings['oauth']['config']['providers'] as $provider => $data){
            if($provider === $providertocheck) return true;
        }   
    return false;
}
//$tmp = getAllowedSocialProviders();
//echo "<pre>" . print_r($tmp,true) . "</pre>";



?>
