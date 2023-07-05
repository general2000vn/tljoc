<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="TLJOC e-Office">
    <meta name="author" content="Luton">
    <meta name="keywords" content=" TLJOC e-Office">

    <!-- FAVICON -->
    <?= $this->Html->meta('favicon.png', '/img/branding/favicon.png', ['type' => 'icon']); ?>

    <!-- TITLE -->
    <title><?= 'e-Office: ' . $page_heading ?></title>

    <!-- BOOTSTRAP CSS -->
    <?= $this->Html->css("../themes/sash/assets/plugins/bootstrap/css/bootstrap.min") ?>

    <!-- STYLE CSS -->
    <?= $this->Html->css(["../themes/sash/assets/css/style", "../themes/sash/assets/css/dark-style", "../themes/sash/assets/css/transparent-style", "../themes/sash/assets/css/skin-modes"]) ?>

    <!--- FONT-ICONS CSS -->
    <?= $this->Html->css("../themes/sash/assets/css/icons") ?>

    <!-- COLOR SKIN CSS -->
    <?= $this->Html->css("../themes/sash/assets/colors/color1", ['media' => 'all', 'id' => 'theme']) ?>

    <!-- My global customization -->
    <?= $this->Html->css("../themes/sash/assets/css/my-sash-custom") ?>

    <?= $this->element('JS_URL') ?>
    <?= $this->fetch('head_css') ?>
    <?= $this->fetch('head_scripts') ?>

    <?= $this->Html->css("mySash") ?>

</head>

<body class="app sidebar-mini ltr">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">

        <?= $this->Html->image("../themes/sash/assets/images/loader.svg", ['class' => 'loader-img', 'alt' => 'Loader']) ?>
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <?= $this->element('sash/app-header') ?>
            

            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <?= $this->element('sash/left-side-bar-logo') ?>
                    <!-- <?= $this->element($menuElement) ?> -->
                </div>
                <!--/APP-SIDEBAR-->
            </div>
            
            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <?= $this->element('sash/page_header_breadscrum', [$page_heading, $breadcrumbs]) ?>
                        <!-- PAGE-HEADER END -->

                        <!-- Content Page Start -->
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>

                        <!-- Content Page End -->

                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!--app-content closed-->
        </div>

        <!-- FOOTER -->
        <?= $this->element('sash/footer') ?>
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <?= $this->element('sash/theme-default-bottom-scripts') ?>

    <!-- e-Office customization-->
    <?= $this->fetch('bottom_scripts') ?>

</body>

</html>