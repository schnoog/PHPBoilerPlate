<?php

/**
 * Default template for the ajax backend
 *
 */


/** Including the basics */
require_once("../../vendor/autoload.php");
define('FRONTEND_DIR', __DIR__);
require_once  '../../app/bootstrap_ajax.php';
/** Debug or not... all a question of the settings */
if (DEBUGOUT) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
/**
 *     SECURITY CHECK
 *     Each request need to contain a valid token to avoid CSRF attacks
 *     At this point, only the validity of the token is checked
 *
 *     Don't remove this
*/
if (!isset($_REQUEST['token'])) {
    die("Security check failed, token missing");
}
$tokencheck = checkCSRFToken($_REQUEST['token']);
if (!$tokencheck) {
    die(_('Security check failed'));
}
/**
 *     USER ROLE
 *     The next few lines extracting the role and the userid of the current ajax requestor
*/
list($dp, $tc, $userid)= explode(":", $tokencheck);
$ajaxuserrole = $tc;
/**
 *     The next line will block not logged in user.
 *     Only uncomment it when you want to keep them out
*/
//if ($tc == -1) die ("Security check failed, no guest access");
/**
 *     There are some admin roles defined in the main settings
 *     The following lines will check if the ajax request was made by one of them
*/
$hasrightrole = false;
for ($x=0;$x < count($Settings['admin']['adminroles']);$x++) {
    if ($tc & $Settings['admin']['adminroles'][$x]) {
        $hasrightrole= true;
    }
}
//if (!$hasrightrole) die (_('Not the right role'));
/**
 *     Maybe it's even the root admin
*/
$selfroot = fIsRootRole($tc);

/**
 *     Let's start
 *     The template needs to be in the  app/template_ajax dir
*/
$template = "profile_extended.ajax";
/**
 *      If you don't need the template engine for your request output, set $nooutput to true
*/
$nooutput = false;

/**
 *      Add your logic below. For example using the action-field to decide what to do
 *
*/
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (strpos($action, "_")) {
        list($action, $actid) = explode("_", $action);
    }

    switch ($action) {
        case "singleset":
            $sets = new Usersettings($userid);
            $sets->parseUserIn();
            $allsettings = $sets->getSettings($actid);
            //$nooutput = true;
            $dump = "<pre>" . print_r($allsettings, true) . "</pre>";
            $smarty->assign("dump", $dump);
           // for ($x= 0;$x < count($allsettings);$x++){
                foreach ($allsettings as $mkey => $sett) {
                    // $sett = $allsettings[$x];
                    $fulldata['id'] = $sett['id'];
        
                    $fulldata['usersetting_key'] = str_replace(" ", "_", $sett['usersetting_key']);
                        
                    $fulldata['usersetting_desc'] = $sett['usersetting_desc'];
                        
                    $fulldata['usersetting_default'] = $sett['usersetting_default'];
                        
                    $fulldata['value'] = $sett['usersetting_default'];
                    if (strlen($sett['value'])>0) {
                        $fulldata['value'] = $sett['value'];
                    }
                        
                    $fulldata['fieldparameter'] = getFormvalidatorString($sett['usersetting_typevaliparameter']);
                        
                    $fulldata['usersetting_required'] = $sett['usersetting_required'];
                        
                    $fulldata['usersetting_preset'] = "";
                    if (strlen($sett['usersetting_preset'])> 0) {
                        $fulldata['usersetting_preset'] = getBS4Control($sett['usersetting_preset'], $fulldata['usersetting_key'], $sett['usersetting_limittopreset'], $fulldata['value'], $fulldata['fieldparameter']);
                    }
        
                    $fulldata['usersetting_limittopreset'] = $sett['usersetting_limittopreset'];
                        
                    $fulldata['settingset'] = 0;
                    if (isset($sett['settingset'])) {
                        $fulldata['settingset'] = $sett['settingset'];
                    }
                        
                    $setlist[] = $fulldata;
                    //getFormvalidatorString($validationstring,$preset='',$onlypreset='')
                }
            $smarty->assign("setpoint", $setlist);
            
            //$nooutput  = true;
            //$smarty->assign("sectoken",$_REQUEST['token']);
            //$tmpout = $smarty->fetch($template . ".tpl");
            //echo base64_encode($tmpout);
            //$smarty->display($template . ".tpl");
        
        break;
/////////////////
 
        case "showsettings":
            $sets = new Usersettings($userid);
            $sets->parseUserIn();
            $allsettings = $sets->getSettings();
            //$nooutput = true;
            $dump = "<pre>" . print_r($allsettings, true) . "</pre>";
            $smarty->assign("dump", $dump);
           // for ($x= 0;$x < count($allsettings);$x++){
                foreach ($allsettings as $mkey => $sett) {
                    // $sett = $allsettings[$x];
                    $fulldata['id'] = $sett['id'];
        
                    $fulldata['usersetting_key'] = str_replace(" ", "_", $sett['usersetting_key']);
                        
                    $fulldata['usersetting_desc'] = $sett['usersetting_desc'];
                        
                    $fulldata['usersetting_default'] = $sett['usersetting_default'];
                        
                    $fulldata['value'] = $sett['usersetting_default'];
                    if (strlen($sett['value'])>0) {
                        $fulldata['value'] = $sett['value'];
                    }
                        
                    $fulldata['fieldparameter'] = getFormvalidatorString($sett['usersetting_typevaliparameter']);
                        
                    $fulldata['usersetting_required'] = $sett['usersetting_required'];
                        
                    $fulldata['usersetting_preset'] = "";
                    if (strlen($sett['usersetting_preset'])> 0) {
                        $fulldata['usersetting_preset'] = getBS4Control($sett['usersetting_preset'], $fulldata['usersetting_key'], $sett['usersetting_limittopreset'], $fulldata['value'], $fulldata['fieldparameter']);
                    }
        
                    $fulldata['usersetting_limittopreset'] = $sett['usersetting_limittopreset'];
                        
                    $fulldata['settingset'] = 0;
                    if (isset($sett['settingset'])) {
                        $fulldata['settingset'] = $sett['settingset'];
                    }
                        
                    $setlist[] = $fulldata;
                    //getFormvalidatorString($validationstring,$preset='',$onlypreset='')
                }
            $smarty->assign("setlist", $setlist);
        
        break;
        
//
        case "savesetting":
            $nooutput = true;
            echo "<pre>" . print_r($_REQUEST, true) . "</pre>";
            $us = new Usersettings($userid);
            $us->parseUserIn();
            $setval = $antiXss->xss_clean($_REQUEST['setval']);
            $tmp = $us->saveUserSettingIfValid(intval($_REQUEST['setkey']), $setval);
            if (!$tmp) {
                echo "ERR";
            } else {
                echo "OK";
            }
            
            
            
            
            
        
        break;

//
        
    } // end action switch
}

/**
 *
 *   Now parse the template if nooutput is false
 *
*/

GoToGeneralOutput:
if (!$nooutput) {
    //$smarty->assign("debugout",$data);
    $smarty->assign("sectoken", $_REQUEST['token']);
    $smarty->display($template . ".tpl");
}
