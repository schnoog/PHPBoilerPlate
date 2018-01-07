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
//$pagedata['headincludes']['css'][] = 'jquery.nestable.css';
/**
 *  This page uses an extra javascript library, which is not required by the other pages?
 *  Then include it here. One, five, ten? It's up to you
*/
//$pagedata['footincludes']['js'][]= 'jquery.nestable.js';
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


$usedlibs= array(
'delight-im/PHP-Auth' => array('PHP-Auth','https://github.com/delight-im/PHP-Auth','MIT License'),
'phpmailer/phpmailer' => array('PHPMailer','https://github.com/phpmailer/phpmailer','GNU Lesser General Public License v2.1'),
'sergeytsalkov/meekrodb/' => array('MeekroDB','https://github.com/SergeyTsalkov/meekrodb/','GNU Lesser General Public License v3.0'),
'smarty/smarty' => array('Smarty Template Engine','https://github.com/smarty-php/smarty','GNU Lesser General Public License v2.1 (or later)'),
'Bootstrap4' => array('Bootstrap 4','https://getbootstrap.com','MIT license'),
'bootstrap-4-multi-dropdown-navbar' => array('Bootstrap4 Multi Dropdown Navbar','https://github.com/bootstrapthemesco/bootstrap-4-multi-dropdown-navbar/','GPL license'),
'cookieconsent' => array('Cookie Consent','https://cookieconsent.insites.com','MIT License'),
'nestable-fork' => array('Nestable','https://github.com/ozdemirburak/nestable-fork','BSD & MIT license'),
'datatables' => array('DataTables Table plug-in for jQuery','https://datatables.net/','MIT license'),
'summernote/summernote' => array('wysiwyg rich text editor for Bootstrap','https://github.com/summernote/summernote/','MIT License'),
'anti-xss' => array('anti-xss','https://github.com/voku/anti-xss','MIT license'),
'werx/validation' => array('werx/validation','https://github.com/werx/validation','MIT License'),
'jQuery Form Validator' => array('formvalidator.net','http://www.formvalidator.net','MIT License'),
'Hybridauth 3' => array('Hybridauth 3.0','https://hybridauth.github.io','MIT License'),
'fontawesome' => array('Font Awesome','http://fontawesome.io/','MIT License & SIL OFL 1.1'),
'IconCaptcha Plugin' => array('IconCaptcha Plugin - jQuery & PHP','https://github.com/fabianwennink/IconCaptcha-Plugin-jQuery-PHP','MIT License / Icons: CC0'),
//'' => array('','','MIT License'),
//'' => array('','','MIT License'),
//'' => array('','','MIT License'),
//'auth' => array ("auth",print_r($auth->getUserId(),true),"auth"),
);

$docsecs = DB::query("Select * from docusections");
for ($x=0;$x<count($docsecs);$x++) {
    $item = $docsecs[$x];
    $docsections[$item['id']] = $item;
}
foreach ($docsections as $key => $item) {
    $ds[$key] = getEndLabel($key, $docsections, "", "sectionlabel", "parentid", "--");
}

$docs = DB::query("SELECT docu.* , docusections.* FROM `docu` INNER JOIN docusections on (docu.section = docusections.id) ORDER by docusections.parentid ASC");

function DocTree()
{
}

$smarty->assign("libs", $usedlibs);













$smarty->assign("sectoken", $secdata['curruser']['token']);
$smarty->assign("navdata", $navdata);
$smarty->assign("pagedata", $pagedata);
$smarty->display($page . ".tpl");
