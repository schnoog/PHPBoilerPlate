<?php


$data = print_r($_REQUEST, true);
$showregform = false;

$msg = "";
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = "-";
    $showregform = true;
}

if ($_REQUEST['action'] == "register") {
    $showregform = false;
    $uname = $_REQUEST['InputName'];
    $umail = $_REQUEST['email'];
    $pw1=  $_REQUEST['password'];
    $pw2=  $_REQUEST['password2'];
    if ($pw1 !== $pw2) {
        $msg = _('Passwords are not the same');
        $showregform = true;
    } else {
        if (!IsPasswordSafe($pw1)) {
            $msg = _('Your password is not safe enough');
            $showregform = true;
        }
    }

    if (!$showregform) {  //pws OK
        try {
            $userId = $auth->register($umail, $pw1, $uname, function ($selector, $token) {
                global $msg,$showregform;
                fSendRegMail($_REQUEST['email'], $selector, $token);
                $msg = _('Your account was created. An activation email was sent to you');
                $showregform = false;
                // send `$selector` and `$token` to the user (e.g. via email)
            });
                
            // we have signed up a new user with the ID `$userId`
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $msg = _('Invalid email address entered');
            $showregform = true;
            // invalid email address
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $msg = _('Invalid password entered');
            $showregform = true;
            // invalid password
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $msg = _('This email account is already registered');
            $showregform = false;
            // user already exists
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $msg = _('To many tries. Please come back later');
            $showregform = true;
            // too many requests
        }
    } //psw OK
}



if ($auth->isLoggedIn()) {
    $showregform = false;
}

if ($showregform) {
    $smarty->assign("showregform", "1");
}

$smarty->assign("msg", $msg);
//$smarty->assign("debugout",$data);
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
