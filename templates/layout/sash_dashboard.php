<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="TLJOC Dashboard">
    <meta name="author" content="Luton">
    <meta name="keywords" content="dashboard, tljoc, oil rate, LTI">
    <!-- <meta http-equiv="refresh" content="30"> -->

    <!-- FAVICON -->
    <?= $this->Html->meta('favicon.png', '/img/branding/favicon.png', ['type' => 'icon']); ?>

    <?php
    $title = 'e-Office: Dashboard';
    ?>
    <!-- TITLE -->
    <title><?= $title ?></title>

    <!-- BOOTSTRAP CSS -->

    <?= $this->Html->css('../themes/sash/assets/plugins/bootstrap/css/bootstrap.min', ['id' => 'style']) ?>

    <!-- STYLE CSS -->
    <?= $this->Html->css([
        '../themes/sash/assets/css/style', '../themes/sash/assets/css/dark-style', '../themes/sash/assets/css/transparent-style', '../themes/sash/assets/css/skin-modes'
    ])
    ?>


    <!--- FONT-ICONS CSS -->
    <?= $this->Html->css(['../themes/sash/assets/css/icons']) ?>


    <!-- COLOR SKIN CSS -->
    <?= $this->Html->css('../themes/sash/assets/colors/color1.css', ['id' => 'theme', 'media' => 'all']) ?>

    <?= $this->element('sash/JS_URL') ?>
    <?= $this->fetch('head_css') ?>
    <?= $this->fetch('head_scripts') ?>

    <!-- My Custom CSS -->
    <?= $this->Html->css([
        'Dashboard/my-dashboard'
        //,'Dashboard/my-marquee'
        , 'Dashboard/my-BreakingNews'
    ]) ?>

    <!-- <?= $this->Html->script('TimelineMax.min') ?> -->

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <?= $this->Html->image('../themes/sash/assets/images/loader.svg', ['class' => 'loader-img', 'alt' => 'Loader']) ?>

    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">

                        <a class="logo-horizontal " href="<?= $this->Url->build('/', ['fullBase' => true]) ?>">

                            <?= $this->Html->image('branding/ Logo tiny.png', ['class' => 'header-brand-img desktop-logo', 'alt' => 'logo']) ?>

                            <?= $this->Html->image('branding/ Logo tiny.png', ['class' => 'header-brand-img light-logo1', 'alt' => 'logo']) ?>
                        </a>
                        <!-- LOGO -->

                        <!-- <div class="noti-holder">
                            <div class="noti-marquee" id="noti-marquee">
                                <?= $this->fetch('noti-marquee') ?>

                                    <div class="tickerwrapper">
                                    <ul class='list-marquee'>
                                        <li class='listitem-marquee'>
                                            <span>This is list item 1</span>
                                        </li>
                                        <li class='listitem-marquee'>
                                            <span>This is list item 2</span>
                                        </li>
                                        <li class='listitem-marquee'>
                                            <span>This is list item 3</span>
                                        </li>
                                        <li class='listitem-marquee'>
                                            <span>This is list item 4</span>
                                        </li>
                                        <li class='listitem-marquee'>
                                            <span>This is list item 5</span>
                                        </li>

                                    </ul>
                                    </div>
                            </div>
                        </div> -->

                        <div class="ticker">
                            <div class="ticker-news" id="noti-marquee">

                                <span id="notice-span">
                                    <span>CONGRATULATIONS ON ACHIEVING TGT MCM TARGET</span>
                                    <!-- <span>Congratulations on achieving TGT MCM Target </span>
                                    <span>3. Expect evening commute delays due to pure chaos and mayhem...</span>
                                    <span>4. Criminals attempt brazen robbery at downtown bank...</span>
                                    <span>5. Citizens are encouraged to use alternate routes during rush hour...</span> -->
                                </span>
                            </div>
                        </div>

                        <div class="d-flex order-lg-2 ms-auto header-right-icons">


                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">

                                        <div class="d-flex country">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>
                                        <!-- Theme-Layout -->

                                        <div class="dropdown d-flex">
                                            <a class="nav-link icon full-screen-link nav-link-bg">
                                                <i class="fe fe-minimize fullscreen-button"></i>
                                            </a>
                                        </div>
                                        <!-- FULL-SCREEN -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!-- Left Side bar -->
            <?= $this->element('sash/left-side-bar-logo') ?>
            <!-- / Left Side bar -->

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <?= $this->fetch('content') ?>


                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>





        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © <span id="year"></span> <a href="javascript:void(0)">Luton</a> <span class="fa fa-heart text-danger"></span>. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->

    </div>

    <canvas id="fireworks"></canvas>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <?= $this->Html->script('../themes/sash/assets/js/jquery.min') ?>

    <!-- BOOTSTRAP JS -->
    <?= $this->Html->script('../themes/sash/assets/plugins/bootstrap/js/popper.min') ?>
    <?= $this->Html->script('../themes/sash/assets/plugins/bootstrap/js/bootstrap.min') ?>

    <!-- SPARKLINE JS-->
    <?= $this->Html->script('../themes/sash/assets/js/jquery.sparkline.min') ?>

    <!-- Sticky js -->
    <?= $this->Html->script('../themes/sash/assets/js/sticky') ?>

    <!-- <?= $this->Html->script('Dashboard/my-fireworks') ?> -->

    <!-- INTERNAL CHARTJS CHART JS-->
    <?= $this->Html->script('../themes/sash/assets/plugins/chart/Chart.bundle') ?>
    <?= $this->Html->script('../themes/sash/assets/plugins/chart/rounded-barchart') ?>
    <?= $this->Html->script('../themes/sash/assets/plugins/chart/utils') ?>


    <!-- GALLERY JS -->
    <?php //echo $this->element('sash/gallery_js') 
    ?>


    <!-- INTERNAL INDEX JS -->
    <?php //echo $this->Html->script('../themes/sash/assets/js/index1') 
    ?>

    <!-- Color Theme js -->
    <?= $this->Html->script('../themes/sash/assets/js/themeColors') ?>

    <!-- CUSTOM JS -->
    <?= $this->Html->script('../themes/sash/assets/js/custom') ?>
    <?= $this->Html->script('Dashboard/my-dashboard') ?>

    <!-- <?= $this->Html->script('Dashboard/my-marquee') ?> -->

    <?= $this->Html->script('Dashboard/myUpdateDashboardStat') ?>


</body>

</html>