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
//////////////////////////////////////////////////
//var faqb = Base64.encode(faqa);
//alert ( $('#editor').summernote('code'));

   
$(document).ready(function() {
 /////
 ////
 
 
 ////
} );

////////////////////////////////////////////////////
function savedoc(){
    var mid = $('#id').val();
    var msection = $('#section').val();
    var mtopic = $('#topic').val();
    var mfurther = $('#further').val();
    var tmp = $('#editor').summernote('code');
    var mdesc = Base64.encode(tmp);
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"savedoc",
                    id:mid,
                    section:msection,
                    topic:mtopic,
                    further:mfurther,
                    desc64:mdesc
                    
                },
                success:function(response) {
                    openelement('doctable');
                    //alert(response);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    
}
////////////////////////////////////////////////////
function openelement(requestname){
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:requestname
                    
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
function addsection(){
    var parentid = $('#parentid').val();
    var sectionlabel = $('#sectionlabel').val();
    var sectiondesc = $('#sectiondesc').val();
                  $.ajax( {
                type:"post",
                url:ajaxBackEnd,
                data:{
                    token:sectoken,
                    action:"addsectiondo",
                    parent:parentid,
                    seclabel:sectionlabel,
                    secdesc:sectiondesc
                    
                },
                success:function(response) {
                    openelement('doctable');
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              } );
    
}
/////////////////////////////////////////////////////




   
</script> 