<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:24
  from 'E:\Development\web\PHPBoilerPlate\app\templates\htmlhead.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019b4c03679_70374636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a03af62d7da9e9450f396637afd0c7820171344c' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\htmlhead.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635019b4c03679_70374636 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pagedata']->value['language'] ?? null)===null||$tmp==='' ? "en" ?? null : $tmp);?>
">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pagedata']->value['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    <meta name="author" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pagedata']->value['content'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['pagedata']->value['title'] ?? null)===null||$tmp==='' ? "Title" ?? null : $tmp);?>
</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
css/bootstrap-4-navbar.css" rel="stylesheet" />
 <!--    <link href="css/jumbotron.css" rel="stylesheet" /> -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
css/main.css" rel="stylesheet" />
 
 <link href="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
css/fontawesome-all.css" rel="stylesheet">
  
 
 
    <?php if ((isset($_smarty_tpl->tpl_vars['pagedata']->value['headincludes']['css']))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagedata']->value['headincludes']['css'], 'headinc');
$_smarty_tpl->tpl_vars['headinc']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['headinc']->value) {
$_smarty_tpl->tpl_vars['headinc']->do_else = false;
?>
    <link href="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
css/<?php echo $_smarty_tpl->tpl_vars['headinc']->value;?>
" rel="stylesheet" />
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    
    <!-- FA likes to be included in head -->
<!--    <?php echo '<script'; ?>
 defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"><?php echo '</script'; ?>
> -->  
    
    
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->





</head>
<body>
<?php }
}
