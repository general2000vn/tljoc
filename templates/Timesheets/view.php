<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet $timesheet
 */
?>

<?php
$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$page_heading = 'WFH Record Detail';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Reports', 'class' => 'active'],
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


                    <div class="col-sm-12 form-group">
                        <?= $this->Form->control('user.name', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('start_date', ['disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('start_time', ['disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->radio('on_leave', [['text' => 'On Leave', 'value' => "1"],['text' => 'Working', 'value' => "0"]],['disabled','class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('vaccination.name', ['label' => 'Vaccine Status','disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('health.name', ['label' => 'Health Status','disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('ts_location_id', 'Location') ?>
                        <?= $this->Form->select('ts_location_id', $locations, ['class' => 'form-control', 'disabled', 'empty' => true, 'place-holder' => 'must select one', 'required' => true]) ?>
                    </div>
                    <div class="col-md-8 form-group">
                        <?= $this->Form->control('addr_detail', ['label' => 'Address Detail','disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_city', ['label' => 'City','disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_district', ['label' => 'District','disabled', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('addr_ward', ['label' => 'Ward','disabled', 'class' => 'form-control']) ?>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <?= $this->Form->control('remark', ['disabled', 'class' => 'form-control']) ?>
                    </div>
                </div>

                <div class='align-center'>
                    <?= $this->Html->Link('Back', $this->request->referer() ,['class' => 'btn btn-large btn-primary align-center']) ?>
                    <!-- <?= $this->Html->Link('Back', ['controller' => 'Timesheets', 'action' => 'index'] ,['class' => 'btn btn-large btn-primary align-center']) ?> -->
                </div>
            <?= $this->Form->end() ?>    
            </div>

        </div>
    </div>
</div>