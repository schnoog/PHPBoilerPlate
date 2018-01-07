<?php

/**
 * Template for standard pages
 * You have to chose whether you will use the ACL or not
 * -ACL: You don't need to add anything here.
 *  But be careful: Unless you've set the access groups, the page is accessible to everyone
 * -NoACL but admin only:
 * Use the following lines to
 * (1) deny access to anyone not logged in
 * (2) deny access to anyone not in the admin groups (see main settings)
 * 1)if (!$auth->isLoggedIn()) forwartTo($Settings['pages']['noaccess']);
 * 2)if (!$_SESSION['isadmin']) forwartTo($Settings['pages']['noaccess']);
 *
 *
 */



/**
 *  You need to set an ajax backend, which is used with its FQDN (https://xxx.yy/backend.php)
*/
$pagedata['ajaxbackend'] = 'ajaxbe_'.$page.'.php';
/**
 *  This page uses an extra CSS file, which is not required by the other pages?
 *  Then include it here. One, five, ten? It's up to you
*/
$pagedata['headincludes']['css'][] = 'datatables.min.css';
$pagedata['headincludes']['css'][]= 'summernote-bs4.css';
/**
 *  This page uses an extra javascript library, which is not required by the other pages?
 *  Then include it here. One, five, ten? It's up to you
*/
$pagedata['footincludes']['js'][]= 'datatables.min.js';
$pagedata['footincludes']['js'][]= 'summernote-bs4.min.js';
/**
 *  Incluse a js-template
 *  This can, for example hold all JS functions and calls for the current page
 *  This will be the last "input" before </body>
*/
$pagedata['js_to_include'] = 'js_' . $page . '.tpl';
/**
 *
 *  If you're using a DOM element to place your output,you can set the div id here
 *
*/
 $pagedata['replaceid'] = "maincontainer";

$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
