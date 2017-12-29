<?php


$data = print_r($_REQUEST,true);
$showform = true;

$msg = "";
if (!isset($_POST['action'])){
    $_POST['action'] = "-";
    $showform = true;
}
if (!$auth->isLoggedIn()) forwartTo($Settings['pages']['noaccess']);

$user['email'] = $auth->getEmail();
$user['name'] = $auth->getUsername();

if ($_POST['action'] == 'profilechange'){
        try {
            if ($auth->reconfirmPassword($_POST['password'])) {
///////////////////////////////////////////////////
                if ($_REQUEST['name'] !== $user['name']){
                    if (validate_username($_REQUEST['name'])){
                            $ret = changeDisplayName($_SESSION['auth_user_id'],$_REQUEST['name']);
                            $msg = _('Your username was successfully changed');
                                if (!$ret) {
                                    $msg = _('An error occured. Name change failed');
                                }else{
                                    $_SESSION['auth_username'] = $_REQUEST['name'];
                                    $navdata['login']['displayname'] = $_SESSION['auth_username'];
                                }
                                
                            }else{
                            $msg = _('Sorry, your entered new user name is invalid. Only alphanumeric characters and underscore are allowed');
                            }
                }    
        
///////////////////////////////////////////////////        
                if ($_REQUEST['email'] !== $user['email']){
                            try {
                                 $auth->changeEmail($_REQUEST['email'], function ($selector, $token) {
                                                            global $msg,$showregform;
                                                            fSendRegMail($_REQUEST['email'],$selector,$token,true);
                                                            $msg .= "<br />"._('Your email address was updated. An activation email was sent to you');
                                    });
                            }
                            catch (\Delight\Auth\InvalidEmailException $e) {
                                 $msg = _('Invalid email address entered');
                                // invalid email address
                            }
                            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                                $msg = _('This email account is already registered');
                                // email address already exists
                            }
                            catch (\Delight\Auth\EmailNotVerifiedException $e) {
                                $msg = _('Your account is not activated. No profile change possible');
                                // account not verified
                            }
                            catch (\Delight\Auth\NotLoggedInException $e) {
                                // not logged in
                            }
                            catch (\Delight\Auth\TooManyRequestsException $e) {
                                $msg = _('To many tries. Please come back later');
                                // too many requests
                            }                    
                }
///////////////////////////////////////////////////            
                if (strlen($_REQUEST['npw1'])> 0){
                    if ($_REQUEST['npw1'] === $_REQUEST['npw2']){
                        if (IsPasswordSafe($_REQUEST['npw1'])){
                                        try {
                                            $auth->changePassword($_POST['password'], $_REQUEST['npw1']);
                                            $msg .= "<br />"._('Your password was updated');
                                            // password has been changed
                                        }
                                        catch (\Delight\Auth\NotLoggedInException $e) {
                                            // not logged in
                                        }
                                        catch (\Delight\Auth\InvalidPasswordException $e) {
                                            $msg = _('The password you entered seems to be wrong');
                                            // invalid password(s)
                                        }
                                        catch (\Delight\Auth\TooManyRequestsException $e) {
                                             $msg = _('To many tries. Please come back later');
                                            // too many requests
                                        }                            
                        }else{
                            $msg = _('You have entered an unsafe password. Not updated');
                        }
                    }else{
                        $msg = _('The passwords do not match');
                    }
                    
                    
                }
                        $user['email'] = $auth->getEmail();
                        $user['name'] = $auth->getUsername();
            }
            else {
                $msg = _('The password you entered seems to be wrong');
            }
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            // the user is not signed in
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
                $msg = _('To many tries. Please come back later');
        }
}


if($showform)$smarty->assign('showform',"1");
$smarty->assign("user",$user);
$smarty->assign("msg",$msg);
//$smarty->assign("debugout",$data);
$smarty->assign("sectoken",$secdata['curruser']['token']);
$smarty->assign("navdata",$navdata);
$smarty->assign("pagedata",$pagedata);
$smarty->display($page . ".tpl");