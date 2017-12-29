<script type="text/javascript">
   var sectoken = "{$pagedata.sectoken}";
   var ContentReplaceID = "{$pagedata.replaceid}";
   var ajaxBackEnd = "{$pagedata.ajaxurl}{$pagedata.ajaxbackend}";
   
   var ns;

		$(document).ready(function() {
		  updateNavTree();
          showpages();
          proftable();
		} );
        
        
///////// Tools
////////////////////////////////////////////////////////////////////////////////////////
var newPageName = "";
var newPageWithJS = "Yes";
var myint = 0;

function cPageCall1() {
    alert ("Pagename: " + newPageName + " WithJS: " + newPageWithJS);
}
/////////////////////
function compile_templates() {
    var url1 = "{$pagedata.baseurl}/compile.php";
    var url2 = "{$pagedata.ajaxurl}/compile.php";
    
              $.ajax( {
                type:"post",
                url:url1,
                success:function(response) {
                  myint = myint +1;
                  if (myint == 2){
                    alert ("{'All templates were compiled.'|gettext}");
                  }  
                } 
              } );    
    
    
              $.ajax( {
                type:"post",
                url:url2,
                success:function(response) {
                  myint = myint +1;
                  if (myint == 2){
                    alert ("{'All templates were compiled.'|gettext}");
                  }  
                
                } 
              } );    
    
    
    
    
    
}
/////////////////////
function cPageCall() {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"createpage",
                    pagename: newPageName,
                    withjs: newPageWithJS
                    
                    
                },
                success:function(response) {
                    //$("#navact").html(response);
                    alert(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );    
}
//////////////////////////////////

function createpage() {
    bootbox.prompt("{'Please enter a name for the page (3chars min, alphanumeric only!)<br />The pagename will be converted to  <b>lowercase</b>.'|gettext}", function(result) { 
        //console.log(result); 
        newPageName = result;
//
            bootbox.prompt( {
                title: "{'Should a javascript template and an AJAX backend be created (default: Yes)'|gettext}",
                inputType: 'select',
                inputOptions: [
                    {
                        text: '{'Yes'|gettext}',
                        value: 'Yes',
                        selected: 'selected',
                    },
                    {
                        text: '{'No'|gettext}',
                        value: 'No',
                    }
                ],
                callback: function (result) {
                    newPageWithJS = result;
                    cPageCall();
                }
            } );
//
    } );
}        			
///////// ACL
////////////////////////////////////////////////////////////////////////////////////////
function savepageitem() {
         var pid = $('#id').val();
         var title = $('#pagetitle').val();
         var sysp = $('#syspage').val();
         var uacl = $('#useacl').val();
         var umask = $('#usermask').val();

              $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"savepageitem",
                    pageid:pid,
                    pagetitle:title,
                    syspage:sysp,
                    useacl:uacl,
                    usermask:umask
                },
                success:function(response) {
                   // alert(response);
                   // console.log(response);
                   //  updateNavTree();
                   $("#pageset").html(response);

                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );    
    
    
    
    
}
////////
function showpageedit(mpageid) {
                $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"showpageedit",
                    pageid:mpageid
                },
                success:function(response) {
                    $("#pageset").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );  
}
///////          

function showpages() {
                $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"showpages",
                },
                success:function(response) {
                    $("#pageset").html(response);
                        $(document).ready( function () {
                            $('#pagetable').DataTable(
                                    {
                                      "columnDefs": [ {
                                          "targets": [ 2 ,3 ],
                                          "orderable": false,
                                        } ],
                                        "pageLength": 50
                                    }
                            );
                        } );
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } ); 
}
///////          
function updatepages() {
                $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"updatepages",
                    
                    
                },
                success:function(response) {
                    $("#pageset").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );    
    
}
///////// NAVIGATION  
////////////////////////////////////////////////////////////////////////////////////////
function savemenue() {
  var resp = $('.dd').nestable('asNestedSet');
  //var resp = $('.dd').nestable('serialize');
  var resp2 = JSON.stringify(resp);  
  //alert(resp2);

            $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"navsave",
                    nav:resp2
                    
                },
                success:function(response) {
                    $("#navact").html(response);
                    updateNavTree();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );



                 
}


