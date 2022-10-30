{$userdata.username}
<form class="form-horizontal">
<fieldset>


<!-- change col-sm-N to reflect how you would like your column spacing (http://getbootstrap.com/css/#forms-control-sizes) -->

{$msg}
<!-- Form Name -->
<legend>Form Name</legend>
<input type="hidden" id="uid" name="uid" value="{$userdata.id}"/>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class="form-group">
  <label for="username" class="control-label col-sm-2">{'User name'|gettext}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="username" placeholder="placeholder" value="{$userdata.username}" required="">
    <p class="help-block">{'Name of the user, needs to be uniqe'|gettext}</p>
  </div>
</div>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class="form-group">
  <label for="password" class="control-label col-sm-2">{'Password'|gettext}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="password" placeholder="placeholder">
    <p class="help-block">{'If set, the password will be changed'|gettext}</p>
  </div>
</div>
<!-- Text input http://getbootstrap.com/css/#forms -->
<div class="form-group">
  <label for="email" class="control-label col-sm-2">{'E-Mail Address'|gettext}</label>
  <div class="col-sm-10">
    <input type="email" class="form-control" id="email" value="{$userdata.email}" placeholder="placeholder" required="">
    
  </div>
</div>
<!-- Input With Combobox http://getfuelux.com/javascript.html#combobox -->
<div class="form-group">
  <label class="control-label col-sm-2" for="status">{'User Status'|gettext}</label>
  <div class="col-sm-10">
    <div class="input-group ">
      
        {html_options  name=status options=$stati selected=$userdata.status class="form-control" id="status"}
      
      
    </div>
    <p class="help-block"></p>
  </div>
</div>
<!-- Appended checkbox http://getbootstrap.com/components/#input-groups-checkboxes-radios -->
<div class="form-group">
  <label class="control-label col-sm-2" for="verifiedInput">{'Verified'|gettext}</label>
  <div class="col-sm-10">
    <div class="input-group" id="verifieddiv">
        <input type="checkbox" class="form-control" aria-label="verified" id="verified" value="verified" {if $userdata.verified == 1}checked="checked"{/if}>
      
    </div>
    
  </div>
</div>
<!-- Appended checkbox http://getbootstrap.com/components/#input-groups-checkboxes-radios -->
<div class="form-group">
  <label class="control-label col-sm-2" for="resettableInput">{'Resettable'|gettext}</label>
  <div class="col-sm-10">
    <div class="input-group" id="resettablediv">
      
        <input type="checkbox" class="form-control" aria-label="resettable" id="resettable" value="resettable"  {if $userdata.resettable == 1}checked="checked"{/if} >
      
    </div>
    <p class="help-block">Will allow or block an user from resetting a forgotten password</p>
  </div>
</div>
<!-- Bootstrap Select http://getbootstrap.com/css/#selects -->
<div class="form-group">
  <label class="control-label col-sm-2" for="userroles">{'User Roles'|gettext}</label>
  <div class="controls  col-sm-10">
  
        {html_ncoptions  name=roles options=$roles selected=$userdata.roles_id_array class="form-control" multiple="" id="roles"}
  

    <p class="help-block"></p>
  </div>
</div>

<!-- Button Group http://getbootstrap.com/components/#btn-groups -->
<div class="form-group">
  <div class="text-right col-sm-10">
    <div id="buttonSaveGroup" class="btn-group" role="group" aria-label="Button Group">
      <button type="button" id="buttonSave" onclick="saveUser('{$userdata.seccode}');" name="buttonSave" class="btn btn-success" aria-label="Save">{'Save'|gettext}</button>
      <button type="button" id="buttonCancel" onclick="UpdateMainTable();" name="buttonCancel" class="btn btn-danger" aria-label="Save">{'Cancel'|gettext}</button>
    </div>
    
    <div id="buttonSaveGroup" class="btn-group" role="group" aria-label="Button Group">
      <button type="button" id="buttonDelete" onclick="DeleteBtn({$userdata.id},'{$userdata.seccode}')" class="confirm-delete btn btn-danger" aria-label="Delete">{'Delete this user'|gettext}</button>
    </div>
    
  </div>
</div>


</fieldset>
</form>

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
