<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>R</b>AB</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Hitung</b>RAB</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/adminlte/') ?>dist/img/profilepicture.png" class="user-image" alt="User Image">
                                <span class="hidden-xs">Sign Out</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url('assets/adminlte/') ?>dist/img/profilepicture.png" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->userdata('username') ?>
                                        <small>PT. Solusi Tukang Indonesia</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="pull-right">
                                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url('assets/adminlte/') ?>dist/img/profilepicture.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>PT. STI</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li><a href="<?= base_url('user') ?>"><i class="fa fa-dashboard"></i> <span>Hitung RAB</span></a></li>
                    <li><a href="<?= base_url('user/lokasi') ?>"><i class="fa fa-map"></i> <span>Master Lokasi</span></a></li>
                    <li><a href="<?= base_url('user/material') ?>"><i class="fa fa-cube"></i> <span>Master Material</span></a></li>
                    <li><a href="<?= base_url('user/jasa') ?>"><i class="fa fa-users"></i> <span>Master Jasa</span></a></li>
                    <li><a href="<?= base_url('user/harga_material') ?>"><i class="fa fa-money"></i> <span>Harga Material</span></a></li>
                    <li><a href="<?= base_url('user/harga_jasa') ?>"><i class="fa fa-money"></i> <span>Harga Jasa</span></a></li>
                    <li><a href="<?= base_url('user/pekerjaan') ?>"><i class="fa fa-briefcase"></i> <span>Master Pekerjaan</span></a></li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>