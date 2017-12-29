<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  
    <!-- Brand and toggle get grouped for better mobile display -->
    
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Login dropdown</a>
    

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      
      {if $navdata.login.loggedin === true}
                    <li><p class="navbar-text">Hello {$navdata.login.displayname}</p></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>{$navdata.login.displayname}</b> <span class="caret"></span></a>
            			<ul id="loggedin-dp" class="dropdown-menu">
            				<li>
            					 <div class="row">
            							<div class="col-md-12">
            								 
            								 <form class="form" role="form" method="post" action="logout" accept-charset="UTF-8" id="logout-nav">
        										<div class="form-group">
            											 <button type="submit" class="btn  btn-block btn-danger">Log out</button>
            										</div>

            								 </form>
                                             <form class="form" role="form" method="post" action="{$navdata.login.profile}" accept-charset="UTF-8" id="logout-nav">
        										<div class="form-group">
            											 <button type="submit" class="btn btn-primary btn-block">Your profile</button>
            										</div>

            								 </form>
            							</div>
            					 </div>
            				</li>
            			</ul>
                    </li>
                    
      {else}
      
                    <li><p class="navbar-text">Already have an account?</p></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            			<ul id="login-dp" class="dropdown-menu">
            				<li>
            					 <div class="row">
            							<div class="col-md-12">
            								Login {if isset($navdata.login.social)}{if $navdata.login.social === true}via
            								<div class="social-buttons">
            									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
            									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
            								</div>
                                            or{/if}{/if}
            								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
            										<div class="form-group">
            											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
            											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
            										</div>
            										<div class="form-group">
            											 <label class="sr-only" for="exampleInputPassword2">Password</label>
            											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                         <div class="help-block text-right"><a href="{$navdata.login.pwreset}">Forget the password ?</a></div>
            										</div>
            										<div class="form-group">
            											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            										</div>
            										<div class="checkbox">
            											 <label>
            											 <input type="checkbox" /> keep me logged-in
            											 </label>
            										</div>
            								 </form>
            							</div>
            							<div class="bottom text-center">
            								New here ? <a href="#"><b>Join Us</b></a>
            							</div>
            					 </div>
            				</li>
            			</ul>
                    </li>
                    
        {/if}
        
      </ul>
    </div><!-- /.navbar-collapse -->
  
</nav>