
<!-- Site Content Wrapper -->
<div class="dt-content-wrapper">

    <!-- Site Content -->
    <div class="dt-content" style="margin-left: 4rem;">

    <!-- Page Header -->
    <div class="dt-page__header">
        <h1 class="dt-page__title" style="display: inline;"><?php echo lang('frontend_templates') ?></h1>
    </div>
    <!-- /page header -->

    <!-- Grid -->
    <div class="row">

        <!-- Grid Item -->
        <div class="col-xl-12">
            <div class="row">
                <?php foreach($templates as $template) {?>
                <div class="col-sm-4 col-12">
                    <!-- Card -->
                    <div class="dt-card dt-card__full-height text-dark">
                        <div>
                            <img src="<?php echo base_url('assets/dist/img/').$template->img ?>" style="height: 100%;width: 100%;object-fit: contain;box-shadow:0 0 4px 0 rgb(0 0 0 / 20%)">
                        </div>
                        <!-- Card Body -->
                        <div class="dt-card__body">
                            <!-- Media -->
                            <div class="media">
                                <!-- Media Body -->
                                <div class="media-body row">
                                    <div class="col-md-8">
                                        <div class="h2 mb-1"><?php echo $template->name ?> Template </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?php echo base_url('webcontrol/builder/').$template->id ?>" class="btn btn-secondary btn-xs text-uppercase float-right"><?php echo lang('edit') ?></a>    
                                    </div>                                        
                                    </div>
                                <!-- /media body -->
                            </div>
                            <!-- /media -->
                        </div>
                        <!-- /card body -->

                    </div>
                    <!-- /card -->
                </div>
                <?php }?>
            </div>
        </div>
        <!-- /grid item -->

    </div>
    <!-- /grid -->
</div>
<!-- /site content -->