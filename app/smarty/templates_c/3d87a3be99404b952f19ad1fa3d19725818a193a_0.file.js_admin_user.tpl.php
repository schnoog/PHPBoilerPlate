<?php
/* Smarty version 4.2.1, created on 2022-10-19 17:37:25
  from 'E:\Development\web\PHPBoilerPlate\app\templates\js_admin_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_635019b50724e4_08984515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d87a3be99404b952f19ad1fa3d19725818a193a' => 
    array (
      0 => 'E:\\Development\\web\\PHPBoilerPlate\\app\\templates\\js_admin_user.tpl',
      1 => 1666191547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635019b50724e4_08984515 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\Development\\web\\PHPBoilerPlate\\app\\smarty\\plugins\\modifier.gettext.php','function'=>'smarty_modifier_gettext',),));
echo '<script'; ?>
 type="text/javascript">
   var sectoken = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['sectoken'];?>
";
   var ContentReplaceID = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['replaceid'];?>
";
   var ajaxBackEnd = "<?php echo $_smarty_tpl->tpl_vars['pagedata']->value['ajaxurl'];
echo $_smarty_tpl->tpl_vars['pagedata']->value['ajaxbackend'];?>
";
   
$(document).ready(function() {
 /////


 ////
 
 
 ////
} );

///////////////////////////////////////////////////
    function UpdateMainTable() {
              $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken
                    
                },
                success:function(response) {
                    $("#"+ContentReplaceID).html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    }
//////////////////////////////////////////////////
    function editUser(uid) {
              $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    userid:uid                    
                    
                },
                success:function(response) {
                    $("#"+ContentReplaceID).html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    }
////////////////////////////////////////////////////

    function saveUser(secval) {
        var muid = $('#uid').val();
        var username = $('#username').val();
        var umail = $('#email').val();
        var ustatus = $('#status').val();
        var urole = $('#roles').val();
        var upass = $('#password').val();
        var sm = "ok"
        var uresettable = 0;
        var uverified = 0;
        if($("#resettable").is(':checked')){
            uresettable = 1;
        }
        if($("#verified").is(':checked')){
            uverified = 1;
        }        

              $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    userid:muid,
                    save:sm,
                    uname:username,
                    sec:secval,
                    email:umail,
                    status:ustatus,
                    verified:uverified,
                    resettable:uresettable,                   
                    role:urole,
                    password:upass
                    
                },
                success:function(response) {
                   // alert ("OK");
                   // console.log(response);
//                    $("#"+ContentReplaceID).html(response);
                    if (response == "OK"){
                        UpdateMainTable();
                    }else{
                        $("#"+ContentReplaceID).html(response);
                    }
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    }


////////////////////////////////////////////////




function DeleteBtn(useridno,secval){
    var result;
     bootbox.confirm("<?php echo smarty_modifier_gettext('Really delete this user?');?>
", function(result){ 
        if(result == true){
                var muid = $('#uid').val();
                $.ajax( {
                    type:"post",
                    url:ajaxBackEnd,
                    data:{
                        token:sectoken,
                        userid:useridno,
                        sec:secval,
                        del:'confirmed'
                    },
                    success:function(response) {
                        if (response == "OK"){
                            UpdateMainTable();
                        }else{
                            $("#"+ContentReplaceID).html(response);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
              } );            
         }
     } );
}

////////////////////////////////////////////////////






   
<?php echo '</script'; ?>
> <?php }
}
