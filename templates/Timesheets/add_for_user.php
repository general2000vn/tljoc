<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet $timesheet
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->loadHelper('Authentication.Identity');

?>

<?php
$page_heading = 'Check-in WFH Record';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'My WFH Records', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    //echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
    echo $this->Html->css('../assets/plugins/select2/select2');
    
$this->end();

$this->start('bottom_scripts');
    echo $this->Html->script('../assets/plugins/select2/select2.min');
$this->end();

?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <?= $this->Form->create($timesheet) ?>

                <div class="row clearfix">

                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('start_date', [ 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('start_time', [ 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->label('ts_location_id', 'Location') ?>
                        <?= $this->Form->select('ts_location_id', $locations, [ 'class' => 'form-control show-tick ms select2']) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->label('user_id', 'User') ?>
                        <?= $this->Form->select('user_id', $users, ['class' => 'form-control show-tick ms select2', 'data-placeholder' => "Enter user name"]) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('to_date', [ 'type' => 'date', 'class' => 'form-control']) ?>
                    </div>

                    
                </div>

                <div class='align-center'>
                    <?= $this->Form->button(__('Check-in'), ['class' => 'btn btn-large btn-primary align-center']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>