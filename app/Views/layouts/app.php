
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SIM - Klinik Hewan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('assets/modules/jqvmap/dist/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/weather-icon/css/weather-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/weather-icon/css/weather-icons-wind.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/summernote/summernote-bs4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/modules/ionicons/css/ionicons.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
    </script>
</head>
    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('username') ?></div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('logout')?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Klinik Hewan A</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">KHA</a>
                    </div>
                    
                    <?= $this->include('layouts/sidebar') ;?>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $this->renderSection('page_title');?></h1>
                    </div>
                    <?= $this->renderSection('content');?>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                Copyright &copy; 2018
                </div>
                <div class="footer-right">
                
                </div>
            </footer>
            </div>
        </div>
        <?= $this->renderSection('modal');?>

        <!-- General JS Scripts -->
        <script src="<?= base_url('assets/modules/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/popper.js') ?>"></script>
        <script src="<?= base_url('assets/modules/tooltip.js') ?>"></script>
        <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/stisla.js') ?>"></script>
        
        <!-- JS Libraies -->
        <script src="<?= base_url('assets/modules/simple-weather/jquery.simpleWeather.min.js') ?>"></script>
        <script src="<?= base_url('assets/modules/summernote/summernote-bs4.js') ?>"></script>

        <!-- Page Specific JS File -->
        <script src="<?= base_url('assets/js/page/index-0.js') ?>"></script>
        
        <!-- Template JS File -->
        <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
        <script src="<?= base_url('assets/js/custom.js') ?>"></script>

        <!-- addons -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            $(".notif").fadeTo(2000, 500).slideUp(500, function(){
                $(".notif").slideUp(500);
            });

            $('.telp').mask('62000000000000');
            $('.money').mask('000.000.000.000.000', {reverse: true});
        </script>
        <?= $this->renderSection('script');?>
        
    </body>
</html>