<?php

///////////////////////////////////////
function GenerateNavigation($debug=false)
{
    global $auth;
    if (!$auth->isLoggedIn()) {
        $rolemask = 0;
    } else {
        $rolemask = $_SESSION['auth_roles'];
    }
    $minParent = DB::queryFirstField("Select MIN(nav_parentid) from nav ");
    $navigation = display_children($debug, $rolemask, $minParent);
    return $navigation;
}
///////////////////////////////////////
function display_children($debug, $userrole, $parent, $level = 0)
{
    $sql = "SELECT a.*, Deriv1.Count FROM `nav` a  LEFT OUTER JOIN (SELECT nav_parentid, COUNT(*) AS Count FROM `nav` GROUP BY nav_parentid) Deriv1 ON a.id = Deriv1.nav_parentid WHERE a.nav_parentid =%i ORDER by a.nav_sort ASC";
    $rows = DB::query($sql, $parent);
    $ulcls = ($level == 0 ? ' class="navbar-nav"' : ' class="dropdown-menu"');
    $licls = ($level == 0 ? ' class="nav-item dropdown"' : '');
    $output[] = "<ul".$ulcls.">";
    for ($x=0;$x<count($rows);$x++) {
        $row = $rows[$x];
        
        if ($debug) {
            $display = true;
        } else {
            $display = false;
            if (($row['nav_allowedmask'] & $userrole) && ($row['nav_active'] == 1)) {
                $display = true;
            }
                
            if (($row['nav_allowedmask'] == 0) && ($row['nav_active'] == 1)) {
                $display = true;
            }
        }
            
        $tg ="";
        if ($row['nav_navtype'] == 2) {
            $tg = " target='_blank'";
        }
        if ($display) {
            if ($row['Count'] > 0) {        /// Has Childs
                $acls = ($level == 0 ? ' class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '  class="dropdown-item dropdown-toggle"');
                $output[] = "<li".$licls."><a".$acls." href='" . $row['nav_target'] . "' ".$tg.">" . $row['nav_title'] . "</a>";
                $output[] =  display_children($debug, $userrole, $row['id'], $level + 1);
                $output[] = "</li>";
            } elseif ($row['Count']==0) {   // No Childs
                $aendcls = ($level == 0 ? ' class="nav-link"' : ' class="dropdown-item"');
                $output[] = "<li".$licls."><a".$aendcls." href='" . $row['nav_target'] . "' ".$tg.">" . $row['nav_title'] . "</a></li>";
            } else ;
        }
    }
    $output[] = "  </ul>";
    return (implode(" \n", $output));
}
/////////////////////////////////////////


function getNavTree4DragAndDrop($parent, $level=0, $bolSub = false)
{
    $sql = "SELECT a.*, Deriv1.Count FROM `nav` a  LEFT OUTER JOIN (SELECT nav_parentid, COUNT(*) AS Count FROM `nav` GROUP BY nav_parentid) Deriv1 ON a.id = Deriv1.nav_parentid WHERE a.nav_parentid =%i ORDER by a.nav_sort ASC";
    $rows = DB::query($sql, $parent);
//     if(!$bolSub)error_log(print_r($rows,true));
    $output[] = ($bolSub ? "<ol class='dd-list'>" : "<div class='dd'><ol class='dd-list'>");
    // if(!$bolSub) $output[] = "<li class='dd-item' data-id='0'><div class='dd-handle'>Navigation Bar</div></li><ol>";
    for ($x=0;$x<count($rows);$x++) {
        $row = $rows[$x];

//        $row['nav_title'] = $row['nav_title'] .  getNavTreeEditActionButton($row['id']);
        $editbtn = getNavTreeEditActionButton($row['id']);
        if ($row['Count'] > 0) {        /// Has Childs
            $output[] = "<li class='dd-item' data-id='".$row['id']."'>". $editbtn  ."<div class='dd-handle'>" . $row['nav_title'] . "</div>" ;
            $output[] =  getNavTree4DragAndDrop($row['id'], $level + 1, true) ;
            $output[] =  "</li>";
        } else {   // No Childs
            $output[] = "<li class='dd-item' data-id='".$row['id']."'>". $editbtn  . "<div class='dd-handle'>"  . $row['nav_title'] . "</div>". "</li>";
        }
    }
   
    $output[] = "  </ol>";
    if (!$bolSub) {
        $output[] = "</div>";
    }
    return (implode(" ", $output));
}
/////////////////////////////////////////


function getNavTree4DragAndDropBlank($parent, $level=0, $bolSub = false)
{
    $sql = "SELECT a.*, Deriv1.Count FROM `nav` a  LEFT OUTER JOIN (SELECT nav_parentid, COUNT(*) AS Count FROM `nav` GROUP BY nav_parentid) Deriv1 ON a.id = Deriv1.nav_parentid WHERE a.nav_parentid =%i ORDER by a.nav_sort ASC";
    $rows = DB::query($sql, $parent);
//     if(!$bolSub)error_log(print_r($rows,true));
    $output[] = ($bolSub ? "<ol>" : "<ol>");
    // if(!$bolSub) $output[] = "<li>Navigation Bar</li><ol>";
    for ($x=0;$x<count($rows);$x++) {
        $row = $rows[$x];

//        $row['nav_title'] = $row['nav_title'] .  getNavTreeEditActionButton($row['id']);
        $editbtn = getNavTreeDeleteActionButton($row['id'], $row['nav_title']);
        if ($row['Count'] > 0) {        /// Has Childs
                $output[] = "<li>". $editbtn ;// . $row['nav_title']  ;
                $output[] =  getNavTree4DragAndDropBlank($row['id'], $level + 1, true) ;
            $output[] =  "</li>";
        } else {   // No Childs
            $output[] = "<li>". $editbtn   . "</li>";
        }
    }
   
    $output[] = "  </ol>";

    return (implode(" ", $output));
}
////////////////////////////////////////
function getNavTreeEditActionButton($id)
{
    $btn = " <button type='button' class='btn form-control' data-format='editnav' onclick='editnav(".$id.");' id='editbtn" . $id . "'>Edit</button>";
    return $btn;
}

function getNavTreeDeleteActionButton($id, $title="")
{
    $btn = " <button type='button' class='btn btn-danger form-control' data-format='editnav' onclick='deletenav(".$id.");' id='editbtn" . $id . "'><strong>$title</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delete this entry</button>";
    return $btn;
}
