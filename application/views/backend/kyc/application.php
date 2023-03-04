<aside class="dt-customizer dt-drawer position-right" style="width: 35%!important;">
            <div class="dt-customizer__inner">
                <!-- Customizer Header -->
                <div class="dt-customizer__header">
                    <!-- Customizer Title -->
                    <div class="dt-customizer__title" style="display: flex;">
                        <h3 class="mb-0 text-capitalize" id="lang-header"><?=lang('kyc_details')?></h3>
                        
                    </div>
                    <!-- /customizer title -->
                    <!-- Close Button -->
                    <button type="button" class="close" data-toggle="customizer">
                        <span aria-hidden="true">×</span>
                    </button>
                    <!-- /close button -->
                </div>
                <!-- /customizer header -->

                <!-- Customizer Body -->
                <div class="dt-customizer__body ps-custom-scrollbar ps">
                <div class="loader" id="LangSettingsloader" style="display: none;"></div>
                    <!-- Customizer Body Inner  -->
                    <div class="dt-customizer__body-inner" id="sideContent">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="margin-bottom: 0px;" id="kycname"></h4>
                                <span id="kycemail"></span>
                            </div>
                            <div class="col-md-6">
                                <span class="badge bg-dark-green ng-star-inserted text-white text-capitalize float-right" id="kycstatus"></span>
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        <p><?=lang('identification_document')?> <d class="text-capitalize" id="id_type"></d></p>
                        </div>
                        <div class="col-md-6" style="display: flex;">
                            <button class="assigned-badge badge badge-danger ng-star-inserted text-capitalize float-left viewdoc" id="rejectedid" style="margin: 0 10px;border: none;" data-title="Rejected Identification Document" data-toggle="modal" data-target="#documentModal">Rejected Doc</button>  
                            <button class="assigned-badge badge badge-primary ng-star-inserted text-capitalize float-left viewdoc" id="submittedid" data-title="Submitted Identification Document" data-toggle="modal" data-target="#documentModal"><?=lang('submitted_doc')?></button>  
                        </div>
                    </div>  
                    <?php echo form_open(base_url(), array('id' => 'kycForm'));?>
                    <!-- Form Group -->
                    <div class="form-group">
                        <label for="payouts"><?=lang('approval_status')?></label>
                        <br>
                        <!-- Radio Button -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="approveidverificationstatus" name="idverificationstatus" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="approveidverificationstatus"><?=lang('approved')?>
                            </label>
                        </div>
                        <!-- /radio button -->
                        <!-- Radio Button -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rejectidverificationstatus" name="idverificationstatus" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="rejectidverificationstatus"><?=lang('rejected')?>
                            </label>
                        </div>
                        <!-- /radio button -->
                    </div>
                    <!-- /form group -->
                    <!-- Form Group -->
                    <div class="form-group hide" id="rejectionreason1">
                        <label for="rejectionreason1"><?=lang('rejection_reason')?></label>
                        <textarea 
                            name="rejectionreason1" 
                            class="form-control"
                            id="kycid_rejection_reason" rows="5">
                        </textarea>
                    </div>
                    <!-- /form group -->
                    <div class="row">
                        <div class="col-md-6">
                        <p><?=lang('address_verification_doc')?> <d class="text-capitalize" id="address_type"></d></p>
                        </div>
                        <div class="col-md-6" style="display: flex;">
                            <button class="assigned-badge badge badge-danger ng-star-inserted text-capitalize float-left viewdoc" id="rejectedaddress" style="margin: 0 10px;border: none;" data-title="Rejected Address Document" data-toggle="modal" data-target="#documentModal">Rejected Doc</button> 
                            <button class="assigned-badge badge badge-primary ng-star-inserted text-capitalize float-left viewdoc" id="submittedaddress" data-title="Submitted Address Document" style="max-height: 2.7em;" data-toggle="modal" data-target="#documentModal"><?=lang('submitted_doc')?></button>  
                        </div>
                    </div>  
                    <!-- Form Group -->
                    <div class="form-group">
                        <label for="payouts"><?=lang('approval_status')?></label>
                        <br>
                        <!-- Radio Button -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="approveaddressverification" name="approveaddressverification" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="approveaddressverification"><?=lang('approved')?>
                            </label>
                        </div>
                        <!-- /radio button -->
                        
                        <!-- Radio Button -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rejectaddressverification" name="approveaddressverification" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="rejectaddressverification"><?=lang('rejected')?>
                            </label>
                        </div>
                        <!-- /radio button -->
                    </div>
                    <!-- /form group -->
                    <!-- Form Group -->
                    <div class="form-group hide" id="rejectionreason2">
                        <label for="rejectionreason2"><?=lang('rejection_reason')?></label>
                        <textarea 
                            name="rejectionreason2" 
                            class="form-control"
                            id="kycaddress_rejection_reason" rows="5">
                        </textarea>
                    </div>
                    <!-- /form group -->  
                    <hr>   
                    <!-- Form Group -->
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary text-uppercase w-25 float-right"><?php echo lang('save') ?></button>
                    </div>
                    <!-- /form group -->   
                    <?php echo form_close();?>
                    </div>
                    <!-- /customizer body inner -->
                </div>
                <!-- /customizer body -->
            </div>
        </aside>