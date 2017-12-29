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






   
</script> 