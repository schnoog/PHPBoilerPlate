

<label for="nav_title">{'Title'|gettext}</label>
<input class="form-control" type="text" id="nav_title"  required>
<label for="nav_desc">{'Description'|gettext}</label>
<input type="text" id="nav_desc"  class="form-control" >
<label for="navtype">{'Type of navigation entry'|gettext}</label>
    {html_options name="navtype" id="navtype" options=$navtypes   class="form-control"}
<br />
<label for="nav_parentid">{'Parent-Item'|gettext}</label>
    {html_options name="nav_parentid" id="nav_parentid" options=$navitems class="form-control"}

<label for="nav_allowedmask">{'Access control'|gettext}<br /><small>{'(visibility in menu)'|gettext}</small></label>
        {html_ncoptions  name="roles" size="{$roles|@count}" options=$roles  class="form-control" multiple="" id="nav_allowedmask"}
<input type="hidden" id="nav_allowedmask_sum" class="form-control">
<label for="nav_target">{'Target'|gettext}<br /><small>{'Full-url for extern targets, internal only pagename'|gettext}</small></label>
<input type="text" id="nav_target" class="form-control" required>
<label for="nav_active">{'Active'|gettext}</label>
<select id="nav_active" class="form-control">
<option value="1" selected="selected">{'Active'|gettext}</option>
<option value="0">{'Inactive'|gettext}</option>
</select>
<label for="nav_sort">{'Sorting'|gettext}</label>
<input type="number" id="nav_sort" value="5" class="form-control">
<button type="button" onclick="savenavitem();" class="btn btn-danger form-control">{'Save changes'|gettext}</button>
<button type="button" onclick="showemptyact();" class="btn btn-success form-control">{'Cancel'|gettext}</button>
<script type="text/javascript">
$(document).ready(function() {
 /////
             $('option').mousedown(function(e) {
                e.preventDefault();
                $(this).prop('selected', !$(this).prop('selected'));
                return false;
            } );

} );
</script>

