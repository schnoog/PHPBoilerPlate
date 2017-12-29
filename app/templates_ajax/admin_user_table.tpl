<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th>{'User-ID'|gettext}</th>
			<th>{'Username'|gettext}</th>
			<th>{'E-Mail'|gettext}</th>
			<th>{'Status'|gettext}</th>
			<th>{'Verified'|gettext}</th>
			<th>{'Resetable'|gettext}</th>
			<th>{'User-Roles'|gettext}</th>
			<th>{'Registered'|gettext}</th>
			<th>{'Last-Login'|gettext}</th>
			<th>{'Actions'|gettext}</th>
		</tr>
	</thead>
	<tbody>            
            
            
{foreach key=id from=$userlist item=user}
		<tr>
			<td>{$user.id}</td>
			<td>{$user.username}</td>
			<td>{$user.email}</td>
			<td>{$user.status_written}</td>
			<td>{if $user.verified == 1}{'Yes'|gettext}{else}{'No'|gettext}{/if}</td>
			<td>{if $user.resettable == 1}{'Yes'|gettext}{else}{'No'|gettext}{/if}</td>
			<td>
            {$x = 0}
            {foreach from=$user.roles_array item=singlerole}
            {if $x >0}, {/if} 
            {$x = $x+1}
            {$singlerole}
            {/foreach}
            </td>
			<td>{$user.registered|date_format:"%Y/%m/%d"}<br />{$user.registered|date_format:"%H:%M:%S"}</td>
			<td>{$user.last_login|date_format:"%Y/%m/%d"}<br />{$user.registered|date_format:"%H:%M:%S"}</td>
			<td>
            {if $user.showedit == true}
                <button type="button" onclick="editUser({$user.id}); return false;">Edit User</button>
            {/if}
            </td>
		</tr>

{/foreach}
	</tbody>
</table>

