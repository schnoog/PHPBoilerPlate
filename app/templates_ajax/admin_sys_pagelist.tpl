




{if isset($pagelist)}
<table class="table table-striped table-bordered" id="pagetable">
<thead>
<tr>
<th>{'Page'|gettext}</th><th>{'Page Title'|gettext}</th><th>{'System'|gettext}<br />{'Page'|gettext}</th><th>{'Uses'|gettext}<br />{'ACL'|gettext}</th><th>{'Allowed'|gettext}<br />{'User groups'|gettext}</th>
</tr>
</thead>
<tbody>
<strong>{'Legend'|gettext}:</strong>
    {'Deactivated'|gettext}: <i class="far fa-window-close"></i> {'Yes/Active'|gettext}: <i class="fas fa-toggle-on"></i> {'No/Deactive'|gettext} <i class="fas fa-toggle-off"></i>

{foreach $pagelist as $page}
<tr>
<td>
<button class="form-control" type="button" title= "{'Click to edit'|gettext}" onclick="showpageedit({$page.id});">{$page.page}</button>
</td>
<td>{$page.pagetitle}</td>
<td>
{if $page.syspage == 1}
        <i class="fas fa-toggle-on"></i>
{else}
        <i class="fas fa-toggle-off"></i>
{/if}
</td>
<td>
{if $page.syspage == 1}
    <i class="far fa-window-close"></i>
{else}
    {if $page.useacl == 1}
        <i class="fas fa-toggle-on"></i>
    {else}
        <i class="fas fa-toggle-off"></i>
    {/if}
{/if}

</td>


<td>
{if (($page.syspage == 1) or ($page.useacl == 0))}
    <small></small><strong>{'Deactivated'|gettext}</strong> {if $page.syspage == 1}-{'Sys-Page'|gettext} ({'self controlled'|gettext}){else}-{'ACL deactivated'|gettext}{/if}

{else}
{$i= 1}
    {foreach $roles as $roleid => $role}
                {$i = $i + 1}
                {if (($page.usermask == 0) or ($page.usermask & $roleid))}
                <i class="fas fa-toggle-on"></i><small>{$role}</small>
                {if $i == 4}{$i = 1}<br />{/if} 
                {/if}
                
    {/foreach}
{/if}
</td>


</tr>
{/foreach}
</tbody>
</table>
{/if}