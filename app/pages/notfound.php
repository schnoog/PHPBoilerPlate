<?php

if (count($GlobalOutput['problem']) >0) {
    $smarty->assign("problems", $GlobalOutput['problem']);
}
if (count($GlobalOutput['solution']) >0) {
    $smarty->assign("solutions", $GlobalOutput['solution']);
}




$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
