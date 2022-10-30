<?php


$data = print_r($_REQUEST, true);
$showlogin = false;
$showactivationrequest = false;
$showactivation = false;
$msg = "";
if (!isset($_POST['action'])) {
    $_POST['action'] = "-";
    $showlogin = true;
}

if ($_POST['action'] == "login") {
    try {
        if (isset($_POST['remember'])) {
            // keep logged in for one year
            $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        } else {
            // do not keep logged in after session ends
            $rememberDuration = null;
        }
                
        $auth->login($_POST['email'], $_POST['password'], $rememberDuration);
        forwartTo();
        // user is logged in
    } catch (\Delight\Auth\InvalidEmailException $e) {
        $msg = _('Email address unknown');
        $showlogin = true;
        // wrong email address
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $msg = _('Password wrong');
        $showlogin = true;
        // wrong password
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        $msg = _('Your account is not activated.');
        $showactivationrequest = true;
        // email not verified
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = _('To many tries. Please come back later');
        // too many requests
    }
}

if ($_POST['action'] == "logout") {
    if ($auth->isLoggedIn()) {
        $auth->logOut();
        $auth->destroySession();
    }
    forwartTo();
}
if ($_POST['action'] == 'activate') {
    $showactivation = true;
    if (isset($_POST['seckey']) && isset($_POST['sectoken'])) {
        try {
            $auth->confirmEmail($_POST['seckey'], $_POST['sectoken']);
            $showactivation = false;
            $showactivationrequest = false;
            $showlogin = true;
            $msg = _('Your account is now activated.');
            if ($auth->isLoggedIn()) {
                $auth->logOutAndDestroySession();
            }
            $navdata['login']['loggedin']=false;
            // email address has been verified
        } catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            $msg = _('The data you entered is invalid');
            // invalid token
        } catch (\Delight\Auth\TokenExpiredException $e) {
            // token expired
            $msg = _('The data is expired');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            // email address already exists
            $msg = _('Already activated');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            // too many requests
            $msg = _('To many tries. Please come back later');
        }
    }
}

if ($_POST['action'] == 'resend') {
    try {
        $auth->resendConfirmationForEmail($_POST['email'], function ($selector, $token) {
            global $msg,$showlogin;
            $msg = _('The activation email was sent');
            $showlogin = true;
            fSendRegMail($_POST['email'], $selector, $token);

            // send `$selector` and `$token` to the user (e.g. via email)
        });
            
        // the user may now respond to the confirmation request (usually by clicking a link)
    } catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
        $msg = _('No activation request active');
        $showlogin = true;
        // no earlier request found that could be re-sent
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = _('No activation request active');
        $showlogin = true;
        // there have been too many requests -- try again later
    }
}

if ($showactivation) {
    $smarty->assign("showactivation", "1");
}
if ($showactivationrequest) {
    $smarty->assign("showactivationrequest", "1");
}
if ($showlogin) {
    $smarty->assign("showlogin", "1");
}
$smarty->assign("msg", $msg);
//$smarty->assign("debugout",$data);
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
