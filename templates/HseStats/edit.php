<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HseStat $hseStat
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

$page_heading = 'Edit HSE Statistics';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'HSE', 'class' => "active"],
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
            <?= $this->Form->create($hseStat) ?>
            <div class="card-header">
                <h3 class="card-title">Edit HSE Statistic</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('from_date', ['empty' => true, 'type' => 'date','label' => 'Statistic Date', 'required', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('lost_time', ['label' => 'Lost Time Injury', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('med_treat_case', ['label' => 'Medical Treatment Case', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('first_aid_case', ['templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('fire_explosion', ['label' => 'Fire / Explosion', 'required', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('near_miss', ['templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('obs_card', ['label' => 'Observation Cards', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
                    ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Update')) ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>

    </div>
</div>