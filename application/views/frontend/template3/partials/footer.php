<?php if($isDemo == true){?>
<!-- ##### Toggle Themes Demo #### -->
<div class="customizer-toggle">
    <a href="javascript:void" class="">
        <i class="fa fa-wrench"></i>
    </a>
</div>
<aside class="customizer drawer position-right">
    <div class="customizer__inner">
        <div class="customizer__header">
            <div class="customizer__title">
                <h3 class="mb-0">Select Template</h3>
            </div>
            <button type="button" class="close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div perfectscrollbar="" class="customizer__body ps ps--active-y">
            <div class="customizer__body-inner">
                <section>
                    <ul class="list dt-list-sm">
                        <li class="list__item ng-star-inserted">
                            <div class="choose-option">
                                <a class="choose-option__icon" data-url="<?=base_url('switchtemplate/1')?>" href="javascript:void">
                                    <img alt="Light" src="<?=base_url('assets/dist/img/classic_template.png')?>">
                                </a>
                                <p class="choose-option__name">Classic Template</p>
                            </div>
                        </li>
                        <li class="list__item ng-star-inserted">
                            <div class="choose-option active">
                                <a class="choose-option__icon" data-id="<?=base_url('switchtemplate/2')?>" href="javascript:void">
                                    <img alt="Semi Dark" src="<?=base_url('assets/dist/img/modern_template.png')?>">
                                </a>
                                <p class="choose-option__name">Modern Template</p>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</aside>
<?php }?>
<!-- ##### Footer Area Start ##### -->
<footer class="footer-area bg-img mr-n35">

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
                            <p><?php echo $this->web_model->getTemplateContent('footer', $template)->value; ?></p>
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
                            <a href="<?php echo base_url().'cookies' ?>">
                                <p>Cookies Policy</p>
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
<script src="<?php echo base_url(); ?>assets/dist/js/lang.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/calculator.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/contact.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/masonry.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/customizer.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/chartist.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/script.js"></script>
<?php if($this->chatPluginActive == 1) {?>
    <?php if($this->chatPlugin == 'Tawk') {?>
        <?php $segments = explode('/', trim(parse_url($this->tawkpropertyid, PHP_URL_PATH), '/'));?>
        <p class="hidden" id="tawk" data-value="<?php echo 'https://embed.tawk.to/'.$segments[1].'/'.$segments[2] ?>">
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var ppid = $('#tawk').attr('data-value');   
            var Tawkurl = ppid;
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src=Tawkurl;
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    <?php }?>
<?php }?>
</body>
</html>

    