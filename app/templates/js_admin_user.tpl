<script type="text/javascript">
   var sectoken = "{$pagedata.sectoken}";
   var ContentReplaceID = "{$pagedata.replaceid}";
   var ajaxBackEnd = "{$pagedata.ajaxurl}{$pagedata.ajaxbackend}";
   
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
     bootbox.confirm("{'Really delete this user?'|gettext}", function(result){ 
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






   
</script> 