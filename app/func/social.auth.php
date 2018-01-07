<?php



//////////////////////////////////////
// If a user has changed his email address on the platform, this change will be reflected in the local database to prevent 
// login problems and double registration
//
function socialLoginUpdate($identifier, $provider, $usermail)
{
    $res = DB::query("Select * from users WHERE loginprovider = %s AND loginproviderid = %s",$provider,$identifier);
    if (DB::count() > 0){
        $ud = $res[0];
        if ($usermail != $ud['email']){
            DB::query("Update users SET email = %s WHERE loginprovider = %s AND loginproviderid = %s",$usermail,$provider,$identifier);
        }
    }
}
//////////////////////////////////////
//
//
function socialLogin($identifier, $provider, $usermail)
{
    global $auth, $Settings, $msg;
    $loginok = false;
    socialLoginUpdate($identifier, $provider, $usermail);
    $userpass= "L0KAL". $provider . $Settings['oauth']["userpwsalt"] . $identifier;
    try {
        $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        $auth->login($usermail, $userpass, $rememberDuration);
        $loginok = true;
        $_SESSION['oauth'] = $provider;
        $_SESSION['oauthid'] = $identifier;
        // user is logged in
    } catch (\Delight\Auth\InvalidEmailException $e) {
        $msg = _('Email address unknown');
        $loginok = false;
        // wrong email address
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $msg = _('Password wrong');
        $loginok = false;
        // wrong password
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        $msg = _('Your account is not activated.');
        $loginok = false;
        // email not verified
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = _('To many tries. Please come back later');
        $loginok = false;
    }
    return $loginok;
}
//////////////////////////////////////
//
//
function socialRegister($identifier, $provider, $usermail, $username='')
{
    global $auth, $Settings,$msg;
    socialLoginUpdate($identifier, $provider, $usermail);
    if (strlen($username)<1) {
        $username = $usermail;
    }
    $userpass= "L0KAL". $provider . $Settings['oauth']["userpwsalt"] . $identifier;
    $regok = true;
    try {
        $userId = $auth->register($usermail, $userpass, $username);
        $msg = _('Your account was created, please log in now');
        setLoginProvider($provider, $usermail);
        setLoginProviderID($identifier, $usermail);
        // we have signed up a new user with the ID `$userId`
    } catch (\Delight\Auth\InvalidEmailException $e) {
        $msg = _('Invalid email address entered');
        $regok = false;
        // invalid email address
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $msg = _('Invalid password entered');
        $regok = false;
        // invalid password
    } catch (\Delight\Auth\UserAlreadyExistsException $e) {
        $msg = _('This email account is already registered');
        $regok = false;
        // user already exists
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = _('To many tries. Please come back later');
        $regok = false;
        // too many requests
    }
//
    return $regok;
}

//////////////////////////////////////
//
//
function isSocialProviderAllowed($providertocheck)
{
    global $Settings;
    foreach ($Settings['oauth']['config']['providers'] as $provider => $data) {
        if ($provider === $providertocheck) {
            return true;
        }
    }
    return false;
}
//////////////////////////////////////
//
//
function getAllowedSocialProviders()
{
    global $Settings;
    $ret = array();
    if ($Settings['oauth']['use'] === false) {
        return $ret;
    }
    foreach ($Settings['oauth']['config']['providers'] as $provider => $data) {
        if ($data['enabled']) {
            $ret[]= $provider;
        }
    }
    return $ret;
}
//////////////////////////////////////
//
//
function setLoginProvider($provider, $usermail)
{
    DB::query('UPDATE users SET loginprovider = %s WHERE email = %s', $provider, $usermail);
}
//////////////////////////////////////
//
//
function setLoginProviderID($providerid, $usermail)
{
    DB::query('UPDATE users SET loginproviderid = %s WHERE email = %s', $providerid, $usermail);
}
