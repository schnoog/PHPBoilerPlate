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
                    <div class="col-md-12">
                    <h3>{$msg}</h3>
                    </div>
                </div>




                <div class="row">
                        <div class="col-md-12">
                    {if isset($showform)}
            								<h3>{'Your profile'|gettext}</h3> 
                                            
            								 <form class="form" role="form" method="post" action="{$navdata.login.profile}" accept-charset="UTF-8" id="profildet-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="profilechange" />
            											 <label  for="exampleInputEmail2">{'Email address'|gettext}<br /><small><b>{'changing it will require a verification to be finalzed'|gettext}</b></small></label>
            											 <input value="{$user.email}" name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
            										</div>
            										<div class="form-group">
                                                         <label  for="exampleInputEmail2">{'Your Name'|gettext}<br /><small><b>{'this is the name displayed on our page'|gettext}</b></small></label>
            											 <input value="{$user.name}" name="name" type="text" class="form-control" id="name" placeholder="{'User name'|gettext}" required>
            										</div>
            										<div class="form-group">
            											 <label  for="password">{'Current Password'|gettext}<br /><small><b>{'required for any change'|gettext}</b></small></label>
            											 <input name="password" type="password" class="form-control" id="password" placeholder="{'Password'|gettext}" required>
            										</div>
            										<div class="form-group">
            											 <label  for="npw1">{'New Password'|gettext}<br /><small><b>{'leave empty to not change it'|gettext}</b></small><br /><small>{"You password needs to be at least 8 chars long, containing numbers and alphabetic character"|gettext}</small></label>
            											 <input name="npw1" type="password" class="form-control" id="npw1" placeholder="{'Password'|gettext}" >
            										</div>                                                    
            										<div class="form-group">
            											 <label  for="npw2">{'Again the new Password'|gettext}</label>
            											 <input name="npw2" type="password" class="form-control" id="npw2" placeholder="{'Password'|gettext}" >
            										</div>                                                    

            										<div class="form-group">
            											 <button type="submit" class="btn btn-primary btn-block">{'Update your profile'|gettext}</button>
            										</div>

            								 </form>
                     {/if}
                     <a class="btn btn-primary form-control btn-success"  href="profile_extended" title="{'To the Extended Profile'|gettext}">
                        {'To the Extended Profile'|gettext}
                     </a>
                     
                            </div>
                       </div>
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