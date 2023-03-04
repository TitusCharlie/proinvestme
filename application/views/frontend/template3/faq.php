<section class="content-title-block clearfix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 offset-lg-0 mt-5 pt-5 mb-5">
                <div class="who-we-contant">
                    <div class="fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head"><a href="<?=base_url()?>">Home</a> <span class="breadcrumb-arrow-right"></span> FAQs</span>
                    </div>
                    <br>
                    <h4 class="fadeInUp" data-wow-delay="0.3s">Frequently Asked Questions</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ##### FAQ & Timeline Area Start ##### -->
<div class="faq-timeline-area section-padding-100-85" id="faq">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="dream-faq-area mt-s ">
                        <div class="row">
                            <dl class="col-lg-12 mb-0">
                                <!-- Single FAQ Area -->
                                <?php foreach($faqs as $faq) {?>
                                <dt class="v2 wave fadeInUp" data-wow-delay="0.2s"><?php echo $faq->question ?>
                                </dt>
                                <dd class="fadeInUp" data-wow-delay="0.3s">
                                    <p><?php echo $faq->answer ?></p>
                                </dd>
                                <?php }?>
                            </dl>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ##### FAQ & Timeline Area End ##### -->
