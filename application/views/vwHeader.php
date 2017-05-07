<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.ico">
    <title>Inspection</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
	<link href="<?php echo HTTP_CSS_PATH; ?>simple-sidebar.css" rel="stylesheet">
	<link href="<?php echo HTTP_CSS_PATH; ?>main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
      
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
	<script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
      
  </head>
<style>  
  .active a{
    color: #fff;
    background-color: #08336c;
}
</style>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'home'  ;    
    ?>
	<nav class="navbar navbar-default no-margin">
    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header fixed-brand col-xs-4">
			<a href="#menu-toggle" class="navbar-brand" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
		<div class="navbar-header fixed-brand col-xs-8">
			
			<a class="navbar-brand" href="#"><img src="<?php echo HTTP_CSS_PATH;?>logo-dark.png" height="30"/>  Client inspection</a>
		</div><!-- navbar-header-->
    </nav>
    
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?php echo base_url(); ?>">
                        Client inspection
                    </a>
                </li>
				<li <?php echo  $pg =='inspection_res' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>home/inspection_res">Inspection &amp; Audit</a></li>
				<li <?php echo  $pg =='Checklist' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>checklist">Checklist</a></li>
				<li <?php echo  $pg =='inventory' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>home/inventory">Inventory</a></li>
				<li <?php echo  $pg =='assets' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>home/assets">Fixed Assets</a></li>
                <li <?php echo  $pg =='variance' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>home/variance" >Variance</a></li>
				<li <?php echo  $pg =='videos' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>videos" >Stream Video</a></li>
                <li <?php echo  $pg =='signup' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>home/logout">Logout</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">