<?php
////////////////////////////////////////////////
function buildTree(&$elements, $parentId = 0) {   //pass main array by reference
    $branch = array();

    foreach ($elements as $key => $element) {
        if ($element['parentid'] == $parentId) {

            $element['children'] = buildTree($elements, $element['id']);

            $branch[] = $element;                 
        }
    }
    return $branch;
}

////////////////////////////////////////////////
function makeNested($source, $parentidfield = 'parentid') {
	$nested = array();

	foreach ( $source as &$s ) {
		if ( (is_null($s[$parentidfield])) or ($s[$parentidfield] == -1)  ) {
			// no parent_id so we put it in the root of the array
            
			$nested[] = &$s;
		}
		else {
			$pid = $s[$parentidfield];
			if ( isset($source[$pid]) ) {
				// If the parent ID exists in the source array
				// we add it to the 'children' array of the parent after initializing it.

				if ( (!isset($source[$pid]['children']))  ) {
					$source[$pid]['children'] = array();
				}

				$source[$pid]['children'][] = &$s;
			}
		}
	}
	return $nested;
}

////////////////////////////////////////////////
function getEndLabel($id,$dataarray,$enlarge="",$labelfield="sectionlabel",$parentfield="parentid",$delimiter="-"){
    if (strlen($enlarge)>0 )$enlarge = $delimiter . $enlarge;
    $enlarge = $dataarray[$id][$labelfield] . $enlarge;
    if ($dataarray[$id][$parentfield] > -1){
        $tmp = getEndLabel($dataarray[$id][$parentfield],$dataarray," ",$labelfield,$parentfield,$delimiter);
        $enlarge = $tmp . $enlarge;
    } 

    return $enlarge;
}
////////////////////////////////////////////////
function forwartTo($url =""){
    global $Settings;
    if (strlen($url)==0)$url = $Settings['page']['baseurl'];
    header("Location: " . $url); 
    exit; 
}
////////////////////////////////////////////////
function br2nl($html){
    $nl = preg_replace('#<br\s*/?>#i', "\n", $html);
    return $nl;
}
////////////////////////////////////////////////
function validate_username($str) {

  // each array entry is an special char allowed
  // besides the ones from ctype_alnum
  $allowed = array(".", "-", "_" , " ");
  $check = str_replace($allowed, '', $str );
  if ( ctype_alnum( $check ) ) {
    return true;
  } else {
    return false;
  }
}
////////////////////////////////////////////////
function GetClassConstants($sClassName) {
    $oClass = new ReflectionClass($sClassName);
    return $oClass->getConstants();
}
////////////////////////////////////////////////
function fGetRolesByFlag($roleflag,$bolNameIndex = false){
    $tmp = GetClassConstants("\Delight\Auth\Role");
    $ret=array();
    if ($roleflag == 0) return $ret;
    foreach ($tmp as $rolename => $value){
     if(!$bolNameIndex)if ($roleflag & $value) $ret[] = $rolename;
     if($bolNameIndex)if ($roleflag & $value) $ret[] = $value;
    }
    return $ret;
}
////////////////////////////////////////////////
function fGetRoles(){
    global $Settings;        
    $tmp = GetClassConstants("\Delight\Auth\Role");
    $ret=array();
    foreach ($tmp as $rolename => $value){
        if(in_array($value,$Settings['roles']['available']))  $ret[$value] = $rolename;   
    }        
    return $ret;
}
////////////////////////////////////////////////
function fGetRoleSum(){
    global $Settings;        
    $tmp = GetClassConstants("\Delight\Auth\Role");
    $ret=0;
    foreach ($tmp as $rolename => $value){
        if(in_array($value,$Settings['roles']['available']))  $ret = $ret + $value;   
    }        
    return $ret;
}

////////////////////////////////////////////////
function fIsRootRole($roleflag){
    global $Settings;
    if ($roleflag & $Settings['admin']['rootrole']) return true;
    return false;
}

////////////////////////////////////////////////

////////////////////////////////////////////////
function fGetStati(){
        $tmp = GetClassConstants("\Delight\Auth\Status");
    foreach ($tmp as $rolename => $value){
        $ret[$value]=$rolename;
    }
return $ret;
}
////////////////////////////////////////////////


function fGetStatusByNum($statusflag){
    $tmp = GetClassConstants("\Delight\Auth\Status");
    $ret="unregistered";
    foreach ($tmp as $rolename => $value){
           if ($statusflag == $value) $ret = $rolename;
    }
    return $ret;
}

////////////////////////////////////////////////
function changeDisplayName($userId,$newname){
    global $Settings;
//    $res = DB::queryFirstRow("Select * from users WHERE username =")
    $connstring = $Settings['db']['dbdriver'] . ":host=" . $Settings['db']['host'] . ";dbname=" . $Settings['db']['dbname'] .";charset=utf8mb4" ; 
    $conn = new PDO($connstring, $Settings['db']['user'], $Settings['db']['password']);
    $conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                 $sql = 'UPDATE users SET username = :newname WHERE id = :userid ;';
                 $statement = $conn->prepare($sql);
                 $statement->bindValue(":newname", $newname);
                 $statement->bindValue(":userid", $userId);
                 $count = $statement->execute();
                 $conn = null;        // Disconnect
                 return true;                
            }
            catch(PDOException $e) {
              echo $e->getMessage();
              return false;
            }
}
////////////////////////////////////////////////
function replace_in_file($FilePath, $OldText, $NewText)
{
    $Result = array('status' => 'error', 'message' => '');
    if(file_exists($FilePath)===TRUE)
    {
        if(is_writeable($FilePath))
        {
            try
            {
                $FileContent = file_get_contents($FilePath);
                $FileContent = str_replace($OldText, $NewText, $FileContent);
                if(file_put_contents($FilePath, $FileContent) > 0)
                {
                    $Result["status"] = 'success';
                }
                else
                {
                   $Result["message"] = 'Error while writing file';
                }
            }
            catch(Exception $e)
            {
                $Result["message"] = 'Error : '.$e;
            }
        }
        else
        {
            $Result["message"] = 'File '.$FilePath.' is not writable !';
        }
    }
    else
    {
        $Result["message"] = 'File '.$FilePath.' does not exist !';
    }
    return $Result;
}
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////






?>