<?php


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
