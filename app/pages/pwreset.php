<?php


$data = print_r($_REQUEST, true);
$showreset = true;
$showactivationrequest = false;
$showactivation = false;
$msg = "";
if (!isset($_POST['action'])) {
    $_POST['action'] = "-";
    $showreset = true;
}

if ($_POST['action'] == 'activate') {
    $showactivation = true;
    $showreset = false;




    if (isset($_POST['seckey']) && isset($_POST['sectoken'])) {
        if ($_POST['password'] != $_POST['password']) {
            $msg = _("Both new password aren't the same");
        } else {
            try {
                $auth->resetPassword($_POST['seckey'], $_POST['sectoken'], $_POST['password']);
                $msg = _('Password resetted. You should now be able to login');
                $showactivation = false;

                // password has been reset
            } catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
                $msg = _('Invalid Security-data entered');
                // invalid token
            } catch (\Delight\Auth\TokenExpiredException $e) {
                $msg = _('Token expired');
                // token expired
            } catch (\Delight\Auth\ResetDisabledException $e) {
                $msg = _('Password reset disabled');
                // password reset is disabled
            } catch (\Delight\Auth\InvalidPasswordException $e) {
                $msg = _('Invalid (weak) password');
                // invalid password
            } catch (\Delight\Auth\TooManyRequestsException $e) {
                $msg = _('To many tries. Please come back later');
                // too many requests
            }
        }
    }
}


if ($_POST['action'] == 'reset') {
    try {
        $auth->forgotPassword($_POST['email'], function ($selector, $token) {
            global $msg,$showreset;
            $msg = _('The password reset email was sent');
            $showreset = true;
            fSendPWResetMail($_POST['email'], $selector, $token);

            // send `$selector` and `$token` to the user (e.g. via email)
        });
            
        // the user may now respond to the confirmation request (usually by clicking a link)
    } catch (\Delight\Auth\InvalidEmailException $e) {
        $msg = _('Email address unknown');
        $showreset = true;
        // invalid email address
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        $msg = _('Your account is not activated');
        $showreset = true;
        // email not verified
    } catch (\Delight\Auth\ResetDisabledException $e) {
        $msg = _('Password reset disabled');
        $showreset = true;
        // password reset is disabled
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = _('To many tries. Please come back later');
        $showreset = true;
        // too many requests
    }
}

if ($showactivation) {
    $smarty->assign("showactivation", "1");
}
//if ($showactivationrequest) $smarty->assign("showactivationrequest","1");
if ($showreset) {
    $smarty->assign("showreset", "1");
}
$smarty->assign("msg", $msg);
//$smarty->assign("debugout",$data);
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
