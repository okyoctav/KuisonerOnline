<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>

        <link href="<?= base_url(); ?>assets/css/style.default.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
        <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="signin">
        
        
        <section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?= base_url() ?>assets/images/logo.jpg" alt="Chain Logo" >
                    </div>
                    <br />
                    <h4 class="text-center mb5">.:: Login User ::.</h4>
                    <p class="text-center">Sign in to your account</p>
                    <?= $this->session->flashdata('msg'); ?>
                    <div class="mb30"></div>
                    <form action="<?= base_url(); ?>login" method="post">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-right">
                                <input type="submit" name="tombol" value="L O G I N" class="btn btn-success">
                            </div>
                        </div>                      
                    </form>
                    
                </div><!-- panel-body -->
            </div><!-- panel -->
            
        </section>


        <script src="<?= base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/pace.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/retina.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.cookies.js"></script>

        <script src="<?= base_url(); ?>assets/js/custom.js"></script>

    </body>
</html>
