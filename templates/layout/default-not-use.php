<?php
$cakeDescription = 'e-Office';
?>

<!doctype html>
<html class="no-js " lang="en">

<head>
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

   <?= $this->element('js_config') ?>
   
    <!--- FONT-ICONS CSS -->
    <?= $this->Html->css("../themes/sash/assets/css/icons") ?>

    <?= $this->fetch('head_css') ?>

    <?= $this->fetch('head_scripts') ?>

</head>

<body class="theme-blue">

    <!-- Page Loader -->
    <?= $this->element('page_loader') ?>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Main Search -->
    <?= $this->element('main_search') ?>

    <!-- Right Icon menu Sidebar -->
    <?= $this->element('right_sidebar') ?>

    <!-- Left Sidebar -->
    <?php echo $this->element($menuElement) ?>
    <?php //echo $this->element('wfh_left_sidebar') ?>
    <?php //echo $this->element('icings_menu'); ?>


    <!-- Main content area -->
    <section class="content">
        <div class="body_scroll">         

            <!-- Page heading and Breadcrumb -->
            <?= $this->element('breadcrum', [$page_heading, $breadcrumbs]) ?>

            <!-- Main page content -->
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </section>
    <div class="align-center">Copyright (C) 2021<br>Developed by <Strong>Luton</Strong></div>

    <?= $this->Html->script('../assets/bundles/libscripts.bundle') ?>
    <?= $this->Html->script('../assets/bundles/vendorscripts.bundle') ?>
    <?= $this->Html->script('../assets/bundles/mainscripts.bundle') ?>


</body>

</html>