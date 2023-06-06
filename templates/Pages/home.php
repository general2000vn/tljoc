<?php
$page_heading = 'Home';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', []);

$this->set('menuElement', "sash/left-menu-home");

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo "";

$this->end();

$this->setLayout('sash_minimal');

?>


<div class="row">
    <div class="col-md-12">

        <div class="row">





            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="<?= $this->Url->build(['controller' => 'DocIncomings', 'action' => 'blank'], ['fullBase' => true]) ?>">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-folder-open text-secondary fa-3x"></i>
                            <h6 class="mt-4 mb-2">Documents Administration Sys.</h6>
                            <h2 class="mb-2  number-font">DAS</h2>
                            <p class="text-muted">Incoming, Outgoing and Internal</p>
                        </div>
                    </div>
                </a>
            </div>

            

            <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="<?= $this->Url->build(['controller' => 'AbcCampaigns', 'action' => 'blank'], ['fullBase' => true]) ?>">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-user text-primary fa-3x"></i>
                            <h6 class="mt-4 mb-2">Human Resources</h6>
                            <h2 class="mb-2 number-font">HR</h2>
                            <p class="text-muted">All HR related functions</p>
                        </div>
                    </div>
                </a>
            </div> -->

            
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'blank'], ['fullBase' => true]) ?>">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-gears text-warning fa-3x"></i>
                            <h6 class="mt-4 mb-2">Application Setting</h6>
                            <h2 class="mb-2  number-font">Setting</h2>
                            <p class="text-muted">For IT only</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="<?= $this->Url->build(['controller' => 'AppComments', 'action' => 'index'], ['fullBase' => true]) ?>">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-comment-o text-success fa-3x"></i>
                            <h6 class="mt-4 mb-2">Application Comments</h6>
                            <h2 class="mb-2 number-font">Comments</h2>
                            <p class="text-muted">Report bugs, suggestion... </p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</div>