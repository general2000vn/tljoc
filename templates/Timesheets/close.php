<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet $timesheet
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>

<?php
$page_heading = 'Check-out WFH Record';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'My WFH Records', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
$this->end();

$this->start('bottom_scripts');

$this->end();

?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <?= $this->Form->create($timesheet) ?>

                <div class="row clearfix">



                    <div class="col-sm-6 form-group">
                        <?= $this->Form->control('start_date', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-sm-6 form-group">
                        <?= $this->Form->control('start_time', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-sm-6 form-group">
                        <?= $this->Form->control('end_date', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-sm-6 form-group">
                        <?= $this->Form->control('end_time', ['disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('total_hour', ['type' => 'number','class' => 'form-control', 'required']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->label('vaccination_id', 'Vaccination Status') ?>
                        <?= $this->Form->select('vaccination_id', $vaccinations, ['value' => $curUser->vaccination_id ,'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->label('health_id', 'Health Status') ?>
                        <?= $this->Form->select('health_id',$healths, [ 'value' => $curUser->health_id ,'class' => 'form-control']) ?>
                    </div>
                    
                    <div class="col-12 form-group">
                        <?= $this->Form->control('remark', ['class' => 'form-control']) ?>
                    </div>
                </div>

                <div class='align-center'>
                    <?= $this->Form->button(__('Check-out'), ['class' => 'btn btn-large btn-primary align-center']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>