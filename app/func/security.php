<?php


function md5x($stringGet){
    global $Settings;
    $costs = 2;
    if (!isset($Settings['security']['md5hashcost'])){
        if (intval($Settings['security']['md5hashcost'])>1) $costs = intval($Settings['security']['md5hashcost']);
    }
    $work = $stringGet;
    for($x=0;$x<$costs;$x++){
        $work = md5($work);
    }
return($work);
}

function getSubToken(){
    global $Settings;
    $userip = $_SERVER['REMOTE_ADDR'];
    return md5($Settings['security']['token']['salt'] . $userip);
}


function setCSRFToken(){
    global $secdata, $Settings, $auth,$pagedata;
    $roles = -1;
    $userid = 0;
        if ($auth->isLoggedIn()) {
            $roles = $_SESSION['auth_roles'];
            $userid = $auth->getUserId();
        } 
        $output = $roles . ":". $userid . ":" . md5x($roles . "::" . $userid . "::" . getSubToken() );
        $secdata['curruser']['token']= $output;
        $_SESSION['csfrtoken'] = $output;
        $pagedata['sectoken'] = $output;
        return $output;
}


function checkCSRFToken ($token,$check4admin=false){
    global $auth;
    if (strlen($token) < 33) return false;
    if (!strpos($token,":")) return false;
    list ($possiblerole,$userid,$sec) = explode(":",$token);
    if (!ctype_xdigit($sec)) return false;
    $check  = md5x($possiblerole . "::" . $userid  . "::" . getSubToken() );
    if ($check !== $sec) return false;
    return "OK:".$possiblerole . ":" . $userid;
}



function IsPasswordSafe($password){
    global $Settings;
    if (strlen(trim($password)) < $Settings['security']['pwminlength'] ) return false;

    if (!preg_match("#[0-9]+#", $password)) {
        return false;
    }
    if (!preg_match("#[a-zA-Z]+#", $password)) {
        return false;
    }     
   
    return $password;
}
