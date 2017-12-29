{if isset($editoradd)}
<h3>{'Profile item'|gettext}</h3>
<input type="hidden" id="id" value="{if isset($prodata)}{$prodata.id}{else}0{/if}" />
<label for="usersetting_key">{'Profile field key<br /><small>An easy, readable identified</small>'}</label>
<input type="text" class="form-control" id="usersetting_key" value="{if isset($prodata)}{$prodata.usersetting_key}{/if}" required="required"/>

<label for="usersetting_desc">{'Profile field description<br /><small>This will be displayed to the user as meaning for this field</small>'}</label>
<input type="text" class="form-control" id="usersetting_desc" value="{if isset($prodata)}{$prodata.usersetting_desc}{/if}" required="required"/>

<label for="usersetting_default">{'Default value<br /><small>If a user not manually setting a value, this one will be taken</small>'}</label>
<input type="text" class="form-control" id="usersetting_default" value="{if isset($prodata)}{$prodata.usersetting_default}{/if}" />

<label for="usersetting_typevaliparameter">{'Validation parameter<br /><small>A &#124; delimited string with all the validation parameter (from werx/validation)</small>'}</label>
  <a  data-toggle="collapse" href="#collapseusersetting_typevaliparameter" aria-expanded="false" aria-controls="collapseusersetting_typevaliparameter">
    {'More information'|gettext}
  </a>
  <div class="collapse" id="collapseusersetting_typevaliparameter">
    <div class="card card-body">
            <h4>{'Pipe-delimited list of rules'|gettext}</h4>
            {'Each rule corresponds to a method name from the Validator class'|gettext}<br />
            {'If the method accepts arguments, the args should be in square brackets after the rule name'|gettext}<br />
            {'Example: minlength[2]'|gettext}<br />
            {'Exception: methods which accept an array as parameter should be in curly brackets after the rule name.'|gettext}<br />
            {'Example:'|gettext} inlist&#123;{'red,white,blue'|gettext}&#125;<br />
            {'Except for the required validator, all validators will return true if the input is empty.'|gettext}<br />
            <b>{'In other words, minlength[2] will only actually fire if you also add a required rule.'|gettext}</b><br />
            
            <h5>{'The following validation methods are available'|gettext}</h5>
            <ul>
            <li>required  {'Set this if you are not allowing an empty value, example:'|gettext} <b>required</b>
            </li><li>date [ string $input_format ] ] {'Default: MM/DD/YYYY Other input formats available YYYY/MM/DD, YYYY-MM-DD, YYYY/DD/MM, YYYY-DD-MM, DD-MM-YYYY, DD/MM/YYYY, MM-DD-YYYY, MM/DD/YYYY, YYYYMMDD, YYYYDDMM , example:'|gettext} <b>date[DD-MM-YYYY]</b>
            </li><li>minlength[ int $min ] {'Minimum length, example:'|gettext} <b>minlength[3]</b>
            </li><li>maxlength[ int $max ] {'Maximum length, example:'|gettext} <b>maxlength[3]</b>
            </li><li>exactlength[ int $length ] {'Exact length (no need to set min- and maxlength to the same number), example:'|gettext} <b>exactlength[3]</b>
            </li><li>greaterthan[ int $min ] {'Greater than (integer), example:'|gettext} <b>greaterthan[100]</b>
            </li><li>lessthan[ int $max ] {'Less than (integer), example:'|gettext} <b>lessthan[127]</b> 
            </li><li>alpha {'Only a-z and A-Z are allowed, no whitespaces no special chars, example:'|gettext} <b>alpha</b>
            </li><li>alphanumeric {'Only a-z, A-Z and 0-9 are allowed, no whitespaces no special chars, example:'|gettext} <b>alphanumeric</b>
            </li><li>integer {'Only integer values are allowed, example:'|gettext} <b>integer</b>
            </li><li>float {'Only float values are allowed, example:'|gettext} <b>float</b>
            </li><li>numeric  {'Only numeric values are allowed, example:'|gettext} <b>numeric</b>
            </li><li>email  {'Only valid email addresses are allowed, example:'|gettext} <b>email</b>
            </li><li>url {'Only valid url strings are allowed, example:'|gettext} <b>url</b>
            </li><li>phone {'The value must be a valid <b>US</b> phone number, example:'|gettext} <b>phone</b>
            </li><li>zipcode {'The value must be a valid <b>US</b> zip code, example:'|gettext} <b>zipcode</b>
            </li><li>startswith[ string $match ] {'The value must start with the given string, example:'|gettext} <b>startswith[abcd]</b>
            </li><li>endswith[ string $match ] {'The value must end with the given string, example:'|gettext} <b>endswith[xyz]</b>
            </li><li>contains[ string $match ] {'The value must contain the given string, example:'|gettext} <b>contains[mno]</b>
            </li><li>regex[ string $regex ] {'The value must match with the given regex string ( regex without &#091; and &#093; ), example:'|gettext} <b>regex[You regex]</b>
            </li><li>inlist[ array $list ] {'The value must be in the given list, example:'|gettext} <b>{literal}inlist{red,blue,white}{/literal}</b>
            </li>
            </ul>   
    </div>
  </div>
<input type="text" class="form-control" id="usersetting_typevaliparameter" value="{if isset($prodata)}{$prodata.usersetting_typevaliparameter}{/if}" />

