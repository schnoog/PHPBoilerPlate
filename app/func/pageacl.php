<?php






function IsPageBlockedByACL($page){
    $role=0;
    if (isset($_SESSION['auth_roles'])) $role= $_SESSION['auth_roles'];
    $pagerule = DB::queryFirstRow("Select * from pages WHERE page = %s",$page);
    if (count($pagerule)<1) return false;
    if ($pagerule['useacl'] == 0) return false;
    if ($pagerule['syspage'] == 1) return false;
    if ($pagerule['usermask'] == 0) return false;
    if ($role == 0) return true;
    if ( $pagerule['usermask'] & $role) return false;
    return true;
}


/////////////////////////////////////////////
function UpdatePageTable(){
    $tbls = DB::queryFirstColumn("Select page from pages");
    
foreach (glob(PAGE_DIR . '/*.php') as $filename)
{
    $madepage =   basename($filename,".php");
    if (!in_array($madepage,$tbls)){
        $data = array(
        	"page" => $madepage,
        	"pagetitle" => $madepage . " Title",
        	"useacl" => 0,
        	"syspage" => 0,
        	"usermask" => 0
        );
        DB::insert("pages",$data);
    }
}    
}
/////////////////////////////////////////////