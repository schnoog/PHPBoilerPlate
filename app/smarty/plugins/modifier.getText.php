<?php

/**
 * @author Guido K.B.W. Üffing <info ueffing net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3
 *
 * Smarty plugin
 * Type: modifier
 * Name: smarty_modifier_gettext
 * Version: 1
 * Date: 2013-07-19
 * @see https://blog.ueffing.net/post/2013/07/19/php-smarty-a-modifier-for-internationalization-tool-gettext/
 *
 * @access public
 * @var $sString String to be translated
 * @var $sDomain e.g. "backend"; means the File (backend.mo) which will be consulted for Translation
 * @var $sLang Translation into a certain Language, e.g. "de_DE"
 * @return string translated String
 */
function smarty_modifier_gettext($sString, $sDomain = '')
{
//    return "nooooo";
    global $Settings;
    $sLang = $Settings['langs']['active'];
    if (strlen($sDomain)< 1) {
        $sDomain = $Settings['langs']['defaultdomain'];
    }
    // logMissMatch($sString,$sLang,$sDomain);
    if (empty($sString)) {
        return gettype($sString);
    }
    global $Settings;

    if (!defined("LANGISSET")) {
        initialize_i18n($sDomain);
    }

    $retstring = gettext($sString);
    //if ($retstring == $sString ."lll")
    return $retstring;
}
