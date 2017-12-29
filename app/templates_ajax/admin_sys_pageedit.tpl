



<input type="hidden" id="id" value="{$page.id}"/>
<label for="pagetitle">{'Page Title'|gettext}</label>
<input type="text" id="pagetitle" value="{$page.pagetitle}" class="form-control"/>
<label for="syspage">{'System-Page'|gettext}</label>
<select id="syspage" class="form-control">
    <option value="0" {if $page.syspage == 0}selected="selected"{/if}>{'No'|gettext}</option>
    <option value="1" {if $page.syspage == 1}selected="selected"{/if}>{'Yes'|gettext}</option>
</select>


<label for="useacl">{'Use the ACL system'|gettext}</label>
<select id="useacl" class="form-control">
    <option value="0" {if $page.useacl == 0}selected="selected"{/if}>{'No'|gettext}</option>
    <option value="1" {if $page.useacl == 1}selected="selected"{/if}>{'Yes'|gettext}</option>
</select>

<label for="usermask">{'Access control to the page'|gettext}<br /><small>{'If no group is selected, access is garanted to everyone'|gettext}</small></label>
{html_options  name=roles options=$roles selected=$page.usermask_array class="form-control" multiple="" id="usermask" size="10"}

<button type="button" class="form-control btn btn-success" onclick="savepageitem();">{'Save your changes'|gettext}</button><br />
<button type="button" class="form-control btn btn-warning" onclick="showpages();">{'Cancel'|gettext}</button>

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