<!DOCTYPE html>
<html lang="en">

<head>
    <title>ProInvest Installation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/bootstrap.min.css')?>">
    <script src="https://use.fontawesome.com/8c9497e8c0.js"></script>
    <script src="<?=base_url('assets/dist/installer/js/jquery.min.js') ?>"></script>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="pt-5">
                    <img class="d-block mx-auto mb-4" src="<?=base_url('uploads/logo.png')?>" alt="" width="250">
                    <h2 class="text-center">ProInvest Installation Guide</h2>
                </div>

                <?php if($config == 1 && $uploads == 1 && $htaccess_exists == 1){?>
                <?php if(isset($message)) {?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php }?>
                <!-- AJAX request -->
                <div class="alert alert-warning alert-dismissible fade show" style="display: none" role="alert">
                    <strong>Warning!</strong>
                    <div id="msg">You should check in on some of those fields below.</div>
                    <button type="button" class="close" aria-label="Close" onclick="$('.alert').hide();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- -->
                <form class="needs-validation" novalidate="" id="installform" method="post" action="<?php echo base_url('installer'); ?>">
                    <div class="mb-3">
                        <label for="firstName">Host name</label>
                        <input type="text" class="form-control" id="hostname" name="hostname" placeholder="localhost"
                            value="" required="">
                        <div class="invalid-feedback">
                            Host name is required.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="root"
                                required="">
                            <div class="invalid-feedback" style="width: 100%;">
                                Username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Database Name</label>
                        <input type="text" class="form-control" id="database" name="database" placeholder="Proinvest_db"
                            required="">
                        <div class="invalid-feedback">
                            Please enter your database name.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Envato Purchase Code</label>
                        <input type="text" class="form-control" id="purchasecode" name="purchasecode" placeholder="purchase code"
                            required="">
                        <div class="invalid-feedback">
                            Please enter the envato purchase code.
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitID">Continue</button>
                </form>
                <?php } else {?>
                <?php if($config != 1 || $uploads != 1) {?>
                <div class="p-3 mb-2 bg-light text-white text-dark">
                    <div class="text-center"><i class="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></i></div>
                    <p>Before proceeding please ensure that you have changed the permissions of the following folders
                        and files to
                        <code>777</code>
                        <br>
                        <br>
                        Ensure that you change the permission for <code>application/config/database.php</code> back to default <code>644</code> permission after installation.
                        <ul class="list-unstyled">
                            <li>
                                <?php if($config){ ?>
                                <i class="fa fa-check-circle fa-2x text-success"></i>
                                <?php } else {?>
                                <i class="fa fa-times-circle fa-2x text-danger"></i>
                                <?php }?>
                                <code>application/config/database.php</code>
                            </li>
                            <li>
                                <?php if($uploads){ ?>
                                <i class="fa fa-check-circle fa-2x text-success"></i>
                                <?php } else {?>
                                <i class="fa fa-times-circle fa-2x text-danger"></i>
                                <?php }?>
                                <code>uploads/</code>
                            </li>
                        </ul>
                        Refer to the <a href="<?=base_url('documentation/index.html') ?>">documentation</a> or contact the Axis96
                        support team.</a></p>
                    <button class="btn btn-primary btn-lg btn-block"
                        onclick="window.location.reload(true)">Continue</button>
                </div>
                <?php } else if($htaccess_exists != 1) {?>
                    <p>The <b>.htaccess</b> file was not found in your root folder. Go to the downloaded zip folder & copy the .htaccess file that came with the package manually to the root folder.</p> 
                    Refer to the <a href="<?=base_url('documentation/index.html') ?>">documentation</a> or contact the Axis96
                        support team.</a></p>
                    <button class="btn btn-primary btn-lg btn-block"
                        onclick="window.location.reload(true)">Continue</button>
                <?php } } ?>
                <div class="p-3 mb-2 bg-light text-white text-dark" style="display: none" id="success_install">
                    <div class="text-center"><i class="fa fa-check-circle fa-4x green"
                            aria-hidden="true"></i></div>
                    <p>You have succesfully configured the ProInvest database for your site. Click on the button below
                        to go to your homepage.</p>
                    <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-lg btn-block">Continue</a>
                    <div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
<script src="<?=base_url('assets/dist/installer/js/popper.min.js')?>"></script>
<script src="<?=base_url('assets/dist/installer/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/dist/installer/js/index.js')?>"></script>
</body>

</html>