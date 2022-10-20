<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:33
  from 'E:\Development\web\PHPBoilerPlate\app\templates\start.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019bdf271b6_93152914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34432bb308c397cf34de7bc04312b23d44e87ab3' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\start.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:htmlhead.tpl' => 2,
    'file:navigation.tpl' => 2,
    'file:htmlfoot.tpl' => 2,
  ),
),false)) {
function content_635019bdf271b6_93152914 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\Development\\web\\PHPBoilerPlate\\app\\smarty\\plugins\\modifier.gettext.php','function'=>'smarty_modifier_gettext',),));
if ((isset($_smarty_tpl->tpl_vars['pagedata']->value))) {
$_smarty_tpl->_subTemplateRender("file:htmlhead.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pagedata'=>$_smarty_tpl->tpl_vars['pagedata']->value), 0, false);
} else {
$_smarty_tpl->_subTemplateRender("file:htmlhead.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>

<?php if ((isset($_smarty_tpl->tpl_vars['navdata']->value))) {
$_smarty_tpl->_subTemplateRender("file:navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('navdata'=>$_smarty_tpl->tpl_vars['navdata']->value), 0, false);
} else {
$_smarty_tpl->_subTemplateRender("file:navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>


    <!-- Page Content -->
    <div class="take-all-space-you-can">
    <!-- Page Content -->

<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" class="active">
    <a class="nav-link active" href="#info" role="tab" data-toggle="tab"><?php echo smarty_modifier_gettext("Info");?>
</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#libs" role="tab" data-toggle="tab"><?php echo smarty_modifier_gettext("Libraries and Tools");?>
</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#docs" role="tab" data-toggle="tab"><?php echo smarty_modifier_gettext("Documentation");?>
</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content take-all-space-you-can">

<!--------------------  I  N  F  O ------------------------->
  <div role="tabpanel" class="tab-pane fade active in show" id="info">
                    <div class="row">
                        <div class="col-md-12 text-center">
                        <h2><?php echo smarty_modifier_gettext('Welcome to this boilerplate application');?>
</h2>  
                        <p><?php echo smarty_modifier_gettext("This application should be a usable starting point for own webbase apps based on  php.<br />Several points led me to the decision to create such a thing on my own.");?>
</p>
                        <ul>
                        <li><?php echo smarty_modifier_gettext("I don't like the idea of learning a full sized framework in order to output some function output.");?>
</li>
                        <li><?php echo smarty_modifier_gettext("In my opinion not every thing needs to be coded OOP.");?>
</li>
                        </ul>
                        <p><?php echo smarty_modifier_gettext("Some of the built in functions are");?>
:</p>
                        <ul>
                        <li><?php echo smarty_modifier_gettext("Routing over the index.php");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Easy page generation");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Ajax-Backend generation");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Dynamic (per page) including of CSS and JS");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Secure user management");?>
</li>
                        <li><?php echo smarty_modifier_gettext("XSS and CSRF protection");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Bootstrap 4");?>
</li>
                        <li><?php echo smarty_modifier_gettext("Dynamic navigation generation");?>
</li>
                        <li><?php echo smarty_modifier_gettext("i18n multilanguage support (gettext)");?>
</li>
                        <li><?php echo smarty_modifier_gettext("...and many more...");?>
</li>
                        </ul>  
                        </div>
                    </div>  
  </div>
<!--------------------  I  N  F  O ------------------------->
<!--------------------- L  I  B  S ------------------------->
  <div role="tabpanel" class="tab-pane fade" id="libs">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h1><?php echo smarty_modifier_gettext('This boilerplate is made out of some cool tools and libs');?>
</h1>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['libs']->value, 'lib', false, 'label');
$_smarty_tpl->tpl_vars['lib']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['label']->value => $_smarty_tpl->tpl_vars['lib']->value) {
$_smarty_tpl->tpl_vars['lib']->do_else = false;
?>
                            <div class="alert alert-success">
                            <strong><?php echo $_smarty_tpl->tpl_vars['lib']->value[0];?>
</strong><br />
                            <small>
                            <?php echo $_smarty_tpl->tpl_vars['label']->value;?>

                            <a href="<?php echo $_smarty_tpl->tpl_vars['lib']->value[1];?>
" target="_blank" title="Link to <?php echo $_smarty_tpl->tpl_vars['lib']->value[0];?>
 page"><?php echo $_smarty_tpl->tpl_vars['lib']->value[1];?>
</a>
                            <br /> 
                            License:<?php echo $_smarty_tpl->tpl_vars['lib']->value[2];?>

                            </small>
                            </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
        <!-- /.row -->

  </div>
<!--------------------- L  I  B  S ------------------------->
<!--------------------- D  O  C  S ------------------------->  
  <div role="tabpanel" class="tab-pane fade" id="docs">
        <div class="row">
            <div class="col-md-12" id="dochead">
                 <p><?php echo smarty_modifier_gettext('A tiny documentation about the functions of this boilerplate');?>
</p>
                 <small><?php echo smarty_modifier_gettext('For the documentation of the libraries/tools used, have a look on the linked homepage');?>
</small>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-2" id="doclist">
            
            </div>
            <div class="col-md-10" id="docdetail">

            </div>
            
        </div>
  
  
  </div>
<!--------------------- D  O  C  S ------------------------->
</div>


















    
    <!-- /.container -->
    </div>
    <!-- /.container -->


<?php if ((isset($_smarty_tpl->tpl_vars['sectoken']->value))) {
$_smarty_tpl->_subTemplateRender("file:htmlfoot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sectoken'=>$_smarty_tpl->tpl_vars['sectoken']->value,'pagedata'=>$_smarty_tpl->tpl_vars['pagedata']->value), 0, false);
} else {
$_smarty_tpl->_subTemplateRender("file:htmlfoot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pagedata'=>$_smarty_tpl->tpl_vars['pagedata']->value), 0, true);
}
}
}
