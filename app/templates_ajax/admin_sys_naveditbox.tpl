
<input type="hidden" id="id" value="{$nav.id}" />
<label for="nav_title">{'Title'|gettext}</label>
<input class="form-control" type="text" id="nav_title" value="{$nav.nav_title}" required>
<label for="nav_desc">{'Description'|gettext}</label>
<input type="text" id="nav_desc" value="{$nav.nav_desc}" class="form-control" >
<label for="navtype">{'Type of navigation entry'|gettext}</label>
    {html_options name="navtype" id="navtype" options=$navtypes  selected=$nav.nav_navtype class="form-control"}
<br />
<label for="nav_parentid">{'Parent-Item'|gettext}</label>
    {html_options name="nav_parentid" id="nav_parentid" options=$navitems  selected=$nav.nav_parentid class="form-control"}

<label for="nav_allowedmask">{'Access control'|gettext}<br /><small>{'(visibility in menu)'|gettext}</small></label>
        {html_ncoptions  name="roles" size="{$roles|@count}" options=$roles selected=$nav.nav_allowedmask_array class="form-control" multiple="" size="10" id="nav_allowedmask" }
<input type="hidden" id="nav_allowedmask_sum" value="{$nav.nav_allowedmask}" class="form-control">
<label for="nav_target">{'Target'|gettext}<br /><small>{'Full-url for extern targets, internal only pagename'|gettext}</small></label>
<input type="text" id="nav_target" value="{$nav.nav_target}" class="form-control" required>
<label for="nav_active">{'Active'|gettext}</label>
<select id="nav_active" class="form-control">
<option value="1" {if ($nav.nav_active == 1)} selected="selected"{/if}>{'Active'|gettext}</option>
<option value="0" {if ($nav.nav_active == 0)} selected="selected"{/if}>{'Inactive'|gettext}</option>
</select>
<label for="nav_sort">{'Sorting'|gettext}</label>
<input type="number" id="nav_sort" value="{$nav.nav_sort}" class="form-control">
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

