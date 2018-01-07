<?php

/**
 * Template for standard pages
 * You have to chose whether you will use the ACL or not
 * -ACL: You don't need to add anything here.
 *  But be careful: Unless you've set the access groups, the page is accessible to everyone
 * -NoACL but admin only:
 * Use the following lines to
 * (1) deny access to anyone not logged in
 * (2) deny access to anyone not in the admin groups (see main settings)
 * 1)if (!$auth->isLoggedIn()) forwartTo($Settings['pages']['noaccess']);
 * 2)if (!$_SESSION['isadmin']) forwartTo($Settings['pages']['noaccess']);
 *
 *
 */

if (!$auth->isLoggedIn()) {
    forwartTo($Settings['pages']['noaccess']);
}




list($lg, $ct) = explode('_', $Settings['langs']['active']);
$vallang="en";
if (strpos(':ro:dk:no:nl:cz:ca:ru:it:fr:de:se:en:pt', $lg)) {
    $vallang = $lg;
}

$pagedata['vallang'] = $vallang;


/**
 *  You need to set an ajax backend, which is used with its FQDN (https://xxx.yy/backend.php)
*/
$pagedata['ajaxbackend'] = 'ajaxbe_'.$page.'.php';
/**
 *  This page uses an extra CSS file, which is not required by the other pages?
 *  Then include it here. One, five, ten? It's up to you
*/
//$pagedata['headincludes']['css'][] = 'jquery.nestable.css';
/**
 *  This page uses an extra javascript library, which is not required by the other pages?
 *  Then include it here. One, five, ten? It's up to you
*/
$pagedata['footincludes']['js'][]= 'form-validator/jquery.form-validator.min.js';
/**
 *  Incluse a js-template
 *  This can, for example hold all JS functions and calls for the current page
 *  This will be the last "input" before </body>
*/
$pagedata['js_to_include'] = 'js_' . $page . '.tpl';
/**
 *
 *  If you're using a DOM element to place your output,you can set the div id here
 *
*/
 $pagedata['replaceid'] = "maincontainer";
 
 
 
 
 
 
/*
            $sets = new Usersettings($auth->getUserId());
            $sets->parseUserIn();
            $allsettings = $sets->getSettings();
            //$nooutput = true;
            $dump = "<pre>" . print_r( $allsettings , true) . "</pre>";
            $smarty->assign("dump",$dump);
           // for ($x= 0;$x < count($allsettings);$x++){
                foreach($allsettings as $mkey => $sett){
               // $sett = $allsettings[$x];
                        $fulldata['id'] = $sett['id'];

                        $fulldata['usersetting_key'] = $sett['usersetting_key'];

                        $fulldata['usersetting_desc'] = $sett['usersetting_desc'];

                        $fulldata['usersetting_default'] = $sett['usersetting_default'];

                        $fulldata['value'] = $sett['usersetting_default'];
                        if(strlen($fulldata['value'])>0)$fulldata['value'] = $sett['value'];

                        $fulldata['fieldparameter'] = getFormvalidatorString($sett['usersetting_typevaliparameter']);

                        $fulldata['usersetting_required'] = $sett['usersetting_required'];

                        $fulldata['usersetting_preset'] = "";
                        if (strlen($sett['usersetting_preset'])> 0){
                        $fulldata['usersetting_preset'] = getBS4Control($sett['usersetting_preset'],$fulldata['usersetting_key'],$sett['usersetting_limittopreset'],$fulldata['value'],$fulldata['fieldparameter']);
                        }

                        $fulldata['usersetting_limittopreset'] = $sett['usersetting_limittopreset'];

                        $fulldata['settingset'] = 0;
                        if(isset($sett['settingset']))$fulldata['settingset'] = $sett['settingset'];

                        $setlist[] = $fulldata;
                //getFormvalidatorString($validationstring,$preset='',$onlypreset='')
            }
            $smarty->assign("setlist",$setlist);
*/
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
