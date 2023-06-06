<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="#">
            <!-- <img src="assets/images/logo.svg" width="25" alt="Aero"> -->
            <?= $this->Html->image('../assets/images/logo.svg', ['alt' => 'PMSoft', 'width' => '25']) ?>
            <span class="m-l-10">HLHVJOCs e-Office</span>
        </a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <!--  <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a>-->
                    <div class="detail">
                        <?php $curUser = $this->request->getAttribute('identity'); ?>
                        <h4><?php echo $curUser->name ?></h4>
                        <small><?= ($curUser->is_admin ? "Admin" : "") ?></small>
                    </div>
                </div>
            </li>

            <li>
                <?= $this->Html->link('<i class="zmdi zmdi-home"></i><span>Home</span>', ['controller' => 'Pages', 'action' => 'display', 'home'], ['escape' => false]) ?>
            </li>
            
            <!--
            <li>
                <?= $this->Html->link('<i class="zmdi zmdi-hc-fw"></i><span>Check-in</span>', ['controller' => 'Timesheets', 'action' => 'add'], ['escape' => false]) ?>
            </li>
            -->

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Covid-19</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Add Test Result', ['controller' => 'CovidTests', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('My Test Results', ['controller' => 'CovidTests', 'action' => 'index']) ?></li>
                </ul>
            </li>
           

            <!--
            <li><?= $this->Html->link('<i class="zmdi zmdi-hc-fw"></i><span>HSE Report</span>', ['controller' => 'Users', 'action' => 'reportVaccine'], ['escape' => false]) ?></li>

            

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>My Check-in</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Today', ['controller' => 'Timesheets', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Monthly', ['controller' => 'Timesheets', 'action' => 'myMonthly']) ?></li>
                </ul>
            </li>
           
            
             -->


            <!-- Context Menu for each Page  -->
            <?php if (isset($context_menu)) : ?>
                <?php foreach ($context_menu as $menu) : ?>
                    <li>
                        <?= $this->Html->link($menu['caption'], $menu['url']) ?>
                    </li>
                <?php endforeach ?>
            <?php endif ?>

        </ul>
    </div>
</aside>