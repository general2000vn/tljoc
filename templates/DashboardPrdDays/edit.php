<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay $dashboardPrdDay
 * @var \Cake\Collection\CollectionInterface|string[] $oilFields
 */
$page_heading = 'Edit PRD Statistics';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('PRD Statistics', ['controller' => 'DashboardPrdDays', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Edit PRD Statistic</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($dashboardPrdDay) ?>
                <div class="row">

                    <?php
                    echo $this->Form->control('stat_date', ['empty' => true, 'type' => 'date','label' => 'Statistic Date', 'required', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('oil_rate_cnv', ['label' => 'CNV Oil Rate', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('oil_rate_tgt', ['label' => 'TGT Oil Rate', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Submit')) ?>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>

        </div>

    </div>
</div>