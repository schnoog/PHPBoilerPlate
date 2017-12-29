<?php


function GetRoutedPage($preset=""){
    global $Settings;
    global $GlobalOutput;
    //here the magic happens and $page get a value
if (isset ($_GET['params']) && strlen($_GET['params'])>0){
    $pageset = $_GET['params'];
           if (strpos($pageset,"/")){
                $subset = explode("/",$pageset);
                $page = $subset[0];
        
           }else{
            $page = $pageset;
           }
    }else{
            $page = $Settings['pages']['landingpage'];  
}

if (isset($_POST) && count($_POST) > 0){
    $safe = false;
        if (isset($_POST['token'])){
//            if ($_POST['token'] === $secdata['curruser']['token']) $safe = true;
            $checklvl =  checkCSRFToken ($_POST['token']);
            if ($checklvl) $safe = true;        
                    
        } 
    if (!$safe) {$page = $Settings['pages']['fatalpage'];
        $GlobalOutput['problem'][] = _('Security check failed.');
        $GlobalOutput['solution'][] = _('Please reload the page and try it again.');
        return $page;  
    } 
}

if ( IsPageBlockedByACL($page)){
        $page = $Settings['pages']['noaccess'];
        $GlobalOutput['problem'][] = _("You're not allowed to enter this page.");
        $GlobalOutput['solution'][] = _('Beg to the admin to receive more power.');    
        return $page;
}
//finaly we have $page, which should be the name of the target $page.php ( and for ease also $page.tpl )
$hitpage=array();
foreach (glob(PAGE_DIR . '/*.php') as $filename)
{
    $madepage =  base64_encode( basename($filename,".php"));
    if ($madepage === base64_encode($page)) $hitpage[] = $filename;
}

if (count($hitpage)== 1){ // page found, so include it
    return $page;
}else{                                                                      //Page not found, include from settings
    $GlobalOutput['problem'][] = _('Page not found.');
    $GlobalOutput['solution'][] = _('Just visit an other page that exists.');
    $page = $Settings['pages']['notfound'];
    return $page;    
}
    
    
    
    
    
    
}