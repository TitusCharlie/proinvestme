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
                    <ul class="dt-list dt-list-sm">
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
<?php if($pageTitle=="Login" OR $this->uri->segment(1)=="signup" OR $pageTitle=="Forgot Password" OR $pageTitle=="Reset Password") {?>
<?php } else { ?>
<!-- Footer -->
<footer class="dt-footer">

    Copyright <?php echo $this->security->xss_clean($this->companyName); ?> © <?php echo date ('Y'); ?>
</footer>
<!-- /footer -->

</div>
<!-- /site content wrapper -->
</main>
</div>
</div>
<?php } ?>
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
<script src="<?php echo base_url(); ?>assets/dist/summernote/summernote-bs4.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/lang.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/summernote/editor-summernote.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/contact.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/masonry.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/customizer.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/chartist.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/script.js"></script>
</body>
</html>