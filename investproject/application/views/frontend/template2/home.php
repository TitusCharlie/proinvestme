<!-- ##### Welcome Area Start ##### -->
<section class="hero-section bg-white relative section-padding bg-pt2 mr-n35" id="home">

<div class="hero-section-content">

    <div class="container h-100">
        <div class="row h-100 mb-50 align-items-center">

            <!-- Welcome Content -->
            <div class="col-12 col-lg-6 col-md-12">
                <div class="welcome-content mt-0 mb-5">
                    <div class="promo-section">
                        <h3 class="round-head"><?=$this->web_model->getTemplateContent('header_sub_title', $template)->value; ?></h3>
                    </div>
                    <h1 class="b-text wow fadeInUp main-pg-txt a-delay-2 mb-0" data-wow-delay="0.3s">
                        <?=$this->web_model->getTemplateContent('header_title', $template)->value; ?>
                    </h1>
                    <p class="b-text wow fadeInUp main-pg-txt a-delay-3 p-grey" data-wow-delay="0.3s">
                    <?=$this->web_model->getTemplateContent('header_description', $template)->value; ?>
                    </p>
                    <div class="dream-btn-group wow fadeInUp main-pg-txt a-delay-4" data-wow-delay="0.4s">
                        <a href="<?= base_url('signup') ?>" class="btn btn-primary-main-pt2 text-uppercase mr-3"><?=lang("create_account") ?></a>
                        <a href="<?= base_url('login') ?>" class="btn btn-info-main-pt2 text-uppercase"><?=lang("login") ?></a>
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
<section class="calculator-block clearfix" id="about">
    <?php echo form_open(base_url('calculator'), array( 'id' => 'calcForm' ));?>
        <div class="container">
            <div class="row align-items-center m-4">
                <div class="col-12 col-lg-4 offset-lg-0 mt-4 mb-4">
                    <div class="form-group">
                        <label>Amount</label>
                        <input class="form-control text-dark" name="amount" placeholder="Investment Amount e.g $200"></input>
                        <small class="error position-absolute text-danger" id="amounterror"></small>
                    </div>
                </div>
                
                <div class="col-12 col-lg-4 offset-lg-0 col-md-12 no-padding-left">
                    <div class="form-group">
                        <label>Earnings plan</label>
                        <select class="form-control" name="plan">
                            <option value="" selected>Select Plan</option>
                            <?php foreach($plans as $plan) { ?>
                            <option value="<?=$plan->id?>"><?=$plan->name.' '.$plan->profit.'% '.$plan->periodName.' for '.$plan->maturity_desc.' min:'.to_currency($plan->minInvestment).' max:'.to_currency($plan->maxInvestment)?></option>
                            <?php } ?>
                        </select>
                        <small id="planerror" class="error position-absolute text-danger"></small>
                    </div>
                </div>
                <div class="col-12 col-lg-4 offset-lg-0 col-md-12 no-padding-left">
                    <button type="submit" class="btn btn-primary-main-pt2 text-uppercase">Calculate Earnings</button>
                </div>
            </div>
        </div>
    </form>
</section>

<!-- The Modal -->
<div id="calcModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4>What you stand to earn</h4>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <table class="paymentcalctable">
                <tbody>
                    <tr>
                        <td>Plan</td>
                        <td id="plan_name">Starter</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td id="amount"> USD 100</td>
                    </tr>
                    <tr>
                        <td>Payout Period</td>
                        <td id="payout_period"> Daily</td>
                    </tr>
                    <tr>
                        <td>Maturity</td>
                        <td id="maturity"> 1 month</td>
                    </tr>
                    <tr>
                        <td>Return</td>
                        <td id="return"> USD 300</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="<?=base_url('signup')?>" class="btn btn-primary-main-pt2 text-uppercase">Signup</a>
            <a href="<?=base_url('login')?>" class="btn btn-primary-main-pt2 text-uppercase">Login</a>
        </div>
    </div>
</div>

<section class="special section-padding-100-70 clearfix mr-n35" id="about">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 offset-lg-0">
                <div class="who-we-contant">
                    <div class="text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head"><?=$this->web_model->getTemplateContent('card_1_subtitle', $template)->value; ?></span>
                    </div>
                    <br>
                    <h4 class="fadeInUp" data-wow-delay="0.3s"><?=$this->web_model->getTemplateContent('card_1_title', $template)->value; ?></h4>
                </div>
            </div>

            <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                <div class="welcome-meter wow fadeInUp mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <p class="fadeInUp" data-wow-delay="0.4s">
                    <?=$this->web_model->getTemplateContent('card_1_content', $template)->value; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="intro-features clearfix mr-n35">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head">
                    <?=$this->web_model->getTemplateContent('card_2_subtitle', $template)->value; ?>
                </span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.3s">
                <?=$this->web_model->getTemplateContent('card_2_title', $template)->value; ?>
            </h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>01</h1>
                        <h4 class="black">
                            <?=$this->web_model->getTemplateContent('card_2_content_1_title', $template)->value; ?>
                        </h4>
                        <p>
                            <?=$this->web_model->getTemplateContent('card_2_content_1_info', $template)->value; ?>
                        </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>02</h1>
                        <h4 class="black">
                            <?=$this->web_model->getTemplateContent('card_2_content_2_title', $template)->value; ?>
                        </h4>
                        <p>
                            <?=$this->web_model->getTemplateContent('card_2_content_2_info', $template)->value; ?>
                        </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="intro-block v2 txt-center">
                        <h1>03</h1>
                        <h4 class="black">
                            <?=$this->web_model->getTemplateContent('card_2_content_3_title', $template)->value; ?>
                        </h4>
                        <p>
                            <?=$this->web_model->getTemplateContent('card_2_content_3_info', $template)->value; ?>
                        </p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ##### Welcome Area End ##### -->
