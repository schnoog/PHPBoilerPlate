<?php
////////////////////////////////////
function SetUserLang($setlang=""){
    global $Settings;
    $lang = "";
    if (isset($_SESSION['lang'])) $lang = $_SESSION['lang'];
    if (strlen($setlang)>4) $lang = $setlang;
    if (strlen($lang)< 4) $lang = $Settings['langs']['default'];
    $Settings['langs']['active'] = $lang;
    initialize_i18n('',$lang);
}
////////////////////////////////////
function AddStringToTranslation($stringToAdd){
    $translistfile = MAINTEMPLATE_DIR . "/do_not_edit.php";
    $stringToAdd = str_replace('"','&quot;',$stringToAdd);

    if( strpos(file_get_contents($translistfile),$stringToAdd) === false) {
    $tmp = '_("' .$stringToAdd.'");';
    $tmp .= "\n";
    file_put_contents($translistfile, $tmp, FILE_APPEND);
        $stringToAdd = str_replace(' ','_',$stringToAdd);
    $tmp = '_("' .$stringToAdd.'");';
    $tmp .= "\n";    
        file_put_contents($translistfile, $tmp, FILE_APPEND);
    
    error_log("Append $stringToAdd");        
    }else{
        error_log($stringToAdd . " Should be there");
    }
    

}


////////////////////////////////////
function ChangeLanguageDomain($newDomain=''){
    global $Settings;
    if(strlen($newDomain)< 1)$newDomain = $Settings['langs']['defaultdomain'];
    initialize_i18n($newDomain);
}
////////////////////////////////////
function logMissMatch($sString,$sLang="",$sDomain=""){
    global $Settings;
    error_log($sString);
    $outfile = LANGUAGEDIR . '/' . $sLang . '_parsed' . $sDomain . '.php';
    //$outfile = LANGUAGEDIR . '/langout.php';

    $tmp = '_("'.$sString.'")' . "\n";
    file_put_contents($outfile, $tmp, FILE_APPEND);    
}

///////////////////////////////////
function mygetText ($sString, $sDomain = '')
{       
    if (empty($sString))
    {
        return gettype ($sString);
    }
    global $Settings;
    if(strlen($sDomain)< 1)$sDomain = $Settings['langs']['defaultdomain'];
    if (!defined("LANGISSET"))initialize_i18n($sDomain);

    $sLang = $Settings['langs']['active'];
    $retstring = gettext($sString);
    if ($retstring == $sString) logMissMatch($sString,$sLang,$sDomain);
    // return, so that further modifiers could handle it
    return $retstring;
}
/////////////////////////////////////////////////////////////////
function initialize_i18n($sDomain='',$sLang='') {

error_log("Initialize Language " . $sLang);    
    global $Settings;
    define("LANGISSET","1");
    if(strlen($sDomain)< 1)$sDomain = $Settings['langs']['defaultdomain'];
    if(strlen($sLang)< 5) $sLang = $Settings['langs']['active'];
    
    //$sLang = "eng";
 
    $suff =  ".UTF-8";
    if (isset($_SERVER['WINDIR'])){
        if (strlen($_SERVER['WINDIR'])>1){
            $suff = "";
            switch($sLang){
                case "de_DE":
                    $sLang = "deu";
                break;
                
                case "en_GB":
                    $sLang = "eng";
                break;
                
                
                
            }
        }
    }

    $locale= $sLang;
    \Locale::setDefault(str_replace('_', '-', $sLang));
    putenv('LC_ALL='.$locale . $suff);
    putenv('LANG='.$locale . $suff);
    setlocale(LC_ALL,"");
    setlocale(LC_ALL,$locale .$suff);
    setlocale(LC_CTYPE,$locale .$suff);
    bindtextdomain($sDomain, LANGUAGEDIR);
    textdomain($sDomain);
    }