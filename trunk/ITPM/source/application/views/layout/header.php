<?php 
$sessLogin = $this->session->userdata('login')[0]; 
?><header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="index-2.html" class="logo">
                        <img src="<?= base_url(); ?>assets/images/logo.png" alt="" /> 
                    </a>
                    <div class="pull-right">
                        <a href="#" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    
                    <div class="pull-right">
                        
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="<?= base_url('logout'); ?>"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
                            </ul>
                        </div><!-- btn-group -->
                        
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>
        
        <section>
            <div class="mainwrapper">
                <div class="leftpanel">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="profile.html">
                            <img class="img-circle" src="<?= base_url(); ?>assets/foto/<?= $sessLogin['foto']; ?>" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $sessLogin['nama_lengkap'] ?></h4>
                            <small class="text-muted">
                                <?php switch ($sessLogin['level']) {
                                    case '0':
                                        echo "P2MI";
                                    break;
                                    case '1':
                                        echo "Puskomsi";
                                    break;
                                } ?>
                            </small>
                        </div>
                    </div><!-- media -->
                    
                    <h5 class="leftpanel-title">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <?php createLink($sessLogin['level']); ?>
                    </ul>
                    
                </div><!-- leftpanel -->
                
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa <?= $fa; ?>"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li><a href="#"><?= $breadcrumb; ?></a></li>
                                </ul>
                                <h4><?= $header; ?></h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">