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
    die(_('Security check failed, token missing'));
}
$tokencheck = checkCSRFToken($_REQUEST['token']);
if (!$tokencheck) {
    die(_('Security check failed'));
}
/**
 *     USER ROLE
 *     The next few lines extracting the role of the current ajax requestor
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
if (!$hasrightrole) {
    die(_('Not the right role'));
}
/**
 *     Maybe it's even the root admin
*/
$selfroot = fIsRootRole($tc);

/**
 *     Let's start
 *     The template needs to be in the  app/template_ajax dir
*/
$template = "docman.ajax";
/**
 *      If you don't need the template engine for your request output, set $nooutput to true
*/
$nooutput = false;

/**
 *      Add your logic below. For example using the action-field to decide what to do
 *
*/
$docsecs = DB::query("Select * from docusections");
for ($x=0;$x<count($docsecs);$x++) {
    $item = $docsecs[$x];
    $docsections[$item['id']] = $item;
}
foreach ($docsections as $key => $item) {
    $ds[$key] = getEndLabel($key, $docsections, "", "sectionlabel", "parentid", " --");
}


if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (strpos($action, "_")) {
        list($action, $actid) = explode("_", $action);
    }

    switch ($action) {
// doctable
        case "doctable":
            $alldocs = DB::query("Select * from docu");
            for ($x=0;$x<count($alldocs);$x++) {
                $alldocs[$x]['desc'] = base64_decode($alldocs[$x]['desc']);
            }
            $smarty->assign("doctable", $alldocs);
        break;
// docid
        case "docid":
             $doc= DB::queryFirstRow("Select * from docu WHERE id = %i", $actid);
             $doc['desc'] = base64_decode($doc['desc']);
             $smarty->assign("doc", $doc);
             $smarty->assign("showform", 1);
             $smarty->assign("docsecs", $ds);
        break;
// newdoc
        case "newdoc":
             $smarty->assign("showform", 1);
             $smarty->assign("docsecs", $ds);
        break;
// addsection
        case "addsection":
             $smarty->assign("docsecs", $ds);
             $smarty->assign("shownewsecform", "1");
        break;
// addsection
        case "addsectiondo":
            DB::query("Insert into docusections (parentid, sectionlabel, sectiondesc) VALUES (%i,%s,%s)", $_REQUEST['parent'], $_REQUEST['seclabel'], $_REQUEST['secdesc']);
            $nooutput = true;
            echo "OK";
        break;
        case "savedoc":
//            print_r($_REQUEST);
            
            $doctitle = $antiXss->xss_clean($_REQUEST['topic']);
            $doccont =  $antiXss->xss_clean(base64_decode($_REQUEST['desc64']));
            $doccont = base64_encode($doccont);
            $data = array(
                        'section' => $_REQUEST['section'],
                        'topic'     => $doctitle,
                        'desc' => $doccont,
                        'further' => $_REQUEST['further']
                    );

            if ($_REQUEST['id'] == -1) {
                DB::insert("docu", $data);
            } else {
                DB::update("docu", $data, "id=%i", intval($_REQUEST['id']));
            }
            $nooutput = true;
        
        
    } // end action switch
} // end if action






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
