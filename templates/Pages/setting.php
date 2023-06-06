<?php
$page_heading = 'Setting';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->set('menuElement', "sash/left-menu-setting");

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

            

        </div>

    </div>
</div>