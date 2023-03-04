
<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $this->security->xss_clean($this->siteDescription) ?>">
    <meta name="keywords" content="<?php echo $this->security->xss_clean($this->siteKeywords) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $pageTitle ?></title>

    <!-- CSS -->
    <link rel="shortcut icon" href="<?php echo $this->favicon ?>"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/responsive.css">

    <script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script>
    <?php if($companyInfo['google_recaptcha'] == '1') {?>
        <?php if($companyInfo['recaptcha_version'] == 'v2') {?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php } else if($companyInfo['recaptcha_version'] == 'v3') {?>
            <script src='https://www.google.com/recaptcha/api.js?render=<?php echo $recaptchaInfo->public_key; ?>'></script>
            <script>
                grecaptcha.ready(function () {
                    grecaptcha.execute('<?php echo $recaptchaInfo->public_key; ?>').then(function (token) {
                        var recaptchaResponse = document.getElementById('recaptchaResponse');
                        recaptchaResponse.value = token;
                    });
                });
            </script>
        <?php }?>
    <?php }?>
</head>
<body class="light-version js-focus-visible">
    <!-- ##### Header Area Start ##### -->
    <header class="header-area fadeInDown" data-wow-delay="0.2s">
        <div class="classy-nav-container breakpoint-off dark left">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="dreamNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="<?php echo base_url() ?>">
                        <img class="logo-img logo-small"
                            src="<?php echo $this->security->xss_clean($this->logoDark); ?>" alt="logo">
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler demo">
                        <span class="navbarToggler" style="margin-left: -3em;"><i class="fa fa-bars" style="font-size:24px;"></i></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu menu-on">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap">
                                <span class="top"></span>
                                <span class="bottom"></span>
                            </div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav classynav-pt2">
                            <ul id="nav" class="mr-4">
                                <li class="active f-500"><a href="<?=base_url('signup') ?>">Get started</a></li>
                                <li class="f-500"><a href="<?=base_url().'#about'?>">About Us</a></li>
                                <li class="f-500"><a href="<?=base_url().'#plans'?>">Plans</a></li>
                                <li class="f-500"><a href="<?=base_url('faqs') ?>">FAQ</a></li>
                                <li class="f-500"><a href="<?=base_url('contact-us') ?>">Contact Us</a></li>
                            </ul>
                            <!--
                            <ul class="dt-nav">
                                <li class="dt-nav__item dropdown">

                                    <a href="#" class="dt-nav__link dropdown-toggle" id="currentLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img style="width:20px;" class="flag-icon flag-icon-rounded flag-icon-lg mr-1m" src="<?php echo base_url('uploads/'.$this->site_lang->logo) ?>">
                                    <span><?php echo $this->site_lang->code ?></span> </a>

                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(8px, 72px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <?php foreach($this->site_languages as $language) {?>
                                        <button class="dropdown-item sitelangChange" type="button" data-id="<?php echo base_url('switchlang/').$language->name ?>">
                                            <img class="flag-icon flag-icon-rounded flag-icon-lg mr-2" style="width: 20px;" src="<?php echo base_url('uploads/').$language->logo ?>">
                                            <span><?php echo $language->name ?></span> 
                                        </button>
                                        <?php }?>
                                    </div>

                                </li>
                            </ul>
                            -->
                            <!-- Button -->
                            <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                                </div>
                            </div>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->