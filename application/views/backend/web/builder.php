<?php $template = $this->uri->segment('3') ?>
<html lang="en" class="js-focus-visible"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?php echo $this->favicon ?>">
    <title><?php echo $pageTitle ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="./css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/animate.min.css') ?>">
    <link href="<?php echo base_url('assets/dist/template_builder/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dist/template_builder/css/alertify.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/codemirror.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/monokai.css') ?>">
    <link href="<?php echo base_url('assets/dist/template_builder/css/builder.css') ?>" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/all.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/remodal.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/template_builder/css/remodal-default-theme.css') ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css">

    <!-- JS-->
    <script src="<?php echo base_url('assets/dist/template_builder/js/tinymce.min.js') ?>"></script>

</head>
<body spellcheck="false" class="" style="">
    <div class="Box" style="display:none">
        Loading 
        <span></span>
    </div>
    <div class="top-header" style="z-index:99999999;">
        <div class="top-logo">
            <a href="" class="logo">
                <img src="<?php echo $this->security->xss_clean($this->logoWhite); ?>" width="160" alt="proinvest">
            </a>
        </div>
        <div class="main nosidebar">
            <div class="header-mid">
                <div class="undo-redo" style="display:inline-block; vertical-align:top;">
                    <button class="reset-btn" id="defaulttmp" data-url="<?=base_url('webcontrol/change-default-template')?>">Make Default Template</button>
                    <button class="reset-btn" id="save" style="margin-left:10px!important;" data-url="<?php echo base_url('webcontrol/builder/save') ?>">Save Template </button>           					
                </div>
            </div>
        </div>

        <div class="right-header">
            <ul class="dropdown top-nav">
                <button class="reset-btn" id="lastpage" data-url="<?php echo base_url('webcontrol/templates/builder') ?>">Back to Templates</button>
            </ul>
        </div>

    </div>

    <div class="subNavigation tabLeft" id="backgroundTab">
        <ul>
            <iframe src="" height="100" width="100" frameborder="0" name="uploadFrame"></iframe>
        </ul>
    </div>

    
    <div class="left-sidebar">
        <ul class="left-nav">
            <!--
            <li class="tab-open"><a href="#"><img src="<?php echo base_url('assets/dist/template_builder/img/module.png') ?>" alt=""><br>Pages</a></li>
            <li class="desktopPreview"><a href="#"><img src="<?php echo base_url('assets/dist/template_builder/img/mobile.png') ?>" alt=""><br>Preview</a></li>
            -->
            <li><a href="#" id="saveTemplate" data-url="<?php echo base_url('webcontrol/builder/save') ?>"><img src="<?php echo base_url('assets/dist/template_builder/img/save.png') ?>" data-url="<?php echo base_url('webcontrol/builder/save') ?>" ><br/>Save</a></li>      
        </ul>
    </div>

    <div class="main nosidebar templatefieldbox">

        <div class="sidebar-close" style="position: fixed; z-index: 99999; display: none;"> X</div>

        <div class="viewPort" style="height: 596px;">
            <div id="template_panel">

                <div id="the_template" class="connectedSortable ui-sortable"><span id="html_bg_color" class="hidden" data-color="#ffffff"></span>
    <?php if($this->uri->segment(3) == 1) {?>
        <!--DOCTYPE><!--loose>
    <!--html>
    <head> 
    <title>Webber Email Template<title-->
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="description" content="Proinvest in as investment company that aggregates funds for investment in bitcoin and forex trading.                                                                                                                                                                                                                                                                                          ">
        <meta name="keywords" content="proinvest, bitcoin trading, forex, investment, trading                                                                                                                                                                                                                                                                                                                          ">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>TrustdeAppsmart Contract Fund</title>
        <!-- Bootstrap CSS -->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/template_builder/template1/css/home.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/template_builder/template1/css/responsive.css">
    <!--[if gte mso 9]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    
    <style type="text/css">
    /*bodyfont*/[style*="Open Sans"]{font-family: 'Open Sans', Arial, sans-serif !important}

    div, p, a, li, td { -webkit-text-size-adjust:none; }

    *{-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
    td{word-break: break-word;}
    a{word-break: break-word; text-decoration: none; color: inherit;}

    #the_template .ReadMsgBody
    {width: 100%; background-color: #ffffff;}
    #the_template .ExternalClass
    {width: 100%; background-color: #ffffff;}
    #the_template{width: 100%; height: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
    .htmltag{width: 100%;} 
    td[class].montserrat {font-family: 'Montserrat', Arial, sans-serif !important;}
    span[class].montserrat {font-family: 'Montserrat', Arial, sans-serif !important;}
    div, p, a, li, td { -webkit-text-size-adjust:none; }
    *{-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
    td{word-break: break-word;}
    a{word-break: break-word; text-decoration: none; color: inherit;}
    #the_template .ReadMsgBody
    {width: 100%; background-color: #282828;}
    #the_template .ExternalClass
    {width: 100%; background-color: #282828;}
    #the_template  {width: 100%; height: 100%; background-color: #282828; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
    #the_template html{ background-color:#282828; width: 100%;}
    #the_template  p {padding: 0!important; margin-top: 0!important; margin-right: 0!important; margin-bottom: 0!important; margin-left: 0!important; }
    #the_template  .hover:hover {opacity:0.85;filter:alpha(opacity=85);}
    #the_template .img10 img {width: 10px!important; height: auto;}
    #the_template .img11 img {width: 11px!important; height: auto;}
    #the_template .img16 img {width: 16px!important; height: auto;}
    #the_template .img17 img {width: 17px!important; height: auto;}
    #the_template .img19 img {width: 19px!important; height: auto;}
    #the_template .img21 img {width: 21px!important; height: auto;}
    #the_template .img34 img {width: 34px!important; height: auto;}
    #the_template .img46 img {width: 46px!important; height: auto;}
    #the_template .img47 img {width: 47px!important; height: auto;}
    #the_template .img52 img {width: 52px!important; height: auto;}
    #the_template .img68 img {width: 68px!important; height: auto;}
    #the_template .img74 img {width: 74px!important; height: auto;}
    #the_template .img81 img {width: 81px!important; height: auto;}
    #the_template .img86 img {width: 86px!important; height: auto;}
    #the_template .img101 img {width: 101px!important; height: auto;}
    #the_template .img111 img {width: 111px!important; height: auto;}
    #the_template .img130 img {width: 130px!important; height: auto;}
    #the_template .img134 img {width: 134px!important; height: auto;}
    #the_template .img152 img {width: 152px!important; height: auto;}
    #the_template .img214 img {width: 214px!important; height: auto;}
    #the_template .img400 img {width: 400px!important; height: auto;}
    </style>

    <!--{@mobile-640px} --><style type="text/css">
        #the_template.tablet body{width:auto!important;}
        #the_template.tablet table[class=full] {width: 100%!important; clear: both; }
        #the_template.tablet table[class=mobile] {width: 100%!important; padding-left: 30px; padding-right: 30px; clear: both; }
        #the_template.tablet table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        #the_template.tablet td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        #the_template.tablet .fullLeft {width: 100%!important; text-align: left!important; clear: both;}
        #the_template.tablet .fullCenter {width: 100%!important; text-align: center!important; clear: both;}
        #the_template.tablet .full {width: 100%!important; clear: both; }
        #the_template.tablet .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
        #the_template.tablet .erase {display: none;}
        #the_template.tablet .pad20 {padding-left: 20px!important; padding-right: 20px!important; clear: both; }
        #the_template.tablet .pad10 {padding-left: 10px!important; padding-right: 10px!important; clear: both; }
        #the_template.tablet td[class=pad20] {padding-left: 20px!important; padding-right: 20px!important; text-align: center!important; clear: both; }
        #the_template.tablet .imgFullMob img {width: 100%!important;}
        #the_template.tablet .h0 {height: 0px!important;}
        #the_template.tablet .h1 {height: 1px!important;}
        #the_template.tablet .h5 {height: 5px!important;}
        #the_template.tablet .h10 {height: 10px!important;}
        #the_template.tablet .h15 {height: 15px!important;}
        #the_template.tablet .h20 {height: 20px!important;}
        #the_template.tablet .textAli{text-align: center!important;}
        }
    </style><!--{@endmobile-640px}-->

    <!--{@mobile-479px} --><style type="text/css"> 
        #the_template.mobile body{width:auto!important;}
        #the_template.mobile table[class=full] {width: 100%!important; clear: both; }
        #the_template.mobile table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both; }
        #the_template.mobile table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        #the_template.mobile td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        #the_template.mobile .fullLeft {width: 100%!important; text-align: left!important; clear: both;}
        #the_template.mobile .fullCenter {width: 100%!important; text-align: center!important; clear: both;}
        #the_template.mobile .full {width: 100%!important; clear: both; }
        #the_template.mobile .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
        #the_template.mobile .erase {display: none;}
        #the_template.mobile .eraseMob {display: none;}
        #the_template.mobile .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
        #the_template.mobile td[class=pad20] {padding-left: 20px!important; padding-right: 20px!important; text-align: center!important; clear: both; }
        #the_template.mobile .pad20 {padding-left: 20px!important; padding-right: 20px!important; clear: both; }	
        #the_template.mobile .pad10 {padding-left: 10px!important; padding-right: 10px!important; clear: both; }
        #the_template.mobile .img80Mob img {width: 80%!important;}
        #the_template.mobile .imgFullMob img {width: 100%!important;}
        #the_template.mobile .h0 {height: 0px!important;}
        #the_template.mobile .h1 {height: 1px!important;}
        #the_template.mobile .h5 {height: 5px!important;}
        #the_template.mobile .h15 {height: 15px!important;}
        #the_template.mobile .h20 {height: 20px!important;}
        #the_template.mobile .f10{font-size: 10px!important; line-height: 16px!important;}
        #the_template.mobile .textAli{text-align: center!important;}
        }
    </style><!--{@endmobile-479px}-->

    <!--/head>
    </body-->
    <body class="light-version js-focus-visible"><style></style>
    <!-- Preloader -->
    <!-- ##### Header Area Start ##### -->
    <header class="header-area fadeInDown" data-wow-delay="0.2s">
        <div class="classy-nav-container light breakpoint-off dark left">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar light justify-content-between" id="dreamNav">

                    <!-- Logo -->
                    <a class="nav-brand light" href="#">
                        <img id="dark-logo" class="logo-img logo-small hidden" src="<?php echo $this->security->xss_clean($this->logoDark); ?>" alt="logo">
                        <img id="white-logo" class="logo-img logo-small" src="<?php echo $this->security->xss_clean($this->logoDark); ?>" alt="logo">
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler demo">
                        <span class="navbarToggler"></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu menu-on">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul id="nav">
                                <li class="active"><a href="#">Get started</a></li>
                                <li class=""><a href="#">About Us</a></li>
                                <li class=""><a href="#">Plans</a></li>
                                <li class=""><a href="#">FAQ</a></li>
                                <li class=""><a href="#">Contact Us</a></li>
                            </ul>

                            <!-- Button -->
                            <a href="#" class="btn more-btn btn-info blue-grad lh-40p p-0-35p">Login</a>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
    

    <!-- ##### Welcome Area Start ##### -->
    <section class="hero-section blue-bg relative section-padding" id="home">

        <div class="hero-section-content">

            <div class="container h-100">
                <div class="row h-100 mb-50 align-items-center">

                    <!-- Welcome Content -->
                    <div class="col-12 col-lg-6 col-md-12">
                        <div class="welcome-content">
                            <div class="promo-section">
                                <h3 class="bEditable mce-content-body special-head gradient-text cyan mce" id="mce_0" data-key="header_sub_title" contenteditable="true">
                                <?php echo $this->web_model->getTemplateContent('header_sub_title', $template)->value; ?></h3>
                            </div>
                            <h1 class="bEditable mce-content-body w-text wow fadeInUp main-pg-txt a-delay-2 mce" data-wow-delay="0.2s" id="mce_1" data-key="header_title" contenteditable="true">
                                <?php echo $this->web_model->getTemplateContent('header_title', $template)->value; ?> </h1>
                            <p class="g-text wow fadeInUp main-pg-txt a-delay-3 mce" data-wow-delay="0.3s" id="mce_2" data-key="header_description" contenteditable="true">
                            <?php echo $this->web_model->getTemplateContent('header_description', $template)->value; ?></p>
                            <div class="dream-btn-group wow fadeInUp main-pg-txt a-delay-4" data-wow-delay="0.4s">
                                <a href="" class="btn more-btn btn-primary pink mr-3" contenteditable="true">Sign Up</a>
                                <a href="" class="btn more-btn btn-info blue-grad" contenteditable="true"> Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="main-ilustration main-ilustration-5"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->


    <div class="clearfix"></div>

    <div class="clearfix"></div>

    <!-- ##### About Us Area Start ##### -->
    <section class="special section-padding-100-70 clearfix" id="about">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                    <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                        <img src="<?php echo base_url() ?>/assets/dist/img/About-us-banner-img.png" alt="">
                    </div>
                </div>

                <div class="col-12 col-lg-6 offset-lg-0">
                    <div class="who-we-contant">
                        <div class="dream-dots text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                            <span class="gradient-text blue mce" id="mce_5" data-key="card_1_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_1_subtitle', $template)->value; ?></span>
                        </div>
                        <h4 class="fadeInUp mce" data-wow-delay="0.3s" id="mce_6" data-key="card_1_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_1_title', $template)->value; ?></h4>
                        <div class="fadeInUp mce" data-wow-delay="0.4s" id="mce_7" data-key="card_1_content" contenteditable="true" style="font-size: 15px;line-height: 1.9;"><?php echo $this->web_model->getTemplateContent('card_1_content', $template)->value; ?></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->

    <section class=" fuel-features features section-padding-100 clearfix" id="plans">

        <div class="container has-shadow">
            <div class="section-heading text-center">
                <!-- Dream Dots -->
                <div class="dream-dots justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                    <span class="gradient-text blue mce" id="mce_8" data-key="card_2_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_subtitle', $template)->value; ?></span>
                </div>
                <h2 class="wow fadeInUp main-pg-txt a-delay-2 mce" data-wow-delay="0.3s" data-key="card_2_title" id="mce_9" contenteditable="true">
                <?php echo $this->web_model->getTemplateContent('card_2_title', $template)->value; ?>
                </h2>
            </div>
            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                    <div class="services-block-four v2 txt-center">
                            <h3><a href="#">Gold</a></h3>
                            <h2 class="black">2.0% Daily</h2>
                            <h5>USD 10.00 - USD 500.00</h5>
                        <a href="#" class="icon_foot">
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                    <div class="services-block-four v2 txt-center">
                            <h3><a href="#">Silver</a></h3>
                            <h2 class="black">25.0% Monthly</h2>
                            <h5>USD 30.00 - USD 99.00</h5>
                        <a href="#" class="icon_foot">
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                    <div class="services-block-four v2 txt-center">
                            <h3><a href="#">Bronze</a></h3>
                            <h2 class="black">2.0% Weekly</h2>
                            <h5>USD 50.00 - USD 1,000.00</h5>
                        <a href="#" class="icon_foot">
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                </div>
                            </div>

        </div>
    </section>
    <section class="special section-padding-100-70 clearfix" id="about">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 offset-lg-0">
                    <div class="who-we-contant">
                        <div class="dream-dots text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                            <span class="gradient-text blue mce" id="mce_10" data-key="card_3_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_3_subtitle', $template)->value; ?></span>
                        </div>
                        <h4 class="fadeInUp mce" data-wow-delay="0.3s" id="mce_11" data-key="card_3_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_3_title', $template)->value; ?></h4>
                        <div class="fadeInUp mce" data-wow-delay="0.4s" id="mce_12" data-key="card_3_content" contenteditable="true" style="font-size: 15px;line-height: 1.9;"><?php echo $this->web_model->getTemplateContent('card_3_content', $template)->value; ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                    <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                        <img src="<?php echo base_url() ?>/assets/dist/img/affiliate-program.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ##### Footer Area Start ##### -->
<footer class="footer-area bg-img">

    <!-- ##### team Area Start ##### -->
    <div class="striples-bg">
        <!-- ##### Team Area Start ##### -->
        <section class="our_team_area section-padding-100-70 clearfix" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-center">
                            <!-- Dream Dots -->
                            <div class="dream-dots justify-content-center fadeInUp" data-wow-delay="0.2s">
                                <span class="mce" id="mce_16" data-key="card_5_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_5_subtitle', $template)->value; ?></span>
                            </div>
                            <h2 class="fadeInUp mce" data-wow-delay="0.3s" id="mce_17" data-key="card_5_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_5_title', $template)->value; ?></h2>
                            <p class="fadeInUp mce" data-wow-delay="0.4s" id="mce_18" data-key="card_5_content" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_5_content', $template)->value; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div id="msg"></div>                                           
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your Name" class="form-control font_color ">
                                            <label class="error" for="name"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Address" class="form-control font_color ">
                                        <label class="error" for="email"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Subject" class="form-control font_color ">
                                <label class="error" for="subject"></label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control font_color " name="comment" placeholder="Your Comment..." rows="5"></textarea>
                                <label class="error" for="comment"></label>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn more-btn blue-grad w-100">Send
                                    message</button>
                            </div>
                   </div>
                    ` <div class="col-3"></div>
                </div>
            </div>
        </section>
        <!-- ##### Team Area End ##### -->

        <div class="footer-content-area mt-0">
            <div class="container">
                <div class="row ">
                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="footer-copywrite-info">
                            <!-- Copywrite -->
                            <div class="copywrite_text fadeInUp" data-wow-delay="0.2s">
                                <div class="footer-logo">
                                    <a href="#"><img class="logo-img" src="<?php echo $this->security->xss_clean($this->logoWhite) ?>" alt="logo"></a>
                                </div>
                                <p class="mce" id="mce_19" data-key="footer" contenteditable="true"><?php echo $this->web_model->getTemplateContent('footer', $template)->value; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="contact_info_area d-sm-flex justify-content-between">
                            <!-- Content Info -->
                            <div class="contact_info mt-x text-center fadeInUp" data-wow-delay="0.3s" style="color:white">
                                <h5>PRIVACY &amp; T&amp;Cs</h5>
                                <a href="#">
                                    <p>Privacy Policy</p>
                                </a>
                                <a href="#">
                                    <p>T&amp;C's</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-md-6 ">
                        <div class="contact_info_area d-sm-flex justify-content-between" style="color:white">
                            <!-- Content Info -->
                            <div class="contact_info mt-s text-center fadeInUp" data-wow-delay="0.4s">
                                <h5>CONTACT US</h5>
                                <p><?php echo $companyInfo['name'] ?></p>
                                <p><?php echo $companyInfo['address'] ?> </p>
                                <p><?php echo $companyInfo['phone1'] ?></p>
                                <p><?php echo $companyInfo['email'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div></footer>
<!-- ##### Footer Area End ##### -->
<div class="card user-bg-card position-absolute bg-primary" style="display: none;"></div>

</body>
<!-- End this is an Android Fix, do not delete it -->
<!--/body>
</html--></div>
            </div>

            <div class="storage">
                <div class="background_editor" id="collapseExample" style="opacity:0;">
                    <div class="hover-wrapper">
                        <div class="editor-bg bg-edit">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-left colorPickerBox">
                                        <p>Background Colors</p>
                                    </div>
                                    <div class="col-right">
                                        <p>Background Image</p>
                                        <div class="row">
                                            <div class="col-xs-7"><input type="text" class="form-control  url update_bg_color" placeholder="Enter valid URL Link ..." onclick="updateBG(this, this.text);"></div>
                                            <div class="col-xs-1">
                                                <form action="/assets/uploadImage.php" method="post" enctype="multipart/form-data" target="uploadFrame">
                                                    <input type="file" id="fileToUpload" name="fileToUpload" class="fileToUpload" onchange="populateHiddenInputs(this)">
                                                    <input type="hidden" name="saveCode" value="5f17edc6b7e12">
                                                    <input type="hidden" name="template" value="webber">
                                                    <input type="hidden" name="callBack" id="callback" value="callbackBG" data-texts="&quot;&quot;">
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="button" class="close btn btn-primary" style="background: #fff;color:#000;opacity: 1;">Close</button>
                </div>
            </div>


            <div class="code_editor" style="z-index:99999; display:none;">
                <div class="undo-redo">
                    <textarea class="form-control" name="myTextArea" id="myTextArea" cols="30" rows="10" style="display: none;"></textarea><div class="CodeMirror CodeMirror-wrap cm-s-monokai" style="width: 100%; height: 400px;"><div style="overflow: hidden; position: relative; width: 3px; height: 0px;"><textarea autocorrect="off" autocapitalize="off" spellcheck="false" tabindex="0" style="position: absolute; bottom: -1em; padding: 0px; width: 1000px; height: 1em; outline: none;"></textarea></div><div class="CodeMirror-vscrollbar" tabindex="-1" cm-not-content="true"><div style="min-width: 1px;"></div></div><div class="CodeMirror-hscrollbar" tabindex="-1" cm-not-content="true"><div style="height: 100%; min-height: 1px;"></div></div><div class="CodeMirror-scrollbar-filler" cm-not-content="true"></div><div class="CodeMirror-gutter-filler" cm-not-content="true"></div><div class="CodeMirror-scroll" tabindex="-1"><div class="CodeMirror-sizer" style="margin-left: 0px;"><div style="position: relative;"><div class="CodeMirror-lines" role="presentation"><div role="presentation" style="position: relative; outline: none;"><div class="CodeMirror-measure"><pre><span>xxxxxxxxxx</span></pre><div class="CodeMirror-linenumber CodeMirror-gutter-elt"><div>1</div></div></div><div class="CodeMirror-measure"></div><div style="position: relative; z-index: 1;"></div><div class="CodeMirror-cursors"></div><div class="CodeMirror-code" role="presentation"></div></div></div></div></div><div style="position: absolute; height: 30px; width: 1px;"></div><div class="CodeMirror-gutters" style="left: 0px;"><div class="CodeMirror-gutter CodeMirror-linenumbers" style="width: 1px;"></div></div></div></div>
                    <button class="btn btn-primary" id="save-module">Save</button>
                    <button class="btn btn-primary" id="close-module">Close</button>
                </div>
            </div>
        </div>

    </div>

    <div id="myModal" class="modal fade" role="dialog" style="z-index: 99999999; display: none;" aria-hidden="true">
        <div class="modal-dialog template-preview">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-header">

                    <button class="btn desktopPreview "><i class="fa fa-desktop"></i></button>
                    <button class="btn tabletPreview"><i class="fas fa-tablet-alt"></i></button>
                    <button class="btn mobilePreview"><i class="fas fa-mobile-alt"></i></button>
                </div>
                <div class="modal-body">

                <div id="the_template" class="connectedSortable ui-sortable"><span id="html_bg_color" class="hidden" data-color="#ffffff"></span>
<!--DOCTYPE><!--loose>
<!--html>
<head> 
<title><title-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,800,700,800" rel="stylesheet" type="text/css">
<!--[if gte mso 9]>
<xml>
 <o:OfficeDocumentSettings>
  <o:AllowPNG></o:AllowPNG>
  <o:PixelsPerInch>96</o:PixelsPerInch>
 </o:OfficeDocumentSettings>
</xml>
<![endif]-->
 
<style type="text/css">
/*bodyfont*/[style*="Open Sans"]{font-family: 'Open Sans', Arial, sans-serif !important}

div, p, a, li, td { -webkit-text-size-adjust:none; }

*{-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
td{word-break: break-word;}
a{word-break: break-word; text-decoration: none; color: inherit;}

#the_template .ReadMsgBody
{width: 100%; background-color: #ffffff;}
#the_template .ExternalClass
{width: 100%; background-color: #ffffff;}
#the_template{width: 100%; height: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
.htmltag{width: 100%;} 
td[class].montserrat {font-family: 'Montserrat', Arial, sans-serif !important;}
span[class].montserrat {font-family: 'Montserrat', Arial, sans-serif !important;}
div, p, a, li, td { -webkit-text-size-adjust:none; }
*{-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
td{word-break: break-word;}
a{word-break: break-word; text-decoration: none; color: inherit;}
#the_template .ReadMsgBody
{width: 100%; background-color: #282828;}
#the_template .ExternalClass
{width: 100%; background-color: #282828;}
#the_template  {width: 100%; height: 100%; background-color: #282828; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
#the_template html{ background-color:#282828; width: 100%;}
#the_template  p {padding: 0!important; margin-top: 0!important; margin-right: 0!important; margin-bottom: 0!important; margin-left: 0!important; }
#the_template  .hover:hover {opacity:0.85;filter:alpha(opacity=85);}
#the_template .img10 img {width: 10px!important; height: auto;}
#the_template .img11 img {width: 11px!important; height: auto;}
#the_template .img16 img {width: 16px!important; height: auto;}
#the_template .img17 img {width: 17px!important; height: auto;}
#the_template .img19 img {width: 19px!important; height: auto;}
#the_template .img21 img {width: 21px!important; height: auto;}
#the_template .img34 img {width: 34px!important; height: auto;}
#the_template .img46 img {width: 46px!important; height: auto;}
#the_template .img47 img {width: 47px!important; height: auto;}
#the_template .img52 img {width: 52px!important; height: auto;}
#the_template .img68 img {width: 68px!important; height: auto;}
#the_template .img74 img {width: 74px!important; height: auto;}
#the_template .img81 img {width: 81px!important; height: auto;}
#the_template .img86 img {width: 86px!important; height: auto;}
#the_template .img101 img {width: 101px!important; height: auto;}
#the_template .img111 img {width: 111px!important; height: auto;}
#the_template .img130 img {width: 130px!important; height: auto;}
#the_template .img134 img {width: 134px!important; height: auto;}
#the_template .img152 img {width: 152px!important; height: auto;}
#the_template .img214 img {width: 214px!important; height: auto;}
#the_template .img400 img {width: 400px!important; height: auto;}
</style>

<!--{@mobile-640px} --><style type="text/css">
     #the_template.tablet body{width:auto!important;}
     #the_template.tablet table[class=full] {width: 100%!important; clear: both; }
     #the_template.tablet table[class=mobile] {width: 100%!important; padding-left: 30px; padding-right: 30px; clear: both; }
     #the_template.tablet table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
     #the_template.tablet td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
     #the_template.tablet .fullLeft {width: 100%!important; text-align: left!important; clear: both;}
     #the_template.tablet .fullCenter {width: 100%!important; text-align: center!important; clear: both;}
     #the_template.tablet .full {width: 100%!important; clear: both; }
     #the_template.tablet .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
     #the_template.tablet .erase {display: none;}
     #the_template.tablet .pad20 {padding-left: 20px!important; padding-right: 20px!important; clear: both; }
     #the_template.tablet .pad10 {padding-left: 10px!important; padding-right: 10px!important; clear: both; }
     #the_template.tablet td[class=pad20] {padding-left: 20px!important; padding-right: 20px!important; text-align: center!important; clear: both; }
     #the_template.tablet .imgFullMob img {width: 100%!important;}
     #the_template.tablet .h0 {height: 0px!important;}
     #the_template.tablet .h1 {height: 1px!important;}
     #the_template.tablet .h5 {height: 5px!important;}
     #the_template.tablet .h10 {height: 10px!important;}
     #the_template.tablet .h15 {height: 15px!important;}
     #the_template.tablet .h20 {height: 20px!important;}
     #the_template.tablet .textAli{text-align: center!important;}
     }
</style><!--{@endmobile-640px}-->

<!--{@mobile-479px} --><style type="text/css"> 
     #the_template.mobile body{width:auto!important;}
     #the_template.mobile table[class=full] {width: 100%!important; clear: both; }
     #the_template.mobile table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both; }
     #the_template.mobile table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
     #the_template.mobile td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
     #the_template.mobile .fullLeft {width: 100%!important; text-align: left!important; clear: both;}
     #the_template.mobile .fullCenter {width: 100%!important; text-align: center!important; clear: both;}
     #the_template.mobile .full {width: 100%!important; clear: both; }
     #the_template.mobile .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
     #the_template.mobile .erase {display: none;}
     #the_template.mobile .eraseMob {display: none;}
     #the_template.mobile .buttonScale {float: none!important; text-align: center!important; display: inline-block!important; clear: both;}
     #the_template.mobile td[class=pad20] {padding-left: 20px!important; padding-right: 20px!important; text-align: center!important; clear: both; }
     #the_template.mobile .pad20 {padding-left: 20px!important; padding-right: 20px!important; clear: both; }	
     #the_template.mobile .pad10 {padding-left: 10px!important; padding-right: 10px!important; clear: both; }
     #the_template.mobile .img80Mob img {width: 80%!important;}
     #the_template.mobile .imgFullMob img {width: 100%!important;}
     #the_template.mobile .h0 {height: 0px!important;}
     #the_template.mobile .h1 {height: 1px!important;}
     #the_template.mobile .h5 {height: 5px!important;}
     #the_template.mobile .h15 {height: 15px!important;}
     #the_template.mobile .h20 {height: 20px!important;}
     #the_template.mobile .f10{font-size: 10px!important; line-height: 16px!important;}
     #the_template.mobile .textAli{text-align: center!important;}
     }
</style><!--{@endmobile-479px}-->

<!--/head>
</body-->
   
<!-- End this is an Android Fix, do not delete it -->
<!--/body>
</html--></div>
            </div>
            </div>
        </div>
    </div>
    <div id="csrf" data-name="<?php echo $this->security->get_csrf_token_name() ?>" data-hash="<?php echo $this->security->get_csrf_hash() ?>"></div>
    <div class="mce hide" id="template" data-key="template">1</div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker/dist/acolorpicker.js"></script>
    <?php } else if($this->uri->segment(3) == 2){?>
        <!--DOCTYPE><!--loose>
<!--html>
<head> 
<title>Webber Email Template<title-->
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Proinvest in as investment company that aggregates funds for investment in bitcoin and forex trading.                                                                                                                                                                                                                                                                                          ">
    <meta name="keywords" content="proinvest, bitcoin trading, forex, investment, trading                                                                                                                                                                                                                                                                                                                          ">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ProInvest Fund</title>
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/responsive.css">
    <style>
        h1,h2,h3,h4,h5,h6{
            color: #000;
        }
        .h4, h4 {
            font-size: 1.5rem;
        }
        p {
            color: #888!important;
        }
    </style>
<!--/head>
</body-->
<body class="light-version js-focus-visible"><style></style>
<!-- Preloader -->
<!-- ##### Welcome Area Start ##### -->
<section class="hero-section bg-white relative section-padding bg-pt2" id="home">

<div class="hero-section-content">

    <div class="container h-100">
        <div class="row h-100 mb-50 align-items-center">

            <!-- Welcome Content -->
            <div class="col-12 col-lg-6 col-md-12">
                <div class="welcome-content mt-0 mb-5">
                    <div class="promo-section">
                        <h3 class="round-head mce" id="mce_0" data-key="header_sub_title" contenteditable="true"><?=$this->web_model->getTemplateContent('header_sub_title', $this->uri->segment(3))->value; ?></h3>
                    </div>
                    <h1 class="b-text wow fadeInUp main-pg-txt a-delay-2 mb-0 mce" data-wow-delay="0.3s" id="mce_1" data-key="header_title" contenteditable="true">
                        <?=$this->web_model->getTemplateContent('header_title', $this->uri->segment(3))->value; ?>
                    </h1>
                    <p class="b-text wow fadeInUp main-pg-txt a-delay-3 p-grey mce" data-wow-delay="0.3s" id="mce_2" data-key="header_description" contenteditable="true">
                    <?=$this->web_model->getTemplateContent('header_description', $this->uri->segment(3))->value; ?>
                    </p>
                    <div class="dream-btn-group wow fadeInUp main-pg-txt a-delay-4" data-wow-delay="0.4s">
                        <a href="javascript:void" class="btn btn-primary-main-pt2 text-uppercase mr-3"><?=lang("create_account") ?></a>
                        <a href="javascript:void" class="btn btn-info-main-pt2 text-uppercase"><?=lang("login") ?></a>
                    </div>
                </div>
                <img width="192" height="235" src="<?=base_url('assets/dist/img/img1.png')?>" class="hanging-1" alt="" loading="lazy" title="Digital">
                    <img width="192" height="235" src="<?=base_url('assets/dist/img/img2.png')?>" class="hanging-2" alt="" loading="lazy" title="Digital">
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="main-ilustration main-ilustration-4">
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- ##### Calculator ##### -->
<section class="calculator-block clearfix" id="about">

    <div class="container">
        <div class="row align-items-center m-4">
            <div class="col-12 col-lg-4 offset-lg-0 mt-4 mb-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input class="form-control" name="amount" placeholder="Investment Amount e.g $100"></input>
                </div>
            </div>

            <div class="col-12 col-lg-4 offset-lg-0 col-md-12 no-padding-left">
                <div class="form-group">
                    <label>Investment plan</label>
                    <select class="form-control" name="plan" style="height: 35px;">
                        <option selected disabled hidden>Select Plan</option>
                        <option>Plan A</option>
                        <option>Plan B</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-4 offset-lg-0 col-md-12 no-padding-left">
                <button type="submit" class="btn btn-primary-main-pt2 text-uppercase">Calculate Earnings</button>
            </div>
        </div>
    </div>
</section>
<!-- ##### Calculator End ##### -->
<section class="special section-padding-100-70 clearfix" id="about">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 offset-lg-0">
                <div class="who-we-contant">
                    <div class="text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head mce" id="mce_3" data-key="card_1_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_1_subtitle', $this->uri->segment(3))->value; ?></span>
                    </div>
                    <br>
                    <h4 class="fadeInUp mce" data-wow-delay="0.3s" id="mce_4" data-key="card_1_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_1_title', $this->uri->segment(3))->value; ?></h4>
                </div>
            </div>

            <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <p class="fadeInUp mce" data-wow-delay="0.4s" id="mce_5" data-key="card_1_content" contenteditable="true">
                    <?php echo $this->web_model->getTemplateContent('card_1_content', $this->uri->segment(3))->value; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="intro-features clearfix">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head mce" id="mce_6" data-key="card_2_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_subtitle', $this->uri->segment(3))->value; ?></span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2 mce" data-key="card_2_title" data-wow-delay="0.3s" id="mce_7" contenteditable="true">
            <?php echo $this->web_model->getTemplateContent('card_2_title', $this->uri->segment(3))->value; ?>
            </h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>01</h1>
                        <h4 class="black mce" id="mce_8" data-key="card_2_content_1_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_1_title', $this->uri->segment(3))->value; ?></h4>
                        <p class="mce" id="mce_9" data-key="card_2_content_1_info" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_1_info', $this->uri->segment(3))->value; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>02</h1>
                        <h4 class="black mce" id="mce_10" data-key="card_2_content_2_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_2_title', $this->uri->segment(3))->value; ?></h4>
                        <p class="mce" id="mce_11" data-key="card_2_content_2_info" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_2_info', $this->uri->segment(3))->value; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>03</h1>
                        <h4 class="black mce" id="mce_12" data-key="card_2_content_3_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_3_title', $this->uri->segment(3))->value; ?></h4>
                        <p class="mce" id="mce_13" data-key="card_2_content_3_info" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_2_content_3_info', $this->uri->segment(3))->value; ?></p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ##### Welcome Area End ##### -->
<div class="clearfix"></div>

<!-- ##### About Us Area Start ##### -->
<section class="about-block section-padding-100-70 clearfix" id="about">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                <div class="about-block-main-img welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <img src="<?=base_url('assets/dist/img/team-group.png')?>" alt="">
                </div>
            </div>

            <div class="col-12 col-lg-5 offset-lg-1">
                <div class="who-we-contant">
                    <div class="text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head mce" id="mce_14" data-key="card_3_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_3_subtitle', $this->uri->segment(3))->value; ?></span>
                    </div>
                    <br>
                    <h4 class="fadeInUp text-capitalize mce" data-wow-delay="0.3s" id="mce_15" data-key="card_3_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_3_title', $this->uri->segment(3))->value; ?></h4>
                    <p class="fadeInUp mce" data-wow-delay="0.4s" id="mce_16" data-key="card_3_content" contenteditable="true">
                    <?php echo $this->web_model->getTemplateContent('card_3_content', $this->uri->segment(3))->value; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### About Us Area End ##### -->
<!-- ##### About Us Area Start ##### -->
<section class="about-block section-padding-100-70 clearfix" id="about">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <div class="who-we-contant">
                    <div class="text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head mce" id="mce_17" data-key="card_4_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_4_subtitle', $this->uri->segment(3))->value; ?></span>
                    </div>
                    <br>
                    <h4 class="fadeInUp text-capitalize mce" data-wow-delay="0.3s" id="mce_18" data-key="card_4_title" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_4_title', $this->uri->segment(3))->value; ?></h4>
                    <p class="fadeInUp mce" data-wow-delay="0.4s" id="mce_19" data-key="card_4_content" contenteditable="true">
                    <?php echo $this->web_model->getTemplateContent('card_4_content', $this->uri->segment(3))->value; ?>
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-12 no-padding-left">
                <div class="about-block-main-img welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <img src="<?=base_url('assets/dist/img/about-agency.jpeg')?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="plan-features clearfix" id="plans">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head mce" id="mce_20" data-key="card_5_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_5_subtitle', $this->uri->segment(3))->value; ?></span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2 mce" data-wow-delay="0.3s" id="mce_21" data-key="card_5_title" contenteditable="true">
            <?php echo $this->web_model->getTemplateContent('card_5_title', $this->uri->segment(3))->value; ?>
            </h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="plan-block v2 txt-center">
                    <h1 class="text-uppercase">Gold Plan</h1>
                    <div class="plan-percent">
                        <h1>3%</h1>
                        <p>profit <br>/mo</p>
                    </div>
                    <div class="plan-content">
                        <p class="title">For</p>
                        <p class="body">1 Month</p>
                    </div>
                    <div class="plan-content1">
                        <p class="title-2">Invest</p>
                        <p class="amount-range">USD 10 - USD 500</p>
                    </div>
                    <a href="javascript:void" class="btn btn-primary-main-pt2 text-uppercase">Invest</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="plan-block v2 txt-center">
                    <h1 class="text-uppercase">Silver Plan</h1>
                    <div class="plan-percent">
                        <h1>5%</h1>
                        <p>profit <br>/mo</p>
                    </div>
                    <div class="plan-content">
                        <p class="title">For</p>
                        <p class="body">3 Months</p>
                    </div>
                    <div class="plan-content1">
                        <p class="title-2">Invest</p>
                        <p class="amount-range">USD 30 - USD 99</p>
                    </div>
                    <a href="javascript:void" class="btn btn-primary-main-pt2 text-uppercase">Invest</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="plan-block v2 txt-center">
                    <h1 class="text-uppercase">Bronze Plan</h1>
                    <div class="plan-percent">
                        <h1>8%</h1>
                        <p>profit <br>/mo</p>
                    </div>
                    <div class="plan-content">
                        <p class="title">For</p>
                        <p class="body">6 Months</p>
                    </div>
                    <div class="plan-content1">
                        <p class="title-2">Invest</p>
                        <p class="amount-range">USD 50 - USD 1000</p>
                    </div>
                    <a href="javascript:void" class="btn btn-primary-main-pt2 text-uppercase">Invest</a>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ##### About Us Area End ##### -->
<section class="call-to-action clearfix mt-5" id="plans">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head mce" id="mce_22" data-key="card_6_subtitle" contenteditable="true"><?php echo $this->web_model->getTemplateContent('card_6_subtitle', $this->uri->segment(3))->value; ?></span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2 mce" data-wow-delay="0.3s" id="mce_23" data-key="card_6_title" contenteditable="true">
            <?php echo $this->web_model->getTemplateContent('card_6_title', $this->uri->segment(3))->value; ?>
            </h2>
            <a href="javascript:void" class="btn btn-primary-main-pt2 text-uppercase"><?php echo lang("create_account") ?></a>
        </div>
    </div>
</section>
<footer class="footer-area bg-img">

<!-- ##### team Area Start ##### -->
<div class="striples-bg">

    <div class="footer-content-area mt-0 footer-content-bg">
        <div class="container">
            <div class="row ">
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="footer-copywrite-info">
                        <!-- Copywrite -->
                        <div class="copywrite_text fadeInUp" data-wow-delay="0.2s">
                            <div class="footer-logo">
                                <a href="#"><img src="<?php echo $this->security->xss_clean($this->logoDark) ?>"
                                        alt="logo"></a>
                            </div>
                            <p class="mce" id="mce_24" data-key="footer" contenteditable="true"><?php echo $this->web_model->getTemplateContent('footer', $this->uri->segment(3))->value; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-6">
                    <div class="contact_info_area d-sm-flex justify-content-between">
                        <!-- Content Info -->
                        <div class="contact_info mt-x text-center fadeInUp" data-wow-delay="0.3s">
                            <h5 class="b-text">PRIVACY &amp; T&Cs</h5>
                            <a href="<?php echo base_url().'privacy' ?>">
                                <p>Privacy Policy</p>
                            </a>
                            <a href="<?php echo base_url().'terms' ?>">
                                <p>T&C's</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-6 ">
                    <div class="contact_info_area d-sm-flex justify-content-between">
                        <!-- Content Info -->
                        <div class="contact_info mt-s text-center fadeInUp" data-wow-delay="0.4s">
                            <h5 class="b-text">CONTACT US</h5>
                            <p><?php echo $this->security->xss_clean($companyInfo['name']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['address']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['phone1']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['email']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                    <div class="contact_info_area d-sm-flex justify-content-between">
                        <div class="contact_info mt-s text-center fadeInUp" data-wow-delay="0.4s">
                            <h5 class="b-text">SUPPORTED PAYMENTS</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center supported-payments">
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-image" src="<?=base_url('assets/dist/img/coinpayments.png')?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-image" src="<?=base_url('assets/dist/img/Perfect_Money.png')?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-image" src="<?=base_url('assets/dist/img/paystack.png')?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-cbp-image" src="<?=base_url('assets/dist/img/coinbase.png')?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-image" src="<?=base_url('assets/dist/img/paypal.png')?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mt-md-30">
                            <img class="payment-cbp-image" src="<?=base_url('assets/dist/img/payeer.png')?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- ##### Footer Area End ##### -->
<div id="csrf" data-name="<?php echo $this->security->get_csrf_token_name() ?>" data-hash="<?php echo $this->security->get_csrf_hash() ?>"></div>
<div class="mce hide" id="template" data-key="template">2</div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker/dist/acolorpicker.js"></script>
</body>
</html>
    </div>
<?php }?>
<script>
    $('#saveTemplate, #save').on('click', function(e){
        e.preventDefault();
        $('.templatefieldbox').hide();
        $('.Box').show();

        var csrf = $('#csrf').attr('data-hash');
        var array = {};
        var inputs = $('.mce').html();

        $('.mce').each(function(){
            array[$(this).attr('data-key')] = $(this).html()
        });
        
        var actionurl = $(this).attr('data-url');

        $.ajax({
            url: actionurl,
            type: "POST",
            data: array, 
            cache: false,
            success: function(data){
                var content = JSON.parse(data);
                $('#csrf').attr('data-hash', content.csrfHash);
                setTimeout(
                function() 
                {
                    $('.templatefieldbox').show();
                    $('.Box').hide();
                }, 5000);
            },
            error: function(data) {}
        });
    })
    $('#lastpage').on('click', function(e){
        var url = $(this).attr('data-url');
        window.location.replace(url);
    })
    $('#defaulttmp').on('click', function(e){
        e.preventDefault();
        $('.templatefieldbox').hide();
        $('.Box').show();

        var template = $('#template').html();
        var actionurl = $(this).attr('data-url') + '/' + template;

        $.get(actionurl, function(data){
            var content = JSON.parse(data);
            setTimeout(
                function() 
                {
                    $('.templatefieldbox').show();
                    $('.Box').hide();
                }, 5000);
        });
    })
</script>



