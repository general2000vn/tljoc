

<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay $dashboardPrdDay
 * @var \Cake\Collection\CollectionInterface|string[] $oilFields
 */
$page_heading = 'Add PRD Yearly Target';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('PRD Statistic', ['controller' => 'DashboardPrdDays', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

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
                <h3 class="card-title">Yearly Targets</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($dashboardPrdYear) ?>
                <div class="row">

                    <?php
                    
                    echo $this->Form->control('target_year', ['type' => 'year', 'label' => 'Year', 'required', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('cnv_target', ['label' => 'CNV Target', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('tgt_target', ['label' => 'TGT Target', 'templateVars' => ['ctnClass' => 'col-md-4']]);
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