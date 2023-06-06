<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt[]|\Cake\Collection\CollectionInterface $hrPts
 */

$page_heading = 'All Pre-Termination';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'HR', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->element('scripts_datatable');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

?>


<div class="row clearfix">
    <div class="col-lg-12">

        <div class="card">
            <div class="header">
                <h2><strong>All</strong> Pre-Termination</h2>
            </div>
            <div class="body">

                <?= $this->element('pt_list') ?>

            </div>
        </div>
    </div>
</div>