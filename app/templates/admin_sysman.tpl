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




<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#profilefields" role="tab" data-toggle="tab">{'Profile fields'|gettext}</a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="#system" role="tab" data-toggle="tab">{'System'|gettext}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#navigation" role="tab" data-toggle="tab">{'Navigation'|gettext}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#acl" role="tab" data-toggle="tab">{'ACL'|gettext}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tools" role="tab" data-toggle="tab">{'Tools'|gettext}</a>
  </li>
  
</ul>

<!-- Tab panes -->
<div class="tab-content">
<!------------------- PROFILEFIELDS ------------------------->
  <div role="tabpanel" class="tab-pane fade in active show" id="profilefields">
        <div class="row">
            <div class="col-md-12" id="protab">
            </div>
        </div>       
<!--
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>       
-->  
  
  </div>
<!------------------- PROFILEFIELDS ------------------------->
<!-------------------- S Y S T E M ------------------------->
  <div role="tabpanel" class="tab-pane fade" id="system">
  
  
  
  </div>
<!-------------------- S Y S T E M ------------------------->
<!--------------------- NAVIGATION ------------------------->
  <div role="tabpanel" class="tab-pane fade" id="navigation">
        <div class="row">
            <div class="col-md-12">
                <h2>{'Navigation-Tree Management'|gettext}</h2>
                    <p><small>{'Create new menues on the fly. '|gettext}<b>{'Be aware:'|gettext}</b> {'Dropdown-Fields cannot be used as link.'|gettext}</small></p> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="updateBtn"><button type="button" class="form-control" onclick="updateNavTree();">{'Reload from database'|gettext}</button></div>

            <div class="col-md-6" id="saveBtn"><button type="button" class="form-control" onclick="savemenue();">{'Save the current menue'|gettext}</button></div>
        </div>    
        <div class="row">
            <div class="col-md-6" id="navset">
                {if isset($blabla)}{$pagedata.navset}{/if} 
            </div>
            <div class="col-md-6" id="navact">
            </div>
        </div>
  </div>
<!--------------------- NAVIGATION ------------------------->
<!--------------------- A   C   L  ------------------------->  
  <div role="tabpanel" class="tab-pane fade" id="acl">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>{'Page ACL'|gettext}</h2>
                    <p><small>
                    <ul class="form-control">
                    <li >{'Sys-Pages have own access control functions and are not blocked for any user by the page ACL'|gettext}</li>
                    <li >{'Pages with ACL deactivated are also not secured'|gettext}</li>
                    <li >{'If no usergroup is assigned to a page ACL, all groups are allowed'|gettext}</li>                                        
                    </ul>
                    
                    </small></p> 
            </div>
            <div class="col-md-2"></div>            
        </div>
        <div class="row">
            <div class="col-md-6" id="showPagesBtn"><button type="button" class="form-control" onclick="showpages();">{'Reload from database'|gettext}</button></div>

            <div class="col-md-6" id="updatePagesBtn"><button type="button" class="form-control" onclick="updatepages();">{'Scan for new pages'|gettext}</button></div>
        </div>    
        <div class="row">
            <div class="col-md-12" id="pageset">
                 
            </div>
        </div>  
  
  
  </div>
<!--------------------- A   C   L  ------------------------->
<!--------------------  T O O L S  ------------------------->
  <div role="tabpanel" class="tab-pane fade in active" id="tools">
    <div class="row">
        <div class="col-md-12">
        
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <button type="button" class="form-control btn btn-success" onclick="createpage();">{'Create a new page'|gettext}</button>
        </div>
        <div class="col-md-6">
        {"Creating a new page is no big deal.<br /> Enter the desired pagename, choose whether a JS template should be created and linked, and let's rock."|gettext}
        </div>        
    </div> 
    <hr />
    <div class="row">
        <div class="col-md-6">
        <button type="button" class="form-control btn btn-success" onclick="getusergroups();">{'Usergroup calculator'|gettext}</button>
        </div>
        <div class="col-md-6" id="ucc">
        {"The user groups combinations are saved as bitmask.<br />With this little calculator, you will be able to calculate the result of any valid group combination."|gettext}
        </div>        
    </div>
    <hr />      
    <div class="row">
        <div class="col-md-6">
        <button type="button" class="form-control btn btn-success" onclick="compile_templates();">{'Compile all templates'|gettext}</button>
        </div>
        <div class="col-md-6" id="ucc">
        {"This will compile all templates to the templates cache directory. <br />This will allow you to parse this directory for new translation strings within any template."|gettext}
        </div>        
    </div>      
    
  
  
  
  </div>
<!--------------------  T O O L S ------------------------->
</div>





    

    <!-- /.container -->
    </div>
    <!-- /.container -->


{if isset($sectoken)}
{include file="htmlfoot.tpl" sectoken=$sectoken pagedata=$pagedata}
{else}
{include file="htmlfoot.tpl" pagedata=$pagedata}
{/if}