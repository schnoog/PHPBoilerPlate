<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:24
  from 'E:\Development\web\PHPBoilerPlate\app\templates\htmlfoot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019b4ebd792_10211903',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c09ed4bdd407439d572f4dc38492fa417d1df82b' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\htmlfoot.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635019b4ebd792_10211903 (Smarty_Internal_Template $_smarty_tpl) {
?>    <!-- jQuery Version 3.2.1 -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <!-- -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/popper.min.js"><?php echo '</script'; ?>
>
    <!-- -->
    <!-- Bootstrap Core JavaScript -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/bootbox.min.js"><?php echo '</script'; ?>
>
    

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/bootstrap-4-navbar.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" id="cookieinfo" 	src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/cookieinfo.min.js"><?php echo '</script'; ?>
>

    <?php if ((isset($_smarty_tpl->tpl_vars['pagedata']->value['footincludes']['js']))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagedata']->value['footincludes']['js'], 'footinc');
$_smarty_tpl->tpl_vars['footinc']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['footinc']->value) {
$_smarty_tpl->tpl_vars['footinc']->do_else = false;
?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['baseurl'];?>
js/<?php echo $_smarty_tpl->tpl_vars['footinc']->value;?>
"><?php echo '</script'; ?>
>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>    
    

<?php echo '<script'; ?>
 type="text/javascript">
        
        var Base64= {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
        
//var faqb = Base64.encode(faqa);

$(document).ready(function() {
  $("form").each(function() {
    var tokenElement = $(document.createElement('input'));
    tokenElement.attr('type', 'hidden');
    tokenElement.attr('name', 'token');
    tokenElement.val("<?php echo $_smarty_tpl->tpl_vars['sectoken']->value;?>
");
    $(this).append(tokenElement);
  } );
} );
   
<?php echo '</script'; ?>
>   

<?php if ($_smarty_tpl->tpl_vars['pagedata']->value['js_to_include'] != '') {?>
    <?php $_smarty_tpl->_assignInScope('tmp', dirname($_smarty_tpl->source->filepath));?>
    <?php if (file_exists($_smarty_tpl->tpl_vars['tmp']->value)) {?>
        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['pagedata']->value['js_to_include'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pagedata'=>$_smarty_tpl->tpl_vars['pagedata']->value), 0, true);
?>
    <?php }
}?>    

</body>

</html><?php }
}
