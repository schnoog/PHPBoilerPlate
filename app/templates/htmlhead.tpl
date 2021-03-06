<!DOCTYPE html>
<html lang="{$pagedata.language|default:"en"}">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{$pagedata.description|default:""}" />
    <meta name="author" content="{$pagedata.content|default:""}" />

    <title>{$pagedata.title|default:"Title"}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{$pagedata.baseurl}css/bootstrap.min.css" rel="stylesheet" />
    <link href="{$pagedata.baseurl}css/bootstrap-4-navbar.css" rel="stylesheet" />
 <!--    <link href="css/jumbotron.css" rel="stylesheet" /> -->
    <link href="{$pagedata.baseurl}css/main.css" rel="stylesheet" />
 
 <link href="{$pagedata.baseurl}css/fontawesome-all.css" rel="stylesheet">
  
 
 
    {if isset($pagedata.headincludes.css)}
    {foreach $pagedata.headincludes.css as $headinc}
    <link href="{$pagedata.baseurl}css/{$headinc}" rel="stylesheet" />
    {/foreach}
    {/if}
    
    <!-- FA likes to be included in head -->
<!--    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script> -->  
    
    
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->





</head>
<body>
