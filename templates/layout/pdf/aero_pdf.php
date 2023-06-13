<?php
$cakeDescription = 'e-Office';
?>

<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <meta content="width=device-width, initial-scale=1, user-scalable=yes" name="viewport"> -->
    <meta name="description" content="TLJOC e-Office">

    <title>
        <?= $cakeDescription ?>:

        <?= $page_heading ?>
    </title>

    <?= $this->Html->meta('favicon.jpg', '/favicon.jpg', ['type' => 'icon']) ?>


    <?= $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ?>
    
    <?= $this->fetch('head_css') ?>
    
    <?= $this->Html->css(['myCustomPdfAero']) ?>

    <?= $this->element('js_config') ?>
    
    <?= $this->fetch('head_scripts') ?>


</head>

<body class="theme-blue">

    <header>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <?= $this->Html->image('branding/HLHV Logo tiny.png', ['class' => 'header-brand-img desktop-logo', 'alt' => 'logo']) ?>
                </div>
                <div class="col-6 text-right">
                    Hoàng Long Hoàn Vũ JOCs
                </div>
            </div>
        </div>
    </header>

    <!-- Main content area -->
    <section class="content">
        <div class="body_scroll">         


            <!-- Main page content -->
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </section>
    <div class="align-center">Copyright (C) 2021<br>Developed by <Strong>Trần Hoàng Anh</Strong></div>

    <?= $this->Html->script('../assets/bundles/libscripts.bundle') ?>
    <?= $this->Html->script('../assets/bundles/vendorscripts.bundle') ?>
    <?= $this->Html->script('../assets/bundles/mainscripts.bundle') ?>

    <?= $this->fetch('bottom_scripts') ?>
</body>

</html>