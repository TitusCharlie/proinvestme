<section class="content-title-block clearfix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 offset-lg-0">
                <div class="who-we-contant">
                    <div class="fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head"><a href="<?=base_url()?>">Home</a> <span class="breadcrumb-arrow-right"></span> Privacy</span>
                    </div>
                    <br>
                    <h4 class="fadeInUp" data-wow-delay="0.3s">Contact Us</h4>
                </div>
            </div>

            <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <img src="<?php echo base_url('assets/dist/img/terms-of-service.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-area section-padding-100-70 clearfix footer-area-bg" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <div class="justify-content-center fadeInUp" data-wow-delay="0.2s">
                        <span class="round-head">Get in touch with us</span>
                    </div>
                    <br>
                    <h2 class="fadeInUp" data-wow-delay="0.3s">Contact Us</h2>
                    <p class="fadeInUp" data-wow-delay="0.4s">Have, any questions? Contact Us below.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <img src="<?=base_url("assets/dist/img/bg-image-2.svg")?>" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-5 offset-lg-1">
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
                    <?php if($companyInfo['google_recaptcha'] != 0) {?>
                        <?php if($companyInfo['recaptcha_version'] == 'v2') {?>
                            <input type="hidden" name="g-recaptcha-response">
                            <div class="g-recaptcha" style="margin-bottom: 15px;" data-sitekey="<?php echo $recaptchaInfo->public_key; ?>"></div>
                        <?php } else if($companyInfo['recaptcha_version'] == 'v3') {?>
                            <input type="hidden" class="g-recaptcha" name="recaptcha_response" id="recaptchaResponse">
                        <?php }?>
                    <?php }?>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary-main-pt2 text-uppercase w-100">Send
                            message</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</section>
<!-- /.End of sidebar nav -->
