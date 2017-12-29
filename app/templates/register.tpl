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
{if isset($showregform)}
                                                <h3>{'Feel free to register your personal account'|gettext}</h3>
            								 <form class="form" role="form" method="post" action="{$navdata.login.registerlink}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                        <div class="form-group"> 
                                                            <label for="InputName">{'Your name'|gettext}</label>
                                                            <input name="InputName" type="text" class="form-control" id="InputName" placeholder="{'Your name'|gettext}" required />
                                                        </div>

                                                         <input type="hidden" name="action" value="register" />
                                                         
            											 <div class="form-group">
                                                             <label for="exampleInputEmail2">{'Email address'|gettext}</label>
            											     <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
                                                         </div>
                                                         
                                                         <div class="form-group">
                                                             <label for="exampleInputPassword2">{'New Password'|gettext}<br /><small>{"You password needs to be at least 8 chars long, containing numbers and alphabetic character"|gettext}</small></label>
            											     <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="{'New Password'|gettext}" required>
            											 </div>
                                                         <div class="form-group">
                                                             <label for="exampleInputPassword2">{'Again the new Password'|gettext}</label>
            											     <input name="password2" type="password" class="form-control" id="exampleInputPassword2" placeholder="{'Again the new Password'|gettext}" required>
                                                         </div>
                                                         <button class="btn btn-danger">{'Create your account'|gettext}</button>
            										</div>
                                            </form>
                                       


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