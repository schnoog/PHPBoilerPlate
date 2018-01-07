<?php

if (!isset($msg)) {
    $msg="";
}
$msgtype= 'info';
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'] ;
}
if (isset($_SESSION['msgtype'])) {
    $msgtype = $_SESSION['msgtype'] ;
}

$smarty->assign("msg", $msg);
$smarty->assign("msgtype", $msgtype);

$smarty->assign("debugout", "");
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display("msgout.tpl");
