<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>">
                <?= $this->Html->image("branding/HLHV Logo small.png", ['class' => "header-brand-img desktop-logo", 'alt' => 'Logo']) ?>
                <?= $this->Html->image("branding/HLHV Logo small.png", ['class' => "header-brand-img light-logo1", 'alt' => 'Logo']) ?>
                
            </a>
            <!-- LOGO -->


            <div class="d-flex order-lg-2 ms-auto header-right-icons">

                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">

                            <!-- Dark Mode 
                            <div class="d-flex country">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            -->


                            <!-- Theme-Layout -->

                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->

                            <!-- Right Panel toggle ------------ 
                            <div class="dropdown d-flex header-settings">
                                <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                    <i class="fe fe-align-right"></i>
                                </a>
                            </div>
                            -->

                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    
                                    <?= $this->Html->image('../uploads/avatar/avatardefault.webp' , ['class' => "avatar  profile-user brround cover-image", 'alt' => 'Avatar']) ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold"><?= $this->Identity->get('name') ?></h5>
                                            <small class="text-muted"><?= $this->Identity->get('username') ?></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    
                                    <?= $this->Html->link('<i class="dropdown-icon fe fe-user"></i> Profile', ['controller' => 'Users', 'action' => 'editMyProfile', $this->Identity->get('id') ], ['class' => 'dropdown-item', 'escape' => false]) ?>
<!--
                                    <a class="dropdown-item" href="email-inbox.html">
                                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                                        <span class="badge bg-danger rounded-pill float-end">5</span>
                                    </a>
                                    <a class="dropdown-item" href="lockscreen.html">
                                        <i class="dropdown-icon fe fe-lock"></i> Lockscreen
                                    </a>
-->
                                    <?= $this->Html->link('<i class="dropdown-icon fe fe-alert-circle"></i> Sign out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item', 'escape' => false]) ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /app-Header -->