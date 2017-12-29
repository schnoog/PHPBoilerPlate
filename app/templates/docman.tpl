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
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{'Documentation Manager'|gettext}</h2>
                        <button type="button" class="form-control btn btn-success" onclick="openelement('doctable');">{'Open Documentation table'|gettext}</button>                    
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-12" id="maincontainer">
                    
                    </div>
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
