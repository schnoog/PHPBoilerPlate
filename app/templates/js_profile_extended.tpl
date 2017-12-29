<script type="text/javascript">
{if isset($pagedata.replaceid)}
    var ContentReplaceID = "{$pagedata.replaceid}";
{/if}
{if isset($pagedata.ajaxbackend)}
    var ajaxBackEnd = "{$pagedata.ajaxurl}{$pagedata.ajaxbackend}"; //don't hardcode the backend
{/if}
{if isset($pagedata.sectoken)}
    var sectoken = "{$pagedata.sectoken}"; //should be supplied with each request in the token field
{/if}
    var vallang="{$pagedata.vallang}";
//////////////////////////////////////////////////
   
$(document).ready(function() {
 /////

////////////////////////////////////////////////////





    openelement("showsettings");


 ////
} );

////////////////////////////////////////////////////
function validme(elementid) {
   // alert ("validme " + elementid);
$('#' + elementid ).validate(function(valid, elem) {
          if (valid) {
              
              var SaveVal = $('#' + elementid).val();
              var SetID = $('#ID_' + elementid).val();
              $('#BTN_' + elementid).html("WAITING");

              savesetting(SetID,SaveVal,elementid);
              console.log('it is valid');
              
              
              
              
                                               
         } else {
              console.log('It is Invalid');
         }
    } );
}
////////////////////////////////////////////////////
function updateSet(setid,elementid) {
    var ele = '#FRM_' + setid;
    var toget = "singleset_" + setid;
    //console.log ("SET " + setid + " ELE " + elementid + " XCHANGE:" + ele);

                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:toget,
                } ,
                success:function(response) {
                        $(ele).attr('class','');
                        $(ele).html(response);
                        $('#BTN_' + elementid).html("{'Saved'|gettext}");
                        
                            setTimeout(function (){
                                $('#BTN_' + elementid).html("{'Save settings'|gettext}");
                                    //something you want delayed

                            }, 5000);                        
                        
                        
                        //alert(response);
                } ,
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );    
    
}

////////////////////////////////////////////////////
function savesetting(setting,settingval,elementid) {

                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"savesetting",
                    setkey:setting,
                    setval:settingval
                    
                } ,
                success:function(response) {
                    if (response == "ERR"){
                        alert('{'Something went terrible wrong during the saving process'|gettext}');
                        updateSet(setting,elementid);                        
                    }
                        
                        updateSet(setting,elementid);
                    
                } ,
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    
}

////////////////////////////////////////////////////
function openelement(requestname) {
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:requestname
                    
                } ,
                success:function(response) {
                    $("#"+ContentReplaceID).html(response);
                    
                        $.validate( {
                                borderColorOnError : '#FFF',
                                addValidClassOnAll : true
                            
                            } );
                    
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    
}
////////////////////////////////////////////////////
////////////////////////////////////////////////////






   
</script> 