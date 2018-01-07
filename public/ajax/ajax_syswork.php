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

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (strpos($action, "_")) {
        list($action, $actid) = explode("_", $action);
    }
}

if (isset($_POST['action'])) {
    switch ($action) {
////////////////////////////////////////////////////////////// +++Navigation
//navtree
            case "navtree":
                    $nooutput = true;
                    $minParent = DB::queryFirstField("Select MIN(nav_parentid) from nav ");
                    $tmp= getNavTree4DragAndDrop($minParent);
              echo $tmp;
            break;
//editform
            case "editform":
                    $id = $_REQUEST['id'];
                    $dump = DB::queryFirstRow("Select * from nav WHERE id = %i", $id);
                    $maxrole = fGetRoleSum();

                        if ($dump['nav_allowedmask'] == 0) {
                            $dump['nav_allowedmask'] = $maxrole;
                        }
                            $dump['nav_allowedmask_array'] = fGetRolesByFlag($dump['nav_allowedmask'], true);
                        
                   
                    $displayData = $dump;
                    $dump = DB::query("Select id, nav_title from nav ORDER by nav_parentid ASC, nav_sort ASC");
                    for ($x=0;$x<count($dump);$x++) {
                        $navitems[$dump[$x]['id']] = $dump[$x]['nav_title'];
                    }
                    $dump = DB::query("Select * from nav_types");
                    for ($x=0;$x<count($dump);$x++) {
                        $navtypes[$dump[$x]['id']] = $dump[$x]['navtype'];
                    }
                    
                    
                    $template = "admin_sys_naveditbox";
                    $roles = fGetRoles();
                    
                    //$smarty->assign("stati",$stati);
                    $smarty->assign("roles", $roles);
                    $smarty->assign("nav", $displayData);
                    $smarty->assign("navtypes", $navtypes);
                    $smarty->assign("navitems", $navitems);

                    break;
//navsave
            case "navsave":
                    $data = $_REQUEST['nav'];
                    $nooutput = true;
                    $savedata = json_decode($data, true);
                    for ($x=0;$x < count($savedata);$x++) {
                        $item = $savedata[$x];
                        $setid = intval($item['id']);
                        $setparent = 0;
                        if (strlen($item['parent_id'])>0) {
                            $setparent = intval($item['parent_id']);
                        }
                        $setsort = intval($item['rgt']);
                        DB::update('nav', array(
                                 'nav_parentid' => $setparent,
                                 'nav_sort' => $setsort
                            ), "id=%i", $setid);
                    }
                    echo "<h2>Navigation updated</h2>";
            break;
//emptyact
            case "emptyact":
                        $template = 'admin_sys_navact';
            break;
//savenavitem
            case "savenavitem":
                        $nooutput = true;
                            $save['nav_title'] = $_REQUEST['nav_title'];
                            $save['nav_desc'] = $_REQUEST['nav_desc'];
                            $save['nav_parentid'] = $_REQUEST['nav_parentid'];
                            $save['nav_target'] = $_REQUEST['nav_target'];
                            $save['nav_active'] = $_REQUEST['nav_active'];
                            $save['nav_sort'] = 5;
                            if (isset($_REQUEST['nav_sort'])) {
                                $save['nav_sort'] = intval($_REQUEST['nav_sort']);
                            }
                            
                            $save['nav_allowedmask'] = 0;
                            if (isset($_REQUEST['nav_allowedmask'])) {
                                for ($x=0;$x<count($_REQUEST['nav_allowedmask']);$x++) {
                                    $save['nav_allowedmask'] += $_REQUEST['nav_allowedmask'][$x];
                                }
                            }
                            if (isset($_REQUEST['nav_id'])) {
                                $navid = intval($_REQUEST['nav_id']);
                                DB::update('nav', $save, "id=%i", $navid);
                            } else {
                                DB::insert('nav', $save);
                            }
            break;
//additemform
            case "additemform":
                            $template = 'admin_sys_navnewbox';
                            $dump = DB::query("Select id, nav_title from nav ORDER by nav_parentid ASC, nav_sort ASC");
                            for ($x=0;$x<count($dump);$x++) {
                                $navitems[$dump[$x]['id']] = $dump[$x]['nav_title'];
                            }
                            $dump = DB::query("Select * from nav_types");
                            for ($x=0;$x<count($dump);$x++) {
                                $navtypes[$dump[$x]['id']] = $dump[$x]['navtype'];
                            }
                            $smarty->assign("navtypes", $navtypes);
                            $smarty->assign("navitems", $navitems);
                            $roles = fGetRoles();
                            $smarty->assign("roles", $roles);
                            
            
            break;
//deleteitemform
            case "deleteitemform":
                    $nooutput = true;
                    $minParent = DB::queryFirstField("Select MIN(nav_parentid) from nav ");
                    $tmp= getNavTree4DragAndDropBlank($minParent);
                    //$repl = array("dd-item","dd-handle","dd-list");
                    //$tmp= str_replace($repl,"",$tmp);
              echo $tmp;
            break;
//deletenavitem
            case "deletenavitem":
                    $navid = $_REQUEST['navid'];
                    $nooutput = true;
                    $res = DB::queryFirstRow("Select * from nav WHERE id = %i", $navid);
                    DB::query("Delete from nav WHERE id = %i", $navid);
                    $minParent = DB::queryFirstField("Select MIN(nav_parentid) from nav");
                    DB::query("Update nav SET nav_parentid = %i WHERE nav_parentid = %i", $minParent, $res['id']);
                    
            break;
////////////////////////////////////////////////////////////// ---Navigation
//showpages
            case "showpages":
                    $template = 'admin_sys_pagelist';
                    $res = DB::query("Select * from pages ORDER by page ASC");
                    $smarty->assign('pagelist', $res);
                    $roles = fGetRoles();
                    $smarty->assign("roles", $roles);
            break;
//updatepages
            case "updatepages":
                    UpdatePageTable();
                    $template = 'admin_sys_pagelist';
                    $res = DB::query("Select * from pages ORDER by page ASC");
                    $smarty->assign('pagelist', $res);
                    $roles = fGetRoles();
                    $smarty->assign("roles", $roles);
            break;
//showpageedit
            case "showpageedit":
                    $template = "admin_sys_pageedit";
                    $pageid = intval($_REQUEST['pageid']);
                    $pageitem = DB::queryFirstRow("Select * from pages WHERE id = %i", $pageid);
                    $pageitem['usermask_array'] =  fGetRolesByFlag($pageitem['usermask'], true);
                    $smarty->assign("page", $pageitem);
                    $roles = fGetRoles();
                    $smarty->assign("roles", $roles);
                    
            break;
//savepageitem
            case "savepageitem":
//                    $nooutput = true;
//                    echo "<pre>" . print_r($_REQUEST,true) . "</pre>";
                            $umask = 0;
                            if (isset($_REQUEST['usermask'])) {
                                for ($x=0;$x<count($_REQUEST['usermask']);$x++) {
                                    $umask += $_REQUEST['usermask'][$x];
                                }
                            }
                    $ndata = array(
                    "pagetitle" => $_REQUEST['pagetitle'],
                    "useacl" => $_REQUEST['useacl'],
                    "syspage" => $_REQUEST['syspage'],
                    "usermask" => $umask
                    );
                    $pageid = $_REQUEST['pageid'];
                    DB::update('pages', $ndata, "id=%i", $pageid);

/*    [pageid] => 2
    [pagetitle] => admin_userman Title
    [syspage] => 0
    [useacl] => 1
    [usermask] => Array
        (
            [0] => 1
            [1] => 2
        )
*/
                    $template = 'admin_sys_pagelist';
                    $res = DB::query("Select * from pages ORDER by page ASC");
                    $smarty->assign('pagelist', $res);
                    $roles = fGetRoles();
                    $smarty->assign("roles", $roles);
                    
                    
                    
                    
                    
                    
                    
            break;
////////////////////////////////////////////////////////////// +++Tools
            case "createpage":
                    $pagename= $_REQUEST['pagename'];
                    $withjs = true;
                    if (strlen($pagename)<3) {
                        $pagename= '!")(&%"';
                    }
                    if ($_REQUEST['withjs'] == "No") {
                        $withjs = false;
                    }
                    $done = _('Page creation failed.');
                    if (validate_username($pagename)) {
                        $done = createEmptyPage($pagename, $withjs);
                    } else {
                        $done = _('Invalid page name entered');
                    }
                    $nooutput = true;
                    echo $done;
            break;
            
            case "getusergroups":
                    $template = "admin_sys_tools";
                    $roles = fGetRoles();
                    $smarty->assign("getroles", "1");
                    $smarty->assign("roles", $roles);
                    
            break;

////////////////////////////////////////////////////////////// ---Tools
////////////////////////////////////////////////////////////// +++Profile fields
            case "getprofilefields":
                    $template = "admin_sys_profile";
                    $res = DB::query("Select * from user_settingkeys");
                    $smarty->assign("prolist", $res);
            break;
//
            case "addoreditfield":
                   $template = "admin_sys_profile";
                   $res = array();
                   $actid = intval($_POST['profileitem']);
                   if ($actid > 0) {
                       $res = DB::queryFirstRow("Select * from user_settingkeys WHERE id = %i", $actid);
                       $smarty->assign("prodata", $res);
                   }
                   $smarty->assign("editoradd", "1");
            
            break;
            
            case "savefield":
                    //$nooutput = true;
                    //error_log(print_r($_REQUEST,true) );
                    //$data = "<pre>" . print_r($_REQUEST,true)  . "</pre>";
                    $id = intval($_POST['id']);
                    $uskey = $antiXss->xss_clean($_POST['usersetting_key']);
                    $usdesc = $antiXss->xss_clean($_POST['usersetting_desc']);
                    $usdef = $antiXss->xss_clean($_POST['usersetting_default']);
                    AddStringToTranslation($usdesc);
                    $uskeyd = str_replace(" ", "_", $uskey);
                    AddStringToTranslation($uskeyd);
                    $ustype = $antiXss->xss_clean($_POST['usersetting_typevaliparameter']);

                    $usreq = intval($_POST['usersetting_required']);

                    $uspres = $antiXss->xss_clean($_POST['usersetting_preset']);

                    $uslim = intval($_POST['usersetting_limittopreset']);
                    
                    if ($id > 0) {
                        $sql = "Update user_settingkeys SET usersetting_key = %s, usersetting_desc = %s, usersetting_default = %s, 
                                                            usersetting_typevaliparameter = %s, usersetting_required = %i, usersetting_preset = %s ,
                                                            usersetting_limittopreset = %i WHERE id = %i ";
                        DB::query($sql, $uskey, $usdesc, $usdef, $ustype, $usreq, $uspres, $uslim, $id);
                    } else {
                        $sql = "INSERT into user_settingkeys (usersetting_key,usersetting_desc,usersetting_typevaliparameter,usersetting_required, 
                               usersetting_preset,usersetting_limittopreset) VALUES (%s,%s,%s,%i,%s,%i)";
                        DB::query($sql, $uskey, $usdesc, $usdef, $ustype, $usreq, $uspres, $uslim);
                    }
                    
                    
                    
                    $template = "admin_sys_profile";
                    $res = DB::query("Select * from user_settingkeys");
                    $smarty->assign("prolist", $res);
            break;
            
            case "deletefield":
                    $id = intval($_POST['profileitem']);
                    if ($id < 1) {
                        return false;
                    }
                    DB::query("Delete from user_settings WHERE settingkey = %i", $id);
                    DB::query("Delete from user_settingkeys WHERE id = %i", $id);
                    $template = "admin_sys_profile";
                    $res = DB::query("Select * from user_settingkeys");
                    $smarty->assign("prolist", $res);
            break;

////////////////////////////////////////////////////////////// ---Profile fields
////////////////////////////////////////////////////////////// +++Settings
////////////////////////////////////////////////////////////// ---Settings
//////////////////////////////////////////////////////////////
        
        
        
        
        
        
    }
}


GoToGeneralOutput:
if (!$nooutput) {
    //$smarty->assign("debugout",$data);
    $smarty->assign("sectoken", $_REQUEST['token']);
    $smarty->display($template . ".tpl");
}
