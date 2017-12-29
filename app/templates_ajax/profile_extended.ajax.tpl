{if (isset($dumpX))}{$dump}{/if}
{if isset($setlist)}
<div class="w-100 table-responsive">
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th  width="20%">
				{'Profile field'|gettext}
			</th>
			<th width="70%">
				{'Profile field value'|gettext}
			</th>
			<th  width="10%">
				{'Actions'|gettext}
			</th>
		</tr>
	</thead>
	<tbody>
{foreach $setlist as $set}
		{$wrn=""}{if $set.usersetting_required == 1}{if $set.settingset < 1}{$wrn="class='alert-danger'"}{/if}{/if} 
        <tr id="FRM_{$set.id}">
			<td {$wrn} >
				<h3>{$set.usersetting_key|gettext}</h3>
                {if $set.usersetting_required == 1}
                    {if $set.settingset < 1}
                        <b>{'This Setting is required to complete your profile'|gettext}</b>

                    {/if}
                {/if}                
			</td>
			<td {$wrn} >
                {if (strlen($set.usersetting_preset)>0)}
                    <div>{$set.usersetting_preset}</div>
                {else}
                    <div>
                    <input class="form-control" type="text" id="{$set.usersetting_key}" name="{$set.usersetting_key}" {$set.fieldparameter} value="{$set.value}" />
                    </div>
                {/if}
                {$set.usersetting_desc|gettext}
                {if $set.settingset < 1}
                {if strlen($set.usersetting_default)>0}
                <br /><small>{"If no valid value is set, the following default will be used:"|gettext} <b>{$set.usersetting_default}</b></small>
                {/if}
                {/if}
                				
			</td>
			<td {$wrn} >
                <input type="hidden" name="ID_{$set.usersetting_key}" id="ID_{$set.usersetting_key}" value="{$set.id}"/>
				<button type="button" id="BTN_{$set.usersetting_key}" class="btn btn-success form-control" onclick="validme('{$set.usersetting_key}');">{'Save setting'|gettext}</button>
                
			</td>
		</tr>
        
{/foreach}        
	</tbody>
</table>
</div>
{/if}





{if isset($setpoint)}
    {foreach $setpoint as $set}
		{$wrn=""}{if $set.usersetting_required == 1}{if $set.settingset < 1}{$wrn="class='alert-danger'"}{/if}{/if} 
			<td {$wrn} >
				<h3>{$set.usersetting_key|gettext}</h3>
                {if $set.usersetting_required == 1}
                    {if $set.settingset < 1}
                        {'This Setting is required to complete your profile'|gettext}
                    {/if}
                {/if}
                
			</td>
			<td {$wrn} >
                {if (strlen($set.usersetting_preset)>0)}
                    <div>{$set.usersetting_preset}</div>
                {else}
                    <div>
                    <input class="form-control" type="text" id="{$set.usersetting_key}" name="{$set.usersetting_key}" {$set.fieldparameter} value="{$set.value}" />
                    </div>
                {/if}
                {$set.usersetting_desc|gettext}
                {if $set.settingset < 1}
                {if strlen($set.usersetting_default)>0}
                <br /><small>{"If no valid value is set, the following default will be used:"|gettext} <b>{$set.usersetting_default}</b></small>
                {/if}
                {/if}
                				
			</td>
			<td {$wrn} >
                <input type="hidden" name="ID_{$set.usersetting_key}" id="ID_{$set.usersetting_key}" value="{$set.id}"/>
				<button type="button" id="BTN_{$set.usersetting_key}" class="btn btn-success form-control" onclick="validme('{$set.usersetting_key}');">{'Save setting'|gettext}</button>
                
			</td>
		
{/foreach}        
{/if}







