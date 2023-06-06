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

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('start_date', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('start_time', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('ts_location_id', 'Location') ?>
                        <?= $this->Form->select('ts_location_id', $locations, ['class' => 'form-control', 'empty' => true, 'place-holder' => 'must select one', 'required' => true]) ?>
                    </div>

                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('vaccination_id', 'Vaccination Status') ?>
                        <?= $this->Form->select('vaccination_id', $vaccinations, ['class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('health_id', 'Health Status') ?>
                        <?= $this->Form->select('health_id',$healths, [ 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-12 form-group">
                        <?= $this->Form->control('addr_detail', ['label' => 'Address Detail' , 'class' => 'form-control']) ?>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_city', ['label' => 'City' ,'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_district', ['label' => 'District', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_ward', ['label' => 'Ward', 'class' => 'form-control']) ?>
                    </div>

                    

                    
                    <div class="col-12 form-group">
                        <?= $this->Form->control('remark', ['class' => 'form-control']) ?>
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