<label for="usersetting_desc">{'User required to set this<br /><small>If this is set, an userprofile will be marked incomplete until the user entered valid data into this profile field</small>'}</label>
<select class="form-control" id="usersetting_required">
    <option value="0" {if isset($prodata)}{if $prodata.usersetting_required == 0}selected="selected" {/if}{/if}>{'No'|gettext}</option>
    <option value="1" {if isset($prodata)}{if $prodata.usersetting_required == 1}selected="selected" {/if}{/if}>{'Yes'|gettext}</option>
</select>


<label for="usersetting_desc">{'Preset <br /><small>Parameter for the presetrequest function</small>'}</label>
  <a  data-toggle="collapse" href="#collapseusersetting_desc" aria-expanded="false" aria-controls="collapseusersetting_desc">
    {'More information'|gettext}
  </a>
  <div class="collapse" id="collapseusersetting_desc">
    <div class="card card-body">
                 <h4>Presets</h4>
                 <p>{'This is intended to define the datasource for your preset. If not meaningfull for a setting (f.e. first name), leave it empty'|gettext} </p>
                 <ul>{'
                             <li> This is the main presetrequest function
                             </li><li> It uses the "$request" String to get valid options (when required, for example language setting limitation on availables)
                             </li><li> 
                             </li><li> The request should consist of (I assume the function to call is getmylist)
                             </li><li> a) >getmylist< one function name. The function will be called without parameter $x = getmylist()
                             </li><li> b) >getmylist:onlynice< one fuction name and one parameter, delimited by :   $x= getmylist(onlynice)
                             </li><li> c) >getmylist:onlynice:second:...:last< one fuction name and one parameter, delimited by :   $x= getmylist(onlynice, second,....,last)
                             </li><li> d) >SETTINGS:langs:available< an array out of the main settings
                             </li><li> or >SETTINGS:pages<     (if a return value is not an array, it will be intergated in one $x=array($y))
                             </li><li> 
                             </li><li> If the returned value is numeric, ensure that the value is NOT! only the array key!
                             </li><li> 
                             </li><li> <b>Warning:</b>
                             </li><li> The function call is not secured by any white- or blacklist. Each function available in the php enviroment is callable
                             </li><li> Therefore this section is limited to the adminroles.
                             </li> '|gettext}
                 </ul>    
    </div>
  </div>
<input type="text" class="form-control" id="usersetting_preset" value="{if isset($prodata)}{$prodata.usersetting_preset}{/if}" />

<label for="usersetting_limittopreset">{'Limit to preset <br /><small>Only values available in preset will be accepted</small>'}</label>
<select class="form-control" id="usersetting_limittopreset">
    <option value="0" {if isset($prodata)}{if $prodata.usersetting_limittopreset == 0}selected="selected" {/if}{/if}>{'No'|gettext}</option>
    <option value="1" {if isset($prodata)}{if $prodata.usersetting_limittopreset == 1}selected="selected" {/if}{/if}>{'Yes'|gettext}</option>
</select>
<br />
<button type="button" class="btn btn-success form-control" onclick="saveprofileitem();">Save changes</button>

<button type="button" class="btn btn-warning form-control" onclick="proftable();">Cancel</button>
{/if}

<!--
//`user_settingkeys` (`id`, `usersetting_key`, `usersetting_desc`, `usersetting_default`,
// `usersetting_typevaliparameter`, `usersetting_required`, `usersetting_preset` , usersetting_limittopreset)
-->

{if isset($prolist)}
<h3>Profile items</h3>
<button type="button" class="btn btn-success form-control" onclick="editprofileitem('0');">{'Add a new profile field'|gettext}</button>

<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th>
				{'ID'|gettext}
			</th>
			<th>
				{'Item key'|gettext}
			</th>
			<th>
				{'Item desc.'|gettext}
			</th>
			<th>
				{'Item default value'|gettext}
			</th>
			<th>
				{'Validation parameter'|gettext}
			</th>
			<th>
				{'Is required'|gettext}
			</th>
			<th>
				{'Preset values'|gettext}
			</th>
			<th>
				{'Actions'|gettext}
			</th>
		</tr>
	</thead>
	<tbody>       
{foreach $prolist as $listitem}    
		<tr>
			<td>
				{$listitem.id}
			</td>
			<td>
				{$listitem.usersetting_key}
			</td>
			<td>
				{$listitem.usersetting_desc}
			</td>
			<td>
				{$listitem.usersetting_default}
			</td>
			<td>
				{$listitem.usersetting_typevaliparameter}
			</td>
			<td>
			
    {if $listitem.usersetting_required == 1}
        <i class="fas fa-toggle-on"></i><br /><small>{"Yes"|gettext}</small>
    {else}
        <i class="fas fa-toggle-off"></i><br /><small>{"No"|gettext}</small>
    {/if}                
			</td>
			<td>
				{$listitem.usersetting_preset}
			</td>
			<td>
				<button type="button" class="btn btn-warning" onclick="editprofileitem('{$listitem.id}');">{'Edit'|gettext}</button>
                <button type="button" class="btn btn-danger" onclick="deleteprofileitem('{$listitem.id}');">{'Delete'|gettext}</button>
			</td>
		</tr>
{/foreach}        
        
	</tbody>
</table>
{/if}