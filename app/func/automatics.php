<?php


function createEmptyPage($pagename,$bolWithAjax = false){
    $pagename = strtolower($pagename);
    $emptypage = PAGE_DIR . '/_emptypage.php.raw' ;
    $emptytpl = MAINTEMPLATE_DIR . '/_emptypage.tpl.raw' ;
    $targetpage = PAGE_DIR . '/' . $pagename . '.php';
    $targettpl = MAINTEMPLATE_DIR . '/' . $pagename . '.tpl';

    if (!file_exists($targetpage)) copy ($emptypage,$targetpage);
    if (!file_exists($targettpl)) copy($emptytpl,$targettpl);
    if (file_exists($targetpage) && file_exists($targettpl)) {

        if ($bolWithAjax) createAjaxBackend($pagename);
        
        return "Page and template for $pagename created";
    }
    return "Page not created";
}





function createAjaxBackend($pagename){
    $ajaxtpl   = AJAXTEMPLATE_DIR . "/_empty_ajax.tpl.raw";
    $ajax      = AJAXTEMPLATE_DIR . "/" . $pagename . ".ajax.tpl";
    if(!file_exists($ajax)) copy($ajaxtpl,$ajax);
    error_log("AjaxFEDir: " . AJAXFRONTEND_DIR);
    $ajaxbetpl = AJAXFRONTEND_DIR . "/_emptyajax.php.raw";
    $ajaxbe    = AJAXFRONTEND_DIR . '/ajaxbe_'.$pagename.'.php';
    if (!file_exists($ajaxbe)) copy($ajaxbetpl,$ajaxbe);
    $jstpl = MAINTEMPLATE_DIR . "/_emptyjsinclude.tpl.raw";
    $js    = MAINTEMPLATE_DIR .  '/js_' . $pagename . '.tpl';
    if (!file_exists($js)) copy($jstpl,$js);
$targetpage = PAGE_DIR . '/' . $pagename . '.php';
replace_in_file($targetpage,'//AJAXBE ','');
replace_in_file($targetpage,'//OWNJS ','');
replace_in_file($targetpage,'//MAINDIV','');
replace_in_file($ajaxbe,'<<<<PAGENAME>>>>',$pagename . '.ajax');
}





















?>