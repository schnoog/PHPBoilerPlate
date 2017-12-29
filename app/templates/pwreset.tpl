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
{if isset($showreset)}
            								 <form class="form" role="form" method="post" action="{$navdata.login.pwreset}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="reset" />
            											 <label  for="exampleInputEmail2">{'Email address'|gettext}</label>
            											 <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
                                                         <button class="btn btn-danger">{'Send the instruction email'|gettext}</button>
            										</div>
                                            </form>
            								 <form class="form" role="form" method="post" action="{$navdata.login.pwreset}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="activate" />
                                                         <button class="btn btn-danger">{'I received the password reset email.'|gettext}</button>
            										</div>
                                            </form>                                            


{/if}
{if isset($showactivation)}
            								 <form class="form" role="form" method="post" action="{$navdata.login.pwreset}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="activate" />
            											 <label  for="Security-Key">Security-Key</label>
            											 <input name="seckey" type="text" class="form-control" id="Security-Key" placeholder="Security-Key" required>
            											 <label  for="Security-Token">Security-Token</label>
            											 <input name="sectoken" type="text" class="form-control" id="Security-Token" placeholder="Security-Token" required>
            											 <label  for="exampleInputPassword2">{'New Password'|gettext}<br /><small>{"You password needs to be at least 8 chars long, containing numbers and alphabetic character"|gettext}</small></label>
            											 <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="New Password" required>
            											 <label  for="exampleInputPassword2">{'Again the new Password'|gettext}</label>
            											 <input name="password2" type="password" class="form-control" id="exampleInputPassword2" placeholder="{'Again the new Password'|gettext}" required>

                                                         <button class="btn btn-danger">{'Reset the password'|gettext}</button>
            										</div>
                                            </form>

{/if}




{if isset($showlogin)}
                <div class="row">
                    <div class="col-md-12">
            								Login {if isset($navdata.login.social)}{if $navdata.login.social === true}via
            								<div class="social-buttons">
            									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
            									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
            								</div>
                                            or{/if}{/if}
            								 <form class="form" role="form" method="post" action="{$navdata.login.pwreset}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="login" />
            											 <label  for="exampleInputEmail2">{'Email address'|gettext}</label>
            											 <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
            										</div>
            										<div class="form-group">
            											 <label  for="exampleInputPassword2">{'Password'|gettext}</label>
            											 <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="{'Password'|gettext}" required>
                                                         <div class="help-block text-right"><a href="{$navdata.login.pwreset}">{'Forget the password ?'|gettext}</a></div>
            										</div>
            										<div class="form-group">
            											 <button type="submit" class="btn btn-primary btn-block">{'Sign in'|gettext}</button>
            										</div>
            										<div class="checkbox">
            											 <label>
            											 <input name="remember" type="checkbox" /> {'keep me logged-in'|gettext}
            											 </label>
            										</div>
            								 </form>
            							</div>
                       </div>
                 </div>                                        
{/if}                                        
        <!-- /.row -->
    <!-- /.container -->
    </div>
    <!-- /.container -->


{if isset($sectoken)}
{include file="htmlfoot.tpl" sectoken=$sectoken pagedata=$pagedata}
{else}
{include file="htmlfoot.tpl" pagedata=$pagedata}
{/if}