//////////////////////////////////
function setMod() {
    $('.dd').nestable({ 
        includeContent: true,
     
    });
}
//////////////////////////////////
function getusergroups() {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"getusergroups"
                    
                    
                },
                success:function(response) {
                    $("#ucc").html(response);
                    //setMod();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );      
    
}
//////////////////////////////////
function showemptyact() {
    //emptyact
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"emptyact"
                    
                    
                },
                success:function(response) {
                    $("#navact").html(response);
                    //setMod();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );        
    
}
/////////////////////////////////
function savenavitem() {
        var nid = $('#id').val();
        var title = $('#nav_title').val();
        var desc = $('#nav_desc').val();
        var parentid = $('#nav_parentid').val();
        var allowedmask = $('#nav_allowedmask').val();
        var target = $('#nav_target').val();
        var active = $('#nav_active').val();
        var sort = $('#nav_sort').val();

              $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"savenavitem",
                    nav_id:nid,
                    nav_title:title,
                    nav_desc:desc,
                    nav_parentid:parentid,
                    nav_allowedmask:allowedmask,
                    nav_target:target,
                    nav_active:active,
                    nav_sort:sort
                },
                success:function(response) {
                   // alert(response);
                   // console.log(response);
                     updateNavTree();
                   //$("#navset").html(response);

                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
}

/////////////////////////////////
function deletenav(nid) {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"deletenavitem",
                    navid:nid
                    
                    
                },
                success:function(response) {
                    //$("#navact").html(response);
                    updateNavTree();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );     
    
}
/////////////////////////////////
function delitemform() {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"deleteitemform",
                    
                    
                },
                success:function(response) {
                    $("#navact").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );     
}
/////////////////////////////////
function additemform() {
    //additemform
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"additemform",
                    
                    
                },
                success:function(response) {
                    $("#navact").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );    
    
}






   
   
//////////////////////////////////
    function updateNavTree() {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"navtree"
                    
                    
                },
                success:function(response) {
                    $("#navset").html(response);
                    setMod();
                    showemptyact();
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );        
    }
////////////////////////////////   
   function editnav(navid) {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"editform",
                    id:navid
                    
                },
                success:function(response) {
                    $("#navact").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
   }
////////////////////////////////     
   function proftable() {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"getprofilefields",
                    
                },
                success:function(response) {
                    $("#protab").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
   }
   
////////////////////////////////////////////////////
var globID = 0;
    function deleteprofileitem(itemid){
                globID = itemid;
                bootbox.confirm( {
                    message: "{'Do you really want to delete this profile field?<br />This will delete also all corresponding user settings'|gettext}",
                    buttons: {
                        confirm: {
                            label: '{"Yes"|gettext}',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: '{"No"|gettext}',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        
                                        if (result == true){
                                              $.ajax( {
                                            type:"post",
                                            url:ajaxBackEnd,
                                            data:{
                                                token:sectoken,
                                                action:"deletefield",
                                                profileitem:globID
                                                
                                            },
                                            success:function(response) {
                                                $("#protab").html(response);
                                            },
                                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                                            } 
                                          } ); 
                                        }
                                                                 
                    }
                } );
    }
////////////////////////////////////////////////////
    function editprofileitem(itemid){
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"addoreditfield",
                    profileitem:itemid
                    
                },
                success:function(response) {
                    $("#protab").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );        
        
        
        
    }
////////////////////////////////////////////////////
    function saveprofileitem(){
        var mdid = $('#id').val();
        var mdusersetting_key = $('#usersetting_key').val();
        var mdusersetting_desc = $('#usersetting_desc').val();
        var mdusersetting_default = $('#usersetting_default').val();
        var mdusersetting_typevaliparameter = $('#usersetting_typevaliparameter').val();
        var mdusersetting_required = $('#usersetting_required').val();
        var mdusersetting_preset = $('#usersetting_preset').val();
        var mdusersetting_limittopreset = $('#usersetting_limittopreset').val();

                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"savefield",
                        id:mdid,
                        usersetting_key:mdusersetting_key,
                        usersetting_desc:mdusersetting_desc,
                        usersetting_default:mdusersetting_default,
                        usersetting_typevaliparameter:mdusersetting_typevaliparameter,
                        usersetting_required:mdusersetting_required,
                        usersetting_preset:mdusersetting_preset,
                        usersetting_limittopreset:mdusersetting_limittopreset
                },
                success:function(response) {
                    //alert(response);
                    $("#protab").html(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );          
        
    }
////////////////////////////////////////////////////
////////////////////////////////////////////////////




   
</script> 