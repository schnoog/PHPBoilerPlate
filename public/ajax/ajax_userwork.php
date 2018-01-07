<?php

require_once("../../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../../app/bootstrap_ajax.php';
if (DEBUGOUT) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
if (!isset($_REQUEST['token'])) {
    die(_('Security check failed, token missing'));
}
$tokencheck = checkCSRFToken($_REQUEST['token']);
if (!$tokencheck) {
    die(_('Security check failed'));
}
list($dp, $tc, $userid)= explode(":", $tokencheck);
if ($tc == -1) {
    die(_('Security check failed, no guest access'));
}
$hasrightrole = false;
for ($x=0;$x < count($Settings['admin']['adminroles']);$x++) {
    if ($tc & $Settings['admin']['adminroles'][$x]) {
        $hasrightrole= true;
    }
}
if (!$hasrightrole) {
    die(_('Not the right role'));
}
$selfroot = fIsRootRole($tc);
$nooutput = false;
$template = "admin_user_view";


//    echo $tmp;
//    exit;




if (isset($_POST['userid'])) {
    $userid = intval($_POST['userid']);
}

//////////////////////////////////////////////////////////////////////////////////////////
if (!isset($_REQUEST['userid'])) {                   // General view - all user table
    $template = "admin_user_table";
    $userdump = DB::query('Select * from users ORDER by username ASC');
                
    //$roleflag = $_REQUEST['num'];
    //$rr = fGetRolesByFlag($roleflag);
    //$data .= "<hr>" . print_r($rr,true) . "<hr>" . fGetStatusByNum(0);
                
    for ($x=0;$x < count($userdump);$x++) {
        $userlist[$x] = $userdump[$x];
        $userlist[$x]['status_written'] = fGetStatusByNum($userdump[$x]['status']);
        $userlist[$x]['roles_array'] = fGetRolesByFlag($userdump[$x]['roles_mask']);
        $userlist[$x]['showedit'] = true;
        if (!$selfroot or !fIsRootRole($userdump[$x]['roles_mask'])) {
            $userlist[$x]['showedit'] = true;
        }
    }
    $smarty->assign("userlist", $userlist);
    goto GoToGeneralOutput;
}  // End general view

/////////////////////////////////////////////////////////////////////////////////////
    $stati = fGetStati();
    $roles = fGetRoles();
    $seccode = md5($Settings['security']['token']['salt'] . $userid);

if (isset($_REQUEST['del'])) {
    if ($_REQUEST['sec'] == $seccode) {
        $sql = "Delete from users WHERE id = %i";
        DB::query($sql, $userid);
        echo "OK";
        exit;
    } else {
        $msg = _('Security check failed');
    }
}










    
    //error_log(print_r($_REQUEST,true));
if (isset($_REQUEST['save'])) {
    $role = 0;
    if (isset($_REQUEST['role'])) {
        $roles = $_REQUEST['role'];
        for ($x = 0; $x < count($roles);$x++) {
            $role += $roles[$x];
        }
    }
    if ($_REQUEST['sec'] == $seccode) {
        $savedata = array(
            'username' => $_REQUEST['uname'],
            'email' => $_REQUEST['email'],
            'verified' => $_REQUEST['verified'],
            'status'   => $_REQUEST['status'],
            'resettable' =>  $_REQUEST['resettable'],
            'roles_mask' =>  $role
        );
        
        if (isset($_REQUEST['password'])) {
            $savedata['password'] = password_hash(trim($_REQUEST['password']), \PASSWORD_DEFAULT);
        }
        DB::update('users', $savedata, "id=%i", $userid);

        $msg = print_r($savedata, true);
        echo "OK";
        exit;
    } else {
        $msg = _('Security check failed');
    }
}

    $msg="";
    $smarty->assign("msg", $msg);
    $currentuser = DB::queryFirstRow("Select * from users WHERE id = %i", $userid);
    $currentuser['seccode'] = $seccode;
    $currentuser['roles_id_array'] = fGetRolesByFlag($currentuser['roles_mask'], true);
    $template = "admin_user_view";
    $smarty->assign("userdata", $currentuser);
    $smarty->assign("stati", $stati);
    $smarty->assign("roles", $roles);

GoToGeneralOutput:
if (!$nooutput) {
    //$smarty->assign("debugout",$data);
    $smarty->assign("sectoken", $_REQUEST['token']);
    $smarty->display($template . ".tpl");
}
