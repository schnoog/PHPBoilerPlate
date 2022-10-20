<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:34
  from 'E:\Development\web\PHPBoilerPlate\app\templates\js_start.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019be159e80_02235514',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb498a3a44a16e351f85cbad5f75ea41b0e9171c' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\js_start.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635019be159e80_02235514 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
<?php if ((isset($_smarty_tpl->tpl_vars['pagedata']->value['replaceid']))) {?>
    var ContentReplaceID = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['replaceid'];?>
";
<?php }
if ((isset($_smarty_tpl->tpl_vars['pagedata']->value['ajaxbackend']))) {?>
    var ajaxBackEnd = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['ajaxurl'];
echo $_smarty_tpl->tpl_vars['pagedata']->value['ajaxbackend'];?>
"; //don't hardcode the backend
<?php }
if ((isset($_smarty_tpl->tpl_vars['pagedata']->value['sectoken']))) {?>
    var sectoken = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['sectoken'];?>
"; //should be supplied with each request in the token field
<?php }?>
//////////////////////////////////////////////////
   
$(document).ready(function() {
 /////

doclist();

 ////
 
 ////
} );
////////////////////////////////////////////////////
function doclist(){
    var req = "getsections";
    var tar = "doclist";
    dowait = true; 
    openelement(req,tar);
}
////////////////////////////////////////////////////
doclistisformatted = false;

function doclistformat(){
    if (doclistisformatted == false){    
            if ( $( '.coll' ).length ) {
                doclistisformatted = true;
                $('.coll ul').hide();
                    $('.coll').click(function() {
                        //Show clicked dropdown and add 'selected' class
                        $(this).addClass('selected').find('ul').slideDown('fast');
                        //Hide all other dropdowns and remove 'selected' class
                        $('.coll').not(this).removeClass('selected').find('ul').slideUp('fast');
                    
                    });    
            }    
    }    
}
////////////////////////////////////////////////////
function openelement(requestname,targetid){
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:requestname
                    
                },
                success:function(response) {
                    $("#"+targetid).html(response);
                    doclistformat();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    
}



////////////////////////////////////////////////////






   
<?php echo '</script'; ?>
> <?php }
}
