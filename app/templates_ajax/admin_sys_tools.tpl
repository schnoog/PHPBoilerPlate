




<label for="usermask">{'Access control to the page'|gettext}<br /><small>{'If no group is selected, access is garanted to everyone'|gettext}</small></label>
{html_ncoptions  name=roles options=$roles  class="form-control" multiple="" id="usermask" size="10"}
<input type="text" class="form-control" id="masksum" />
<button type="button" class="form-control btn btn-success" onclick="calculate();">{'Get the number'|gettext}</button><br />

<script type="text/javascript">

/////////////////////
function calculate(){
                    
                    var sum = 0;
                    $('#usermask :selected').each(function() {
                        sum += Number($(this).val());
                    });
                     $("#masksum").val(sum);
                 
    
}


$(document).ready(function() {
 /////
                $('#usermask').change(function(){
                    var sum = 0;
                    $('#usermask :selected').each(function() {
                        sum += Number($(this).val());
                    });
                     $("#masksum").val(sum);
                }); 
 
 
 /////
             $('option').mousedown(function(e) {
                e.preventDefault();
                $(this).prop('selected', !$(this).prop('selected'));
                calculate();
                return false;
            } );
} );
</script>