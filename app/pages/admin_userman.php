<?php

if (!$auth->isLoggedIn()) {
    forwartTo($Settings['pages']['noaccess']);
}
if (!$_SESSION['isadmin']) {
    forwartTo($Settings['pages']['noaccess']);
}

$data ='';

$data .= "<hr>" . print_r($_SESSION, true);
$data .= "<hr>" . print_r($smarty, true);

$userdump = DB::query('Select * from users ORDER by username ASC');

//$roleflag = $_REQUEST['num'];
//$rr = fGetRolesByFlag($roleflag);
//$data .= "<hr>" . print_r($rr,true) . "<hr>" . fGetStatusByNum(0);
$selfroot = false;
if ($auth->hasRole($Settings['admin']['rootrole'])) {
    $selfroot= true;
}
for ($x=0;$x < count($userdump);$x++) {
    $userlist[$x] = $userdump[$x];
    $userlist[$x]['status_written'] = fGetStatusByNum($userdump[$x]['status']);
    $userlist[$x]['roles_array'] = fGetRolesByFlag($userdump[$x]['roles_mask']);
    $userlist[$x]['showedit'] = true;
    if (!$selfroot or !fIsRootRole($userdump[$x]['roles_mask'])) {
        $userlist[$x]['showedit'] = true;
    }
}
$pagedata['js_to_include'] =  'js_admin_user.tpl';
$pagedata['replaceid'] = "usertable";
$pagedata['ajaxbackend'] = 'ajax_userwork.php';
//$data .= "<hr><pre>" . print_r($userlist,true)  ."</pre>";







$smarty->assign("userlist", $userlist);
$data="";
$smarty->assign("debugout", $data);
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
