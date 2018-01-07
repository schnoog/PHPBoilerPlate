<?php







$tmp = GetClassConstants("\Delight\Auth\Role");


$data = print_r($tmp, true);
$data .= "<hr>" . print_r($_SESSION, true);


$res = DB::query('Select * from users');
$data .= "<hr>" . print_r($res, true);











$smarty->assign("debugout", $data);
$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display("debugout.tpl");
