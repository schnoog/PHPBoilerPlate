<?php

$validationstring = 'required|date[DD-MM-YYYY]|exactlength[5]';
$validationstring = 'required|numeric';
$tmp = getFormvalidatorString($validationstring,$preset='',$onlypreset='');
$data = $tmp;
//$dd = array("erster teil", "zweiter teil", "3.teil","4.teil", "5.teil");
//$data .= call_user_func_array("myte",$dd);

//function myte($passa, $passb = "", $passc = "" , $passd = ""){
//    return "MYTE: " . $passa ." - " . $passb . "- " . $passc . "- " . $passd . "- ";
//}

/*
$tmp = validatePostInput('token',"TOKEN",'alphanumeric|minlen[12]');
if ($tmp){
    $data .= "<h1>Valid</h1>";
}else{
        $data .= "<h1>Invalid</h1>";
}

//
//$flt[] = 'contains[abc]';
$flt[] = 'required';
//$flt[] = 'minlength[4]';
//$flt[] = 'maxlength[13]';
//$flt[] = 'exactlength[5]';
//$flt[] = 'lessthan[1234]';
$flt[] = 'greaterthan[-314]';
//$flt[] = 'inlist{red,blue,green}';
//$flt[] = 'integer';
$flt[] = 'numeric';

$filt = implode('|',$flt);

//$filt = 'required|minlength[8]|numeric|maxlength[12]|lessthan[1234]|greaterthan[-314]';
$data = "Ruleset: ".$filt."<br/>Resulting html control tags: <br />"; 
$data .= getFormvalidatorString($filt);
$data .= "<br />";
*/

$data = "<pre>" . print_r($_SESSION,true) . "</pre>";
//$data = "<pre>" . print_r($auth,true) . "</pre>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//$tmp  = $_SESSION;
//$data = "<pre>" . print_r($tmp,true). "</pre>";
//$data .= "<h1>" . _('Delete this user') . "</h1>";

$smarty->assign("debugout",$data);
$smarty->assign("sectoken",$secdata['curruser']['token']);
$smarty->assign("navdata",$navdata);
$smarty->assign("pagedata",$pagedata);
$smarty->display("debugout.tpl");