<div class="clearfix"></div>

<!-- ##### About Us Area Start ##### -->
<section class="about-block section-padding-100-70 clearfix mr-n35" id="about">

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
                        <span class="round-head">
                            <?=$this->web_model->getTemplateContent('card_3_subtitle', $template)->value; ?>
                        </span>
                    </div>
                    <br>
                    <h4 class="fadeInUp text-capitalize" data-wow-delay="0.3s">
                        <?=$this->web_model->getTemplateContent('card_3_title', $template)->value; ?>
                    </h4>
                    <p class="fadeInUp" data-wow-delay="0.4s">
                        <?=$this->web_model->getTemplateContent('card_3_content', $template)->value; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### About Us Area End ##### -->
<!-- ##### About Us Area Start ##### -->
<section class="about-block section-padding-100-70 clearfix mr-n35" id="about">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <div class="who-we-contant">
                    <div class="text-left fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                        <span class="round-head">
                            <?=$this->web_model->getTemplateContent('card_4_subtitle', $template)->value; ?>
                        </span>
                    </div>
                    <br>
                    <h4 class="fadeInUp text-capitalize" data-wow-delay="0.3s">
                        <?=$this->web_model->getTemplateContent('card_4_title', $template)->value; ?>
                    </h4>
                    <p class="fadeInUp" data-wow-delay="0.4s">
                        <?=$this->web_model->getTemplateContent('card_4_content', $template)->value; ?>
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-12 no-padding-left">
                <div class="about-block-main-img welcome-meter wow fadeInUp mt-5 mb-30 main-pg-txt a-delay-7" data-wow-delay="0.7s">
                    <img src="<?=base_url('assets/dist/img/about-agency.jpeg')?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="plan-features clearfix mr-n35" id="plans">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head"><?=$this->web_model->getTemplateContent('card_5_subtitle', $template)->value; ?></span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.3s">
                <?=$this->web_model->getTemplateContent('card_5_title', $template)->value; ?>
            </h2>
        </div>

        <div class="row align-items-center">
            <?php foreach ($plans as $plan) { ?>
                <a href="<?= base_url() ?>deposits/new" class="col-lg-4 col-md-6 col-sm-12 mt-md-30 d-inline-block">
                    <!-- <div> -->
                    <div class="plan-block v2 txt-center">
                        <h1 class="text-uppercase"><?php echo $this->security->xss_clean($plan->name) ?></h1>
                        <div class="plan-percent">
                            <h1><?= $this->security->xss_clean($plan->profit) . '% ' ?></h1>
                            <p class="text-capitalize">profit <br><?= $this->security->xss_clean($plan->periodName) ?></p>
                        </div>
                        <div class="plan-content">
                            <p class="title">For</p>
                            <p class="body"><?= $this->security->xss_clean($plan->maturity_desc) ?></p>
                        </div>
                        <div class="plan-content1">
                            <p class="title-2">Invest</p>
                            <p class="amount-range"><?= to_currency($this->security->xss_clean($plan->minInvestment)) . ' - ' . to_currency($this->security->xss_clean($plan->maxInvestment)) ?></p>
                        </div>
                    </div>
                    <!-- </div> -->
                </a>
            <?php } ?>
            
        <!------<div class="row align-items-center">
            <?php foreach($plans as $plan) {?>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-30">
                <div class="plan-block v2 txt-center">
                    <h1 class="text-uppercase"><?php echo $this->security->xss_clean($plan->name) ?></h1>
                    <div class="plan-percent">
                        <h1><?=$this->security->xss_clean($plan->profit).'% '?></h1>
                        <p class="text-capitalize">profit <br><?=$this->security->xss_clean($plan->periodName) ?></p>
                    </div>
                    <div class="plan-content">
                        <p class="title">For</p>
                        <p class="body"><?=$this->security->xss_clean($plan->maturity_desc) ?></p>
                    </div>
                    <div class="plan-content1">
                        <p class="title-2">Invest</p>
                        <p class="amount-range"><?=to_currency($this->security->xss_clean($plan->minInvestment)).' - '.to_currency($this->security->xss_clean($plan->maxInvestment)) ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>----->

    </div>
</section>
<!-- ##### About Us Area End ##### -->
<section class="call-to-action clearfix mt-5 mr-n35" id="plans">
    <div class="container">
        <div class="section-heading text-center">
            <!-- Dream Dots -->
            <div class="justify-content-center fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.2s">
                <span class="round-head">
                    <?=$this->web_model->getTemplateContent('card_6_subtitle', $template)->value; ?>
                </span>
            </div>
            <br>
            <h2 class="wow fadeInUp main-pg-txt a-delay-2" data-wow-delay="0.3s">
                <?=$this->web_model->getTemplateContent('card_6_title', $template)->value; ?>
            </h2>
            <a href="<?=base_url() ?>signup" class="btn btn-primary-main-pt2 text-uppercase"><?=lang("create_account") ?></a>
        </div>
    </div>
</section>