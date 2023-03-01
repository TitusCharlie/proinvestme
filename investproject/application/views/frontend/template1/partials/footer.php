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
                                <a class="choose-option__icon" data-url="<?=base_url('switchtemplate/2')?>" href="javascript:void">
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
                            <span><?php echo $this->web_model->getTemplateContent('card_5_subtitle', $template)->value; ?></span>
                        </div>
                        <h2 class="fadeInUp" data-wow-delay="0.3s"><?php echo $this->web_model->getTemplateContent('card_5_title', $template)->value; ?></h2>
                        <p class="fadeInUp" data-wow-delay="0.4s"><?php echo $this->web_model->getTemplateContent('card_5_content', $template)->value; ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                <div id='msg'></div>
                <?php echo validation_errors(); ?>
                    <?php echo form_open( base_url( 'contactus' ), array( 'id' => 'contactForm', 'class' => 'contact_form' ));?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Your Name"
                                        class="form-control font_color <?php echo form_error('name') == TRUE ? 'inputTxtError' : ''; ?>">
                                        <label class="error" for="name"><?php echo form_error('name'); ?></label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email Address"
                                        class="form-control font_color <?php echo form_error('email') == TRUE ? 'inputTxtError' : ''; ?>">
                                    <label class="error" for="email"><?php echo form_error('email'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Subject" class="form-control font_color <?php echo form_error('subject') == TRUE ? 'inputTxtError' : ''; ?>">
                            <label class="error" for="subject"><?php echo form_error('subject'); ?></label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control font_color <?php echo form_error('comment') == TRUE ? 'inputTxtError' : ''; ?>" name="comment" placeholder="Your Comment..."
                                rows="5"></textarea>
                            <label class="error" for="comment"><?php echo form_error('comment'); ?></label>
                        </div>
                        <!-- /form group -->
                        <?php if($companyInfo['google_recaptcha'] != 0) {?>
                            <?php if($companyInfo['recaptcha_version'] == 'v2') {?>
                                <input type="hidden" name="g-recaptcha-response">
                                <div class="g-recaptcha" style="margin-bottom: 15px;" data-sitekey="<?php echo $recaptchaInfo->public_key; ?>"></div>
                            <?php } else if($companyInfo['recaptcha_version'] == 'v3') {?>
                                <input type="hidden" class="g-recaptcha" name="recaptcha_response" id="recaptchaResponse">
                            <?php }?>
                        <?php }?>
                        <div class="form-btn">
                            <button type="submit" class="btn more-btn blue-grad w-100">Send
                                message</button>
                        </div>
                    <?php echo form_close();?>
                </div>
                <div class="col-3"></div>
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
                                <a href="#"><img class="logo-img" src="<?php echo $this->security->xss_clean($this->logoWhite) ?>"
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
                            <h5>PRIVACY &amp; T&Cs</h5>
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
                            <h5>CONTACT US</h5>
                            <p><?php echo $this->security->xss_clean($companyInfo['name']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['address']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['phone1']) ?></p>
                            <p><?php echo $this->security->xss_clean($companyInfo['email']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- ##### Footer Area End ##### -->
<script src="<?php echo base_url(); ?>assets/dist/js/lang.js"></script>
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

    