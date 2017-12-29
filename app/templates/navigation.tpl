<!--------------------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------------------------  N A V    B E G I N N ----------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar01">
<!--------------------------------------------------------------------------------------------------------------------------------->
        <ul class="navbar-nav navbar-right">
{if $navdata.login.loggedin === true}        
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hello {$navdata.login.displayname}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">

                    <a class="dropdown-item" href="#"><form class="form" role="form" method="post" action="{$navdata.login.profile}" accept-charset="UTF-8" id="profile-nav">
										               <div class="form-group"><button type="submit" class="btn btn-primary btn-block">{'Your profile'|gettext}</button>
        										       </div>
    								                  </form>
                    </a>
                    <a class="dropdown-item" href="#"><form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="logout-nav">
        										       <div class="form-group"><input type="hidden" name="action" value="logout" /><button type="submit" class="btn  btn-block btn-danger">{'Log out'|gettext}</button>
            										   </div>
                                                      </form>
                    </a>
                </div>
            </li>
{else}          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign in</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown02">
            							<div class="col-md-12">
            								Login {if isset($navdata.login.social)}{if $navdata.login.social === true}via
            								<div class="social-buttons">
            									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
            									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
            								</div>
                                            or{/if}{/if}
            								 <form class="form" role="form" method="post" action="{$navdata.login.logintarget}" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
                                                         <input type="hidden" name="action" value="login" />
            											 <label class="sr-only" for="exampleInputEmail2">{'Email address'|gettext}</label>
            											 <input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="{'Email address'|gettext}" required>
            										</div>
            										<div class="form-group">
            											 <label class="sr-only" for="exampleInputPassword2">{'Password'|gettext}</label>
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
            							<div class="bottom text-center">
            								{'New here ?'|gettext} <a href="{$navdata.login.registerlink}"><b>{'Join Us'|gettext}</b></a>
            							</div>
                    </div>
            </li>
{/if}            
        </ul>
<!--------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------ dynamic start ------------------------------------------------------------>
<!--------------------------------------------------------------------------------------------------------------------------------->
{if isset($navdata.navtree)}{$navdata.navtree}{/if}        
<!--------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------- dynamic end ------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->           
{if $navdata.admin.visible === true}
        <ul class="navbar-nav mr-auto">          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown00" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{'Administration'|gettext}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown00">
          
            {foreach key=schluessel item=wert from=$navdata.adminpages}
              <a class="dropdown-item" href="{$schluessel}">{$wert}</a>
            {/foreach}
            </div>
          </li>          
        </ul>
{/if}          


      </div>
    </nav>
<!--------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------  N A V    E N D ------------------------------------------------------>
<!--------------------------------------------------------------------------------------------------------------------------------->