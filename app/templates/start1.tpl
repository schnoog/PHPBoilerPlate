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
    <a class="nav-link active" href="#info" role="tab" data-toggle="tab">Info</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#libs" role="tab" data-toggle="tab">Libraries and Tools</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#docs" role="tab" data-toggle="tab">Documentation</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
<!--------------------  I  N  F  O ------------------------->
  <div role="tabpanel" class="tab-pane fade in active" id="info">
  
  
  
  </div>
<!--------------------  I  N  F  O ------------------------->
<!--------------------- L  I  B  S ------------------------->
  <div role="tabpanel" class="tab-pane fade" id="libs">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h1>This boilerplate is made out of some cool tools and libs</h1>
                            {foreach $libs as $label => $lib}
                            <div class="alert alert-success">
                            <strong>{$lib.0}</strong><br />
                            <small>
                            {$label}
                            <a href="{$lib.1}" target="_blank" title="Link to {$lib.0} page">{$lib.1}</a>
                            <br /> 
                            License:{$lib.2}
                            </small>
                            </div>
                            {/foreach}
                        </div>
                    </div>
        <!-- /.row -->

  </div>
<!--------------------- L  I  B  S ------------------------->
<!--------------------- D  O  C  S ------------------------->  
  <div role="tabpanel" class="tab-pane fade" id="docs">
        <div class="row">
            <div class="col-md-12" id="dochead">
                 <p>A tiny documentation about the functions of this boilerplate</p>
                 <small>For the documentation of the libraries/tools used, have a look on the linked homepage</small>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-4" id="doclist">
            
            </div>
            <div class="col-md-8" id="docdetail">

            </div>
            
        </div>
  
  
  </div>
<!--------------------- D  O  C  S ------------------------->
</div>


















    
    <!-- /.container -->
    </div>
    <!-- /.container -->


{if isset($sectoken)}
{include file="htmlfoot.tpl" sectoken=$sectoken pagedata=$pagedata}
{else}
{include file="htmlfoot.tpl" pagedata=$pagedata}
{/if}
