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
{if isset($showactivationrequest)}
            								 <form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="resend" />
            											 <label  for="exampleInputEmail2">{'Email address'|gettext}</label>
            											 <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
                                                         <button class="btn btn-danger">{'Resend the activation email'|gettext}</button>
            										</div>
                                            </form>
            								 <form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="activate" />
                                                         <button class="btn btn-danger">{'I received the activation email.'|gettext}</button>
            										</div>
                                            </form>                                            


{/if}
{if isset($showactivation)}
            								 <form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="activate" />
            											 <label  for="Security-Key">Security-Key</label>
            											 <input name="seckey" type="text" class="form-control" id="Security-Key" placeholder="Security-Key" required>
            											 <label  for="Security-Token">Security-Token</label>
            											 <input name="sectoken" type="text" class="form-control" id="Security-Token" placeholder="Security-Token" required>

                                                         <button class="btn btn-danger">{'Activate the account'|gettext}</button>
            										</div>
                                            </form>

{/if}




{if isset($showlogin)}
                <div class="row">
                    <div class="col-md-12">
            								Login 
{if isset($navdata.login.social)}{if $navdata.login.social === true}via
    <div class="social-buttons">

{$x=0}
<table><tr>
{foreach $navdata.login.socialprovider as $provider}
    {$x = $x +1}
    {$bt = 'primary'}
        {if $x is even} 
            {$bt = 'info'}
        {/if}        
    <td><a href="{$navdata.login.socialpage}?provider={$provider}" class="btn btn-lg btn-block btn-{$bt}"><i class="fas fa-sign-in-alt"></i> {$provider}</a></td>
        {if (($x % 6) == 0)}</tr><tr>{/if}
{/foreach}
</tr></table>
    </div>
    or
{/if}{/if}
            								 <form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="login-nav2">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="login" />
            											 <label  for="exampleInputEmail2a">{'Email address'|gettext}</label>
            											 <input name="email" autocomplete="email" type="email" class="form-control" id="exampleInputEmail2a" placeholder="{'Email address'|gettext}" required>
            										</div>
            										<div class="form-group">
            											 <label  for="exampleInputPassword2a">{'Password'|gettext}</label>
            											 <input name="password" type="password" autocomplete="current-password" class="form-control" id="exampleInputPassword2a" placeholder="{'Password'|gettext}" required>
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



{if isset($sectoken)}
{include file="htmlfoot.tpl" sectoken=$sectoken pagedata=$pagedata}
{else}
{include file="htmlfoot.tpl" pagedata=$pagedata}
{/if}