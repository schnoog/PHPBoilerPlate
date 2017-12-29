{if isset($pagedata)}
{include file="htmlhead.tpl" pagedata=$pagedata}
{else}
{include file="htmlhead.tpl"}
{/if}

{if isset($navdata)}
{include file="navigation.tpl" navdata=$navdata}
{else}
{include file="navigation.tpl"}
{/if}


    <!-- Page Content -->
    <div class="container">
    <!-- Page Content -->
    
        <div class="row">
            <div class="col-lg-12 text-center" id="usertable">
            
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
			<td>            {if $user.showedit == true}
                <button type="button" onclick="editUser({$user.id}); return false;">{'Edit User'|gettext}</button>
            {/if}
            </td>
		</tr>

{/foreach}
	</tbody>
</table>

<hr />
{$debugout}

            </div>
            
<!--            
<div id="myModal" class="modal hide">
        <div class="row">
            <div class="col-lg-12 text-center" id="usertable">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
            </div>
        </div>
</div>            
-->            
            
            
            
            
            
            
            
            
            
            
            
            
        </div>
        <!-- /.row -->
    <!-- /.container -->
    </div>
    <!-- /.container -->


{if isset($sectoken)}
{include file="htmlfoot.tpl" sectoken=$sectoken pagedata=$pagedata}
{else}
{include file="htmlfoot.tpl" pagedata=$pagedata}
{/if}