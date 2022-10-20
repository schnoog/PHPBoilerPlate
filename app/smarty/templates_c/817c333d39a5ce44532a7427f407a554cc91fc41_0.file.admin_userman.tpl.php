<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:24
  from 'E:\Development\web\PHPBoilerPlate\app\templates\admin_userman.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019b4a86767_25294548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '817c333d39a5ce44532a7427f407a554cc91fc41' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\admin_userman.tpl',
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
function content_635019b4a86767_25294548 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\Development\\web\\PHPBoilerPlate\\app\\smarty\\plugins\\modifier.gettext.php','function'=>'smarty_modifier_gettext',),1=>array('file'=>'E:\\Development\\web\\PHPBoilerPlate\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
    <div class="container">
    <!-- Page Content -->
    
        <div class="row">
            <div class="col-lg-12 text-center" id="usertable">
            
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th><?php echo smarty_modifier_gettext('User-ID');?>
</th>
			<th><?php echo smarty_modifier_gettext('Username');?>
</th>
			<th><?php echo smarty_modifier_gettext('E-Mail');?>
</th>
			<th><?php echo smarty_modifier_gettext('Status');?>
</th>
			<th><?php echo smarty_modifier_gettext('Verified');?>
</th>
			<th><?php echo smarty_modifier_gettext('Resetable');?>
</th>
			<th><?php echo smarty_modifier_gettext('User-Roles');?>
</th>
			<th><?php echo smarty_modifier_gettext('Registered');?>
</th>
			<th><?php echo smarty_modifier_gettext('Last-Login');?>
</th>
			<th><?php echo smarty_modifier_gettext('Actions');?>
</th>
		</tr>
	</thead>
	<tbody>            
            
            
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userlist']->value, 'user', false, 'id');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['user']->value['status_written'];?>
</td>
			<td><?php if ($_smarty_tpl->tpl_vars['user']->value['verified'] == 1) {
echo smarty_modifier_gettext('Yes');
} else {
echo smarty_modifier_gettext('No');
}?></td>
			<td><?php if ($_smarty_tpl->tpl_vars['user']->value['resettable'] == 1) {
echo smarty_modifier_gettext('Yes');
} else {
echo smarty_modifier_gettext('No');
}?></td>
			<td>
            <?php $_smarty_tpl->_assignInScope('x', 0);?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user']->value['roles_array'], 'singlerole');
$_smarty_tpl->tpl_vars['singlerole']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['singlerole']->value) {
$_smarty_tpl->tpl_vars['singlerole']->do_else = false;
?>
            <?php if ($_smarty_tpl->tpl_vars['x']->value > 0) {?>, <?php }?> 
            <?php $_smarty_tpl->_assignInScope('x', $_smarty_tpl->tpl_vars['x']->value+1);?>
            <?php echo $_smarty_tpl->tpl_vars['singlerole']->value;?>

            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['registered'],"%Y/%m/%d");?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['registered'],"%H:%M:%S");?>
</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['last_login'],"%Y/%m/%d");?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['registered'],"%H:%M:%S");?>
</td>
			<td>            <?php if ($_smarty_tpl->tpl_vars['user']->value['showedit'] == true) {?>
                <button type="button" onclick="editUser(<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
); return false;"><?php echo smarty_modifier_gettext('Edit User');?>
</button>
            <?php }?>
            </td>
		</tr>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</tbody>
</table>

<hr />
<?php echo $_smarty_tpl->tpl_vars['debugout']->value;?>


            </div>
            
<!--            
<div id="myModal" class="modal hide">
        <div class="row">
            <div class="col-lg-12 text-center" id="usertable">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
            </div>
        </div>
</div>            
-->            
            
            
            
            
            
            
            
            
            
            
            
            
        </div>
        <!-- /.row -->
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
