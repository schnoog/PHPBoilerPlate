<?php

require_once("../../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../../app/bootstrap.php';
if (DEBUGOUT) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
///socialRegister($identifier,$provider,$usermail,$username='')

$provider = 'Facebook';

if (isset($_REQUEST['register'])) {
    $_SESSION['register'] = true;
}


if (isset($_SESSION['oauthprov'])) {
    $tmp = $_SESSION['oauthprov'];
    if (isSocialProviderAllowed($tmp)) {
        $provider = $tmp;
    }
}


if (isset($_REQUEST['provider'])) {
    $tmp = $_REQUEST['provider'];
    if (isSocialProviderAllowed($tmp)) {
        $provider = $tmp;
    }
    $_SESSION['oauthprov'] = $tmp;
}

$oathok = false;

try {
    //Feed configuration array to Hybridauth
    $hybridauth = new Hybridauth\Hybridauth($Settings['oauth']['config']);

    //Then we can proceed and sign in with Twitter as an example. If you want to use a diffirent provider,
    //simply replace 'Twitter' with 'Google' or 'Facebook'.

    //Attempt to authenticate users with a provider by name
    $adapter = $hybridauth->authenticate($provider);

    //Returns a boolean of whether the user is connected with Twitter
    $isConnected = $adapter->isConnected();
 
    //Retrieve the user's profile
    $userProfile = $adapter->getUserProfile();

    $accessToken = $adapter->getAccessToken();
    //Inspect profile's public attributes
    //var_dump($userProfile);
    $oathok = true;
    $allOK = true;
    //Disconnect the adapter
    $adapter->disconnect();
} catch (\Exception $e) {
    $allOK = false;
    echo 'Oops, we ran into an issue! ' . $e->getMessage();
}

if ($oathok) {
    $target = $Settings['pages']['messagepage'];
    $identifier = $userProfile->identifier;
    $usermail = $userProfile->email;
    $username = $userProfile->displayName;
    //socialLogin($identifier,$provider,$usermail)
    //socialRegister($identifier,$provider,$usermail,$username='')
    if (isset($_SESSION['register'])) {
        $allOK = socialRegister($identifier, $provider, $usermail, $username);
        unset($_SESSION['register']);
    } else {
        $allOK = socialLogin($identifier, $provider, $usermail);
    }

    $_SESSION['msgtype'] = 'danger';
    $_SESSION['msg'] = $msg;
    if ($allOK) {
        $_SESSION['msgtype'] = 'success';
        if ($auth->isLoggedIn()) {
            $target = $Settings['pages']['landingpage'];
        }
    }
    forwartTo($Settings['page']['baseurl'] .$target);
}
