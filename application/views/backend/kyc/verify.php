<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KYC/AML Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/verification.css')?>">
    <link rel='stylesheet' href="<?=base_url('assets/dist/css/dropify.min.css'); ?>">
    <link rel='stylesheet' href="<?=base_url('assets/dist/css/dropify.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <?php echo form_open(base_url('kyc-apply') , array('id' => 'kycApply', 'enctype=' => 'multipart/form-data'));?>
        <div id="new-form">
            <img src="<?php echo $this->security->xss_clean($this->logoDark); ?>" class="ctr mt-3">
            <h3><?=lang('kyc_verification')?></h3>
          <div class="counter"><span></span>/4</div>
            <div class="question in-view question1">
                <div class="col-xs-12">
                    <?php if($info == false) {?>
                        <p class="title"><?=lang('kyc_message')?></p>
                    <?php } else {?>
                    <?php if($info->overall_status == 0 || $info->overall_status == 3) {?>
                    <p class="title"><?=lang('youve_successfully_submitted_your_documents')?></p>
                    <?php } else if($info->overall_status == 1){?>
                    <p class="title"><?=lang('your_account_has_been_verified_successfully')?></p>
                    <?php } else if($info->overall_status == 2) {?>
                    <p class="title"><?=lang('the_documents_below_have_been_rejected_please_resubmit_them')?></p>
                    <ul>
                        <?php if($info->status1 == 2) { ?>
                        <li><?=lang('identification_document')?></li>
                        <p style="color:black"><?=lang('reason')?>: <?=$info->rejection_reason_id?></p>
                        <?php } if($info->status2 == 2) { ?>
                        <li><?=lang('address_document')?></li>
                        <p style="color:black"><?=lang('reason')?>: <?=$info->rejection_reason_address?></p>
                        <?php }?>
                    </ul>
                    <?php }}?>
                </div>
            </div>

            <div class="question down question2">
                <div class="col-xs-12">
                    <p class="title"><?=lang('please_select_id_to_upload')?>
                        <d style="color: black">
                            <?php if($info != false){
                                if($info->status1 == 0 || $info->status1 == 3){
                                    echo '['.lang('edits_not_allowed').']';
                                } else if($info->status1 == 1){
                                    echo '['.lang('document_accepted').']';
                                }
                            }; ?>
                        </d>
                    </p>
                </div>
                <div class="col-xs-12 ml-25">
                    <input class="iddoc" id="box1" name="identification_doc" value="ID" type="checkbox" <?= $info != false ? $info->id_type == 'ID' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status1 == 0 || $info->status1 == 1 || $info->status1 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box1"><?=lang('national_id')?></label>
                    <br>
                    <input class="iddoc" id="box2" name="identification_doc" value="passport" type="checkbox" <?= $info != false ? $info->id_type == 'passport' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status1 == 0 || $info->status1 == 1 || $info->status1 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box2"><?=lang('passport')?></label>
                </div>
                <div class="col-xs-12 error wid">
                    <p><?=lang('please_select_id_to_upload')?></p>
                </div>
            </div>

            <div class="question down question3">
                <div class="col-xs-12">
                    <p class="title"><?=lang('please_upload_file_with_clear_images')?> 
                    <d style="color: black">
                        <?php if($info != false){
                            if($info->status1 == 0 || $info->status1 == 3){
                                echo '['.lang('edits_not_allowed').']';
                            } else if($info->status1 == 1){
                                echo '['.lang('document_accepted').']';
                            }
                        }; ?>
                    </d>
                    </p>
                    <input class="dropify" id="idimg" type="file" name="idimg" data-default-file="<?= $info != false ? base_url('uploads/'.$info->identification_document) : '' ; ?>">
                </div>
                <div class="col-xs-12 error wimgd">
                    <p><?=lang('please_upload_file_with_clear_images')?> </p>
                </div>
            </div>

            <div class="question down question4">
                <div class="col-xs-12">
                    <p class="title"><?=lang('please_select_address_doc_to_upload')?>
                        <d style="color: black">
                            <?php if($info != false){
                                if($info->status2 == 0 || $info->status2 == 3){
                                    echo '['.lang('edits_not_allowed').']';
                                } else if($info->status2 == 1){
                                    echo '['.lang('document_accepted').']';
                                }
                            }; ?>
                        </d>
                        </p>
                </div>
                <div class="col-xs-12 ml-25">
                    <input class="addressdoc" id="box3" name="address_doc" value="utility bill" type="checkbox" <?= $info != false ? $info->address_type == 'utility bill' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status2 == 0 || $info->status2 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box3"><?=lang('utility_bill')?></label>
                    <br>
                    <input class="addressdoc" id="box4" name="address_doc" value="bank reference" type="checkbox" <?= $info != false ? $info->address_type == 'bank reference' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status2 == 0 || $info->status2 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box4"><?=lang('bank_reference')?></label>
                    <br>
                    <input class="addressdoc" id="box5" name="address_doc" value="proof of residence" type="checkbox" <?= $info != false ? $info->address_type == 'proof of residence' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status2 == 0 || $info->status2 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box5"><?=lang('proof_of_residence')?></label>
                    <br>
                    <input class="addressdoc" id="box6" name="address_doc" value="driver or residence permit" type="checkbox" <?= $info != false ? $info->address_type == 'driver or residence permit' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status2 == 0 || $info->status2 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box6"><?=lang('driver_or_residence_permit')?></label>
                    <br>
                    <input class="addressdoc" id="box7" name="address_doc" value="other" type="checkbox" <?= $info != false ? $info->address_type == 'other' ? 'checked' : '' : '' ; ?> <?= $info != false ? $info->status2 == 0 || $info->status2 == 3 ? 'disabled="true"' : '' : '' ; ?>/>
                    <label for="box7"><?=lang('other')?></label>
                </div>
                <div class="col-xs-12 error wad">
                    <p><?=lang('please_select_address_doc_to_upload')?>
                        <d style="color: black">
                            <?php if($info != false){
                                if($info->status2 == 0 || $info->status2 == 3){
                                    echo '['.lang('edits_not_allowed').']';
                                } else if($info->status2 == 1){
                                    echo '['.lang('document_accepted').']';
                                }
                            }; ?>
                        </d>
                    </p>
                </div>
            </div>

            <div class="question down question5">
                <div class="col-xs-12">
                    <p class="title"><?=lang('please_upload_file_with_clear_images')?>
                        <d style="color: black">
                            <?php if($info != false){
                                if($info->status2 == 0 || $info->status2 == 3){
                                    echo '['.lang('edits_not_allowed').']';
                                } else if($info->status2 == 1){
                                    echo '['.lang('document_accepted').']';
                                }
                            }; ?>
                        </d>
                    </p>
                    <input class="dropify" id="addressimg" type="file" name="addressimg" data-default-file="<?= $info != false ? base_url('uploads/'.$info->address_document) : '' ; ?>">
                </div>
                <div class="col-xs-12 error wiadd">
                    <p><?=lang('please_upload_file_with_clear_images')?></p>
                </div>
            </div>

            <div class="question down load-space">

                <p><?=lang('processing_the_form')?></p>
                <div class="gear">
                    <div class="center"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                </div>
                <div class="gear-reverse">
                    <div class="center"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                    <div class="tooth"></div>
                </div>
                <div class="load-bar">
                    <div class="load-juice"></div>
                </div>
                <button type="button" onclick="location.href = '<?=base_url('dashboard')?>';"><?=lang('proceed_to_dashboard')?></button>
            </div>
            <a href="<?=base_url('dashboard')?>" class="skip"><?=lang('skip_to_dashboard')?></a>
            <button type="button" id="back-to-q-1" style="display:none; right: 9em;"><?=lang('back_page')?></button>
            <button type="button" id="to-q-2"><?=lang('next_page')?></button>

        </div>
    </form>
    <input id="ovstat" class="hide" value="<?= $info == false ? '7' : $info->overall_status?>">
</body>

</html>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script  src="<?=base_url('assets/dist/js/verification.js')?>"></script>
<script src="<?=base_url('assets/dist/js/dropify.js'); ?>"></script>
<script src="<?=base_url('assets/dist/js/dropify.min.js'); ?>"></script>
</body>
</html>
