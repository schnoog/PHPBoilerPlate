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
////if (!$hasrightrole) die ("Not the right role");
/**
 *     Maybe it's even the root admin
*/
$selfroot = fIsRootRole($tc);

/**
 *     Let's start
 *     The template needs to be in the  app/template_ajax dir
*/
$template = "start.ajax";
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
        list($action, $para) = explode("_", $action);
    }
    
    switch ($action) {
// getdoclist
        case "getdoclist":
        $nooutput = true;
        print_r($_REQUEST);
        break;
// getsections
        case "getsections":
            $docr = DB::query("Select * from docu");
            for ($x=0;$x<count($docr);$x++) {
                $docs[$docr[$x]['section']][]  = $docr[$x];
            }
            
            foreach ($docs as $key => $doc) {
                $tmp = "<ul>";
                for ($x=0;$x<count($doc);$x++) {
                    $tmp .= "<li>" . "<a href='#' onclick='openelement(\"opendoc_".$doc[$x]['id']."\",\"docdetail\");'>".$doc[$x]['topic'] . "</a></li>";
                }
                $tmp .= "</ul>";
                $sectionitems[$key] = base64_encode($tmp);
            }

            $docsecs = DB::query("Select * from docusections");
            for ($x=0;$x<count($docsecs);$x++) {
                $item = $docsecs[$x];
                $docsections[$item['id']] = $item;
                $docsections[$item['id']]['docs'] = "";
                if (isset($sectionitems[$item['id']])) {
                    $docsections[$item['id']]['docs'] = $sectionitems[$item['id']];
                }
            }
            
            $sectree = buildTree($docsections, -1);
            $html = makeChild($sectree[0], true) ;
            $nooutput = true;
            echo $html;
        break;
//opendoc
        case "opendoc":
            $docsecs = DB::query("Select * from docusections");
            for ($x=0;$x<count($docsecs);$x++) {
                $item = $docsecs[$x];
                $docsections[$item['id']] = $item;
            }
            foreach ($docsections as $key => $item) {
                $ds[$key] = getEndLabel($key, $docsections, "", "sectionlabel", "parentid", "--");
            }
        
            $docid = $para;
            $document = DB::queryFirstRow("Select * from docu WHERE id = %i", $para);
            $document['sectionpath'] = $ds[$document['section']];
            $smarty->assign("document", $document);
            //$document['sectionpath']=
            
            
            
        
        break;

//
        
        
    } // end action switch
}

///////-----------------------------------
function makeChild($array, $bolfirst=false)
{
    $r = '';
    if ($bolfirst) {
        $r .= "<ul>";
    }
    $plus = (strlen($array['docs'])>0 ? "<b>+</b>" : "");
    $r .= "\n\t<li class='coll'>".$plus . $array['sectionlabel'] .  "" . base64_decode($array['docs']) ."</li>";
    //  $r .= "\n\t<li><a href=\"" . $array['id'] . "\">" . $array['sectionlabel'] .  "</a>" . base64_decode($array['docs']) ."</li>";

    //  $r = "\n\t<li><a href=\"${array[ItemLink]}\">${array[ItemText]}</a></li>";
    if (count($array['children']) > 0) {
        foreach ($array['children'] as $child) {
            $r .= '<li><ul>' . makeChild($child) . '</ul></li>';
        }
    }
    if ($bolfirst) {
        $r .= "</ul>";
    }
    return $r;
}

///////-----------------------------------






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
