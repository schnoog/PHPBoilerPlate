<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:24
  from 'E:\Development\web\PHPBoilerPlate\app\templates\navigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019b4cf5f62_93894212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56bc40416f756736028e1c710cdbd8dc1e9f5541' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\navigation.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635019b4cf5f62_93894212 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\Development\\web\\PHPBoilerPlate\\app\\smarty\\plugins\\modifier.gettext.php','function'=>'smarty_modifier_gettext',),));
?>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------  N A V    B E G I N N --------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar01">
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
        <ul class="navbar-nav navbar-right">
<?php if ($_smarty_tpl->tpl_vars['navdata']->value['login']['loggedin'] === true) {?>        
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hello <?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['displayname'];?>
</a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">

                    <a class="dropdown-item" href="#"><form class="form" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['profile'];?>
" accept-charset="UTF-8" id="profile-nav">
										               <div class="form-group"><button type="submit" class="btn btn-primary btn-block"><?php echo smarty_modifier_gettext('Your profile');?>
</button>
        										       </div>
    								                  </form>
                    </a>
                    <a class="dropdown-item" href="#"><form class="form" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['logintarget'];?>
" accept-charset="UTF-8" id="logout-nav">
        										       <div class="form-group"><input type="hidden" name="action" value="logout" /><button type="submit" class="btn  btn-block btn-danger"><?php echo smarty_modifier_gettext('Log out');?>
</button>
            										   </div>
                                                      </form>
                    </a>
                </div>
            </li>
<?php } else { ?>          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign in</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown02">
            							<div class="col-md-12">
		Login <?php if ((isset($_smarty_tpl->tpl_vars['navdata']->value['login']['social']))) {
if ($_smarty_tpl->tpl_vars['navdata']->value['login']['social'] === true) {?>via
		<div class="social-buttons">
<?php $_smarty_tpl->_assignInScope('x', 0);?>

<table><tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navdata']->value['login']['socialprovider'], 'provider');
$_smarty_tpl->tpl_vars['provider']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['provider']->value) {
$_smarty_tpl->tpl_vars['provider']->do_else = false;
$_smarty_tpl->_assignInScope('x', $_smarty_tpl->tpl_vars['x']->value+1);
$_smarty_tpl->_assignInScope('bt', 'primary');
if (!(1 & $_smarty_tpl->tpl_vars['x']->value)) {?> 
<?php $_smarty_tpl->_assignInScope('bt', 'info');
}?>        
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['socialpage'];?>
?provider=<?php echo $_smarty_tpl->tpl_vars['provider']->value;?>
" class="btn btn-sm btn-block btn-<?php echo $_smarty_tpl->tpl_vars['bt']->value;?>
">
                    <i class="fas fa-sign-in-alt"></i> 
                    <?php echo $_smarty_tpl->tpl_vars['provider']->value;?>

            </a></td>
            <?php if (!(1 & $_smarty_tpl->tpl_vars['x']->value)) {?></tr><tr><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr></table>

		</div>
        or<?php }
}?>
            								 <form class="form" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['logintarget'];?>
" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="login" />
            											 <label class="sr-only" for="exampleInputEmail2"><?php echo smarty_modifier_gettext('Email address');?>
</label>
            											 <input name="email" type="email" autocomplete="email" class="form-control" id="exampleInputEmail2" placeholder="<?php echo smarty_modifier_gettext('Email address');?>
" required>
            										</div>
            										<div class="form-group">
            											 <label class="sr-only" for="exampleInputPassword2"><?php echo smarty_modifier_gettext('Password');?>
</label>
            											 <input name="password" type="password" autocomplete="current-password" class="form-control" id="exampleInputPassword2" placeholder="<?php echo smarty_modifier_gettext('Password');?>
" required>
                                                         <div class="help-block text-right"><a href="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['pwreset'];?>
"><?php echo smarty_modifier_gettext('Forget the password ?');?>
</a></div>
            										</div>
            										<div class="form-group">
            											 <button type="submit" class="btn btn-primary btn-block"><?php echo smarty_modifier_gettext('Sign in');?>
</button>
            										</div>
            										<div class="checkbox">
            											 <label>
            											 <input name="remember" type="checkbox" /> <?php echo smarty_modifier_gettext('keep me logged-in');?>

            											 </label>
            										</div>
            								 </form>
            							</div>
            							<div class="bottom text-center">
                                        <?php if ($_smarty_tpl->tpl_vars['navdata']->value['showreg'] == true) {?>
            								<?php echo smarty_modifier_gettext('New here ?');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['navdata']->value['login']['registerlink'];?>
"><b><?php echo smarty_modifier_gettext('Join Us');?>
</b></a>
                                        <?php }?>
            							</div>
                    </div>
            </li>
<?php }?>            
        </ul>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------- dynamic start ---------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<?php if ((isset($_smarty_tpl->tpl_vars['navdata']->value['navtree']))) {
echo $_smarty_tpl->tpl_vars['navdata']->value['navtree'];
}?>        
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------- dynamic end ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->           
<?php if ($_smarty_tpl->tpl_vars['navdata']->value['admin']['visible'] === true) {?>
        <ul class="navbar-nav mr-auto">          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown00" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo smarty_modifier_gettext('Administration');?>
</a>
            <div class="dropdown-menu" aria-labelledby="dropdown00">
          
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navdata']->value['adminpages'], 'wert', false, 'schluessel');
$_smarty_tpl->tpl_vars['wert']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['schluessel']->value => $_smarty_tpl->tpl_vars['wert']->value) {
$_smarty_tpl->tpl_vars['wert']->do_else = false;
?>
              <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['schluessel']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['wert']->value;?>
</a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
          </li>          
        </ul>
<?php }?>          


      </div>
    </nav>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------  N A V    E N D ---------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- --><?php }
}
