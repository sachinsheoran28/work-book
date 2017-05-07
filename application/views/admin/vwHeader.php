<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="admin@dealsontips.com">
        <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.ico">
        <?php if ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == 'users' || $this->uri->segment(2) == 'vtp' || $this->uri->segment(2) == 'center' || $this->uri->segment(2) == 'questions' || $this->uri->segment(2) == 'checklist' || $this->uri->segment(2) == 'Checklist' || $this->uri->segment(2) == 'inventory' || $this->uri->segment(2) == 'Inventory' || $this->uri->segment(2) == 'assets' || $this->uri->segment(2) == 'Assets') { ?>
            <title><?php echo SITE_TITLE . "::" . $title; ?></title>
        <?php } else { ?> 
            <title><?php echo SITE_TITLE; ?></title>
        <?php } ?>


        <!-- Bootstrap core CSS -->
        <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
        <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap-datetime.css" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
        <!-- Add custom CSS here -->
        <link href="<?php echo HTTP_CSS_PATH; ?>arkadmin.css" rel="stylesheet">
        <!-- JavaScript -->
        <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>moment.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.11.3.min.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>bootstrap-datetime.js"></script>
        <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
        <!--<script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>--->
        <link href="<?php echo HTTP_CSS_PATH; ?>main.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
          <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
        <![endif]-->
        <!--  
    
        -->

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>admin"><img src="<?php echo HTTP_CSS_PATH; ?>logo-dark.png"/> Audit Services</a>
                </div>
                <?php
                // Define a default Page
                //$pg = isset($page) && $page != '' ?  $page :'dash'  ;    
                $pg = $this->uri->segment(2);
                ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li <?php echo $pg == 'dash' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard"> Dashboard</a></li>	 
                        <li <?php echo $pg == 'users' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/users"> Auditor</a></li>
                        <li <?php echo $pg == 'vtp' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/vtp"> Client</a></li>
                        <li <?php echo $pg == 'center' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/center"> Client Office</a></li>
                        <li <?php echo $pg == 'questions' ? 'class="main_cls_drop active"' : 'class="main_cls_drop"' ?> ><a href="javascript:void(0);"> Audit<i class="fa fa-caret-down custom_drop" aria-hidden="true"></i></a>
                            <ul class="modify_sidebar">
                                <li <?php echo $pg == 'questions' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/questions"> Inspection &amp; Audit</a></li>
                                <li <?php echo $pg == 'checklist' || $pg == 'Checklist' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/checklist"> Checklist</a></li>
                                <li <?php echo $pg == 'inventory' || $pg == 'Inventory' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/inventory"> Inventory</a></li>
                                <li <?php echo $pg == 'assets' || $pg == 'Assets' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/assets">Fixed Assets</a></li>
                            </ul>
                        </li>	
                        <li <?php echo $pg == 'live videos' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/videos/view" >Live Video</a></li>
                        <li <?php echo $pg == 'videos' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/videos"> Saved Video</a></li>
                        <li <?php echo $pg == 'results' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/results"> Inspection Results</a></li>
                        <li <?php echo $pg == 'checklistresults' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/checklistresults">Checklist Results</a></li>
                        <li <?php echo $pg == 'inventoryresults' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/inventoryresults">Inventory Results</a></li>
                        <li <?php echo $pg == 'assetsresults' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/assetsresults">Assets Results</a></li>
						<li <?php echo $pg == 'variance' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/variance">View Variance</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">

                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username') ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu ">
                                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>admin/home/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <script>
                $(document).on('click', '.main_cls_drop', function () {
                    if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                        $('.modify_sidebar').hide();
                        $('.custom_drop').removeClass("fa fa-caret-up");
                        $('.custom_drop').addClass("fa fa-caret-down");
                    } else {
                        $(this).addClass("active");
                        $('.modify_sidebar').show();
                        $('.custom_drop').removeClass("fa fa-caret-down");
                        $('.custom_drop').addClass("fa fa-caret-up");
                    }
                });

                $(document).ready(function () {
                    var controller_name = "<?php echo $this->uri->segment(2); ?>";
                    if (controller_name == 'questions' || controller_name == 'Checklist' || controller_name == 'checklist' || controller_name == 'Inventory' || controller_name == 'inventory' || controller_name == 'assets' || controller_name == 'Assets') {
                        $('.modify_sidebar').show();
                        $('.main_cls_drop').removeClass("active");
                        $('.custom_drop').removeClass("fa fa-caret-down");
                        $('.custom_drop').addClass("fa fa-caret-up");
                    }
                });
            </script>