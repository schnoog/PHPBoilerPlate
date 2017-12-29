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
            <div class="col-lg-12 text-center">

{if isset($problems)}
<h1>{'The following problem occoured'|gettext}</h1>
<ul>
{foreach $problems as $item}
<li><h2><div class="alert alert-danger">{$item}</div></h2></li>
{/foreach}
</ul>
{/if}

{if isset($solutions)}
<h1>{'Possible solutions'|gettext}</h1>
<ul>
{foreach $solutions as $item}
<li><h2><div class="alert alert-success">{$item}</div></h2></li>
{/foreach}
</ul>
{/if}


{if isset($debugout)}{$debugout}{/if}

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
