<?php

?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="TLJOC e-Office">

    <?php $cakeDescription = "e-Office: "; ?>

    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('favicon.jpg', '/favicon.jpg', ['type' => 'icon']) ?>


    <?= $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ?>
    <?= $this->Html->css(['myCustomAero']) ?>
</head>

<body class="theme-blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 offset-md-4 offset-lg-3">
                <?= $this->Flash->render() ?>
            </div>
        </div>
    </div>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <!-- Jquery Core Js -->
    <?= $this->Html->script(['../assets/bundles/libscripts.bundle', '../assets/bundles/vendorscripts.bundle.js']) ?>

    <!-- <script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> Lib Scripts Plugin Js -->
</body>

</html>