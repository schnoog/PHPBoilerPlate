<?php

if (!$auth->isLoggedIn()) forwartTo($Settings['pages']['noaccess']);
if (!$_SESSION['isadmin']) forwartTo($Settings['pages']['noaccess']);

$data ='';

$data .= "<hr>" . print_r($_SESSION,true);
$data .= "<hr>" . print_r($smarty,true);

$userdump = DB::query('Select * from users ORDER by username ASC');

//$roleflag = $_REQUEST['num'];
//$rr = fGetRolesByFlag($roleflag);
//$data .= "<hr>" . print_r($rr,true) . "<hr>" . fGetStatusByNum(0);


$pagedata['navset'] = getNavTree4DragAndDrop(0);














$pagedata['headincludes']['css'][] = 'jquery.nestable.css';
$pagedata['headincludes']['css'][] = 'datatables.min.css';
//$pagedata['footincludes']['js'][]= 'jquery-ui.min.js';
$pagedata['footincludes']['js'][]= 'jquery.nestable.js';
$pagedata['footincludes']['js'][]= 'datatables.min.js';



$pagedata['js_to_include'] =  'js_admin_sysman.tpl';
$pagedata['replaceid'] = "usertable";
$pagedata['ajaxbackend'] = 'ajax_syswork.php';
//$data .= "<hr><pre>" . print_r($userlist,true)  ."</pre>";







$data="";
$smarty->assign("debugout",$data);
$smarty->assign("sectoken",$secdata['curruser']['token']);
$smarty->assign("navdata",$navdata);
$smarty->assign("pagedata",$pagedata);
$smarty->display($page . ".tpl");