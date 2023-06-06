<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppComment $appComment
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->loadHelper('Authentication.Identity');

?>

<?php
$page_heading = 'Edit';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'App. Comments', 'class' => 'active'],
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
                <?= $this->Form->create($appComment) ?>

                <div class="row clearfix">

                    <div class="col-md-6 form-group">
                    <?= $this->Form->label('ac_module_id', 'Module') ?>
                        <?= $this->Form->select('ac_module_id',$acModules, [ 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->control('page', [ 'class' => 'form-control']) ?>
                    </div>

                    
                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('comment_type_id', 'Type') ?>
                        <?= $this->Form->select('comment_type_id', $acTypes, ['class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('comment_result_id', 'Result') ?>
                        <?= $this->Form->select('comment_result_id',$acResults, [ 'disabled', 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                    <?= $this->Form->label('comment_status_id', 'Status') ?>
                        <?= $this->Form->select('comment_status_id',$acStatuses, [ 'disabled','class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-12 form-group">
                        <?= $this->Form->control('brief', ['label' => 'Short Description', 'placeholder' => 'will be displayed in list' , 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-12 form-group">
                        <?= $this->Form->control('description', ['label' => 'Detail', 'placeholder' => 'Please enter as much detail as posible' , 'class' => 'form-control']) ?>
                    </div>


                </div>

                <div class='align-center'>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-large btn-primary align-center']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

