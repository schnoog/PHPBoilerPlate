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
    <div class="take-all-space-you-can">
    <!-- Page Content -->

<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" class="active">
    <a class="nav-link active" href="#info" role="tab" data-toggle="tab">{"Info"|gettext}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#libs" role="tab" data-toggle="tab">{"Libraries and Tools"|gettext}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#docs" role="tab" data-toggle="tab">{"Documentation"|gettext}</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content take-all-space-you-can">

<!--------------------  I  N  F  O ------------------------->
  <div role="tabpanel" class="tab-pane fade active in show" id="info">
                    <div class="row">
                        <div class="col-md-12 text-center">
                        <h2>{'Welcome to this boilerplate application'|gettext}</h2>  
                        <p>{"This application should be a usable starting point for own webbase apps based on  php.<br />Several points led me to the decision to create such a thing on my own."|gettext}</p>
                        <ul>
                        <li>{"I don't like the idea of learning a full sized framework in order to output some function output."|gettext}</li>
                        <li>{"In my opinion not every thing needs to be coded OOP."|gettext}</li>
                        </ul>
                        <p>{"Some of the built in functions are"|gettext}:</p>
                        <ul>
                        <li>{"Routing over the index.php"|gettext}</li>
                        <li>{"Easy page generation"|gettext}</li>
                        <li>{"Ajax-Backend generation"|gettext}</li>
                        <li>{"Dynamic (per page) including of CSS and JS"|gettext}</li>
                        <li>{"Secure user management"|gettext}</li>
                        <li>{"XSS and CSRF protection"|gettext}</li>
                        <li>{"Bootstrap 4"|gettext}</li>
                        <li>{"Dynamic navigation generation"|gettext}</li>
                        <li>{"i18n multilanguage support (gettext)"|gettext}</li>
                        <li>{"...and many more..."|gettext}</li>
                        </ul>  
                        </div>
                    </div>  
  </div>
<!--------------------  I  N  F  O ------------------------->
<!--------------------- L  I  B  S ------------------------->
  <div role="tabpanel" class="tab-pane fade" id="libs">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h1>{'This boilerplate is made out of some cool tools and libs'|gettext}</h1>
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
                 <p>{'A tiny documentation about the functions of this boilerplate'|gettext}</p>
                 <small>{'For the documentation of the libraries/tools used, have a look on the linked homepage'|gettext}</small>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-2" id="doclist">
            
            </div>
            <div class="col-md-10" id="docdetail">

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
