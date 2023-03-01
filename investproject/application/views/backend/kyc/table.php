<?php 
$team = $this->ticket_model->team();
?>
<div class="dt-content-wrapper">
    <!-- Site Content -->
    <div class="dt-content">
        <!-- Profile -->
        <div class="profile">
            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Grid -->
                <div class="row">
                    <!-- Grid Item -->
                    <div class="col-xl-12 col-12 order-xl-1">
                        <!-- Card -->
                        <div class="dt-card">
                            <!-- Card Body -->
                            <div class="dt-module__content-inner">
                                <div class="border-bottom border-w-2 mb-1 mt-n1 pb-4 px-1">
                                    <div class="d-flex flex-wrap"></div>
                                </div>
                            <!-- Tables -->
                            <div class="dt-module__content position-relative ps ps--active-y">
                                <div class=""><!---->
                                    <div id="hpdk" data-url="<?php echo base_url('bulk_assign_ticket') ?>" class="dt-module__list ng-star-inserted"><!---->
                                        <?php foreach($verifications as $task) {?>
                                            <div class="helpdesk dt-module__list-item ng-star-inserted">
                                                <div>
                                                    <div class="mr-5 dt-checkbox dt-checkbox-icon dt-checkbox-only">
                                                        <input type="checkbox" id="<?php echo $task->id; ?>" class="helpdesk-list checkbox ng-pristine ng-valid ng-touched">
                                                        <label class="font-weight-light dt-checkbox-content">
                                                            <span class="unchecked">
                                                                <i name="box-o" size="xl" class="icon icon-box-o icon-xl icon-fw"></i>
                                                            </span>
                                                            <span class="checked ng-star-inserted">
                                                                <i name="box-check-o" size="xl" class="text-primary icon icon-box-check-o icon-xl icon-fw"></i>
                                                            </span><!----><!---->
                                                        </label>
                                                    </div><!----><!---->
                                                    <?php if($role != ROLE_CLIENT) {?>
                                                    <gx-star class="mr-5 dt-checkbox dt-checkbox-icon dt-checkbox-only">
                                                        <input type="checkbox" id="gx-star-221" class="ng-untouched ng-pristine ng-valid">
                                                        <label class="font-weight-light dt-checkbox-content" for="gx-star-221">
                                                            <span class="unchecked">
                                                                <i name="star-o" size="xl" class="icon icon-star-o icon-xl icon-fw"></i>
                                                            </span>
                                                            <span class="checked">
                                                                <i name="star-fill" size="xl" class="text-warning icon icon-star-fill icon-xl icon-fw"></i>
                                                            </span>
                                                        </label>
                                                    </gx-star>
                                                    <?php }?>
                                                </div>
                                                <div class="dt-module__list-item-content">
                                                    <div class="user-detail">
                                                        <span class="user-name"><?php echo $task->userFirstName.' '.$task->userLastName ?></span>
                                                        <span class="dt-separator-v">&nbsp;</span>
                                                        <span class="designation">
                                                            <?php if($isDemo == false) {?>
                                                                <?php echo $task->userEmail ?>
                                                            <?php } else {?>
                                                                <?php echo '[Email Protected in Demo]'; ?>
                                                            <?php }?>
                                                        </span>
                                                        <task-badges style="margin-left: 3em;">
                                                            <div class="badge-group ng-star-inserted">
                                                                <span class="resolve-badge<?php echo $task->id ?> badge <?php echo $task->overall_status == 0 ? 'bg-dark-blue' : 'bg-dark-green'; ?> text-white ng-star-inserted">
                                                                <?php 
                                                                    if($task->overall_status == 0){
                                                                        echo lang('new_application');
                                                                    } else if($task->overall_status == 1){
                                                                        echo lang('approved');
                                                                    } else if($task->overall_status == 2){
                                                                        echo lang('pending_resubmission');
                                                                    } else if($task->overall_status == 3){
                                                                        echo lang('resubmitted');
                                                                    } else if($task->overall_status == 4){
                                                                        echo lang('rejected');
                                                                    }
                                                                ?>
                                                                </span>
                                                                
                                                                <?php if($task->assignedTo == 0) {?>
                                                                    <span class="assigned-badge badge badge-primary ng-star-inserted text-capitalize"><?=lang('unassigned')?></span>
                                                                <?php } else { ?>
                                                                    <span class="assigned-badge badge badge-primary ng-star-inserted text-capitalize"><?=lang('assigned_to')?>: <?= $task->assignedToFirstName.'&nbsp'.$task->assignedToLastName ?></span>
                                                                <?php }?>
                                                            </div>
                                                        </task-badges>
                                                    </div>
                                                </div>
                                                <div class="dt-module__list-item-info">
                                                    <span><?=lang('date_updated')?>: <?php echo date("d M y H:i",strtotime($task->createdDtm)) ?></span>
                                                    <button class="assigned-badge badge badge-primary ng-star-inserted text-capitalize kycapplication" data-url="<?=base_url('kyc-verification-info/').$task->id?>" data-form="<?=base_url('kyc-verify/').$task->id?>"><?=lang('view')?></button>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!-- /card body -->
                            </div>
                            <!-- /card -->
                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /grid -->
                    <div style="float:right">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>

                </div>
                <!-- /profile content -->

            </div>
            <!-- /Profile -->
            <?php $this->load->view('backend/kyc/application'); ?>
            <!-- Modal -->
            <div class="modal fade display-n" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="model-8" aria-hidden="true" style="z-index: 2000;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <!-- Modal Content -->
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title" id="documentTitle">Document</h3>
                            <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <!-- /modal header -->
                        <!-- Modal Body -->
                        <div class="modal-body" id="modalBody">
                            <embed id="documentembed" src="<?=base_url('uploads/blank_.pdf')?>" frameborder="0" width="100%" height="400px">
                        </div>
                        <!-- /modal body -->
                        <!-- Modal Footer -->
                        <div class="modal-footer" id="modalFooter">
                            <a href="button" target="_blank" id="downloaddoc" download="" class="btn btn-primary btn-sm">Download</a>
                            <button type="button"
                                class="btn btn-secondary btn-sm"
                                data-dismiss="modal"><?php echo lang('cancel') ?>
                            </button>
                        </div>
                        <!-- /modal footer -->
                    </div>
                    <!-- /modal content -->
                </div>
            </div>
            <!-- /modal -->
        </div>
        </div>
    </div><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer -->
    <script>
        $('.checkbox-check').change(function() {
            var newsubmission = $('#gx-checkbox-230').prop('checked');
            var resubmitted = $('#gx-checkbox-231').prop('checked');
            var pendingresubmission = $('#gx-checkbox-232').prop('checked');
            var approved = $('#gx-checkbox-233').prop('checked');
            var rejected = $('#gx-checkbox-234').prop('checked');

            $.ajax({
                url: './kyc-filter',
                type: 'POST',
                data: {
                    newsubmission: newsubmission,
                    resubmitted: resubmitted,
                    pendingresubmission: pendingresubmission,
                    approved: approved,
                    rejected: rejected,
                },
                success: function(data) {
                    var content = JSON.parse(data);
                    $("input[name="+content.csrfTokenName+"]").val(content.csrfHash);
                    if(content.success == true){
                        location.reload();
                    }
                },
                error: function(data) {}
            })
        })
        $('.kycapplication').on('click', function(e){
            e.preventDefault();
            var key = $(this).attr('data-url');
            var form = $(this).attr('data-form');

            $.ajax({
                url: key,
                type: 'GET',
                success: function(data){
                    var content = JSON.parse(data);
                    
                    if(content.success == true){
                        $('.dt-drawer').addClass('open');
                        $('.dt-customizer__body').scrollTop(0);
                        $.each(content.static_info, function(key, value){
                            $('#kyc'+key).html(value);   
                            if(key == 'submittedid' || key == 'rejectedid' || key == 'submittedaddress' || key == 'rejectedaddress')
                            {
                                $('#'+key).attr('data-value', value);

                                if((key == 'rejectedid' && value == null) || (key == 'rejectedaddress' && value == null) || (key == 'submittedid' && value == null) || (key == 'submittedaddress' && value == null)){
                                    $('#'+key).hide();
                                } else if((key == 'rejectedid' && value != null ) || (key == 'rejectedaddress' && value != null) || (key == 'submittedid' && value != null) || (key == 'submittedaddress' && value != null)) {
                                    $('#'+key).show();
                                }
                            } else if(key == 'id_type' || key == 'address_type'){
                                $('#'+key).html('['+value+']');
                            }
                        });
                        $.each(content.form_variables, function(key, value){
                            $('#kyc'+key).val(value);
                            if(key == 'id_rejection_reason' || key == 'address_rejection_reason'){
                                if(key == 'id_rejection_reason' && value != null){
                                    $('#rejectionreason1').show();
                                } else if(key == 'address_rejection_reason' && value != null){
                                    $('#rejectionreason2').show();
                                }
                            }
                            if(key == 'id_rejection_status' || key == 'address_rejection_status'){
                                if(key == 'id_rejection_status' && value == '1'){
                                    $('#approveidverificationstatus').prop('checked', true);
                                } else if(key == 'address_rejection_status' && value == '1'){
                                    $('#approveaddressverification').prop('checked', true);
                                } else if(key == 'id_rejection_status' && value == '2'){
                                    $('#rejectidverificationstatus').prop('checked', true);
                                } else if(key == 'address_rejection_status' && value == '2'){
                                    $('#rejectaddressverification').prop('checked', true);
                                } 
                            }
                        });

                        $('#kycForm').attr('action', form);
                    }
                },
                error: function(data){}
            })
        })
        $('input[name=idverificationstatus]').change(function(){
            var value = $( 'input[name=idverificationstatus]:checked' ).val();
            if(value == 2){
                $('#rejectionreason1').show();
            } else {
                $('#rejectionreason1').hide();
            }
        });
        $('input[name=approveaddressverification]').change(function(){
            var value = $( 'input[name=approveaddressverification]:checked' ).val();
            if(value == 2){
                $('#rejectionreason2').show();
            } else {
                $('#rejectionreason2').hide();
            }
        });
        $('#kycForm').on('submit', function(e){
            e.preventDefault();
            var actionurl = e.currentTarget.action;

            $.ajax({
                url: actionurl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(data){
                    var content = JSON.parse(data);
                    $("input[name="+content.csrfTokenName+"]").val(content.csrfHash);

                    swal(
                        content.success == true ? 'Success!' : 'Error!',
                        content.msg,
                        content.success == true ? 'success' : 'error'
                    );
                },
                error: function(data){}
            })
        })
        $('.viewdoc').on('click', function(e){
            e.preventDefault();
            var doc = $(this).attr('data-value');
            var title = $(this).attr('data-title');

            $('#documentTitle').html(title);
            $('#documentembed').attr('src', doc);
            $('#downloaddoc').attr('href', doc);
            $('#downloaddoc').attr('download', doc);
        })
    </script>