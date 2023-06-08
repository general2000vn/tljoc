<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Thang Long JOC - e.Office">
    <meta name="author" content="Luton.vn">
    <meta name="keywords" content="tljoc das e.Office">

    <!-- FAVICON -->
    
    <?= $this->Html->meta('favicon.jpg', 'themes/sash/assets/images/brand/favicon.ico', ['type' => 'icon']) ?>

    <!-- TITLE -->
    <title>e-Office: Login</title>

    <!-- BOOTSTRAP CSS -->
    <?= $this->Html->css('../themes/sash/assets/plugins/bootstrap/css/bootstrap.min') ?>

    <!-- STYLE CSS -->
    <?= $this->Html->css('../themes/sash/assets/css/style') ?>
    

	<!-- Plugins CSS -->
    
    <?= $this->Html->css('../themes/sash/assets/css/plugins') ?>

    <!--- FONT-ICONS CSS -->
    
    <?= $this->Html->css('../themes/sash/assets/css/icons') ?>

    <!-- INTERNAL Switcher css -->
    <?= $this->Html->css('../themes/sash/assets/switcher/css/switcher') ?>
    <?= $this->Html->css('../themes/sash/assets/switcher/demo') ?>
    

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            
            <?= $this->Html->image('../themes/sash/assets/images/loader.svg', ['class' => 'loader-img']) ?>
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- Theme-Layout -->
                <?= $this->Flash->render() ?>

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <a href="/tljoc"><?= $this->Html->image('branding/TLJOC_logo_medium.png') ?></a>
                    </div>
                </div>
                
                

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form">
                            <span class="login100-form-title pb-5">
                                e-Office
                            </span>
                            <div class="panel panel-primary">
                                
                                    <?= $this->fetch('content') ?>

                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    
    <?= $this->Html->script(['../themes/sash/assets/js/jquery.min']) ?>

    <!-- BOOTSTRAP JS -->
    <?= $this->Html->script(['../themes/sash/assets/plugins/bootstrap/js/popper.min', '../themes/sash/assets/plugins/bootstrap/js/bootstrap.min']) ?>

    <!-- SHOW PASSWORD JS -->
    
    <?= $this->Html->script(['../themes/sash/assets/js/show-password.min']) ?>

    <!-- GENERATE OTP JS -->
    <?= $this->Html->script(['../themes/sash/assets/js/generate-otp']) ?>

    <!-- Perfect SCROLLBAR JS-->
    <?= $this->Html->script(['../themes/sash/assets/plugins/p-scroll/perfect-scrollbar']) ?>

    <!-- Color Theme js -->
    <?= $this->Html->script(['../themes/sash/assets/js/themeColors']) ?>

    <!-- CUSTOM JS -->
    <?= $this->Html->script(['../themes/sash/assets/js/custom']) ?>

    <!-- Custom-switcher -->
    <?= $this->Html->script(['../themes/sash/assets/js/custom-swicher']) ?>

    <!-- Switcher js -->
    <?= $this->Html->script(['../themes/sash/assets/switcher/js/switcher']) ?>

</body>

</html>