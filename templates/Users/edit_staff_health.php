<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
//$this->layout = 'styleless';
?>

<?php
$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$page_heading = 'Edit Staff Health';

$this->set('page_heading', $page_heading);

$this->set('menuElement', 'aero/left-menu-covid');

$this->set('breadcrumbs', [
    ['caption' => 'Users', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->element('head_select2');
$this->end();

$this->start('head_scripts');
echo $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ;
$this->end();

$this->start('bottom_scripts');
echo $this->element('bottom_select2');
$this->end();

?>

<?= $this->Form->create($user, ['type' => 'file']) ?>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Staff</strong> Health</h2>
            </div>
            <div class="body">
                <div class="row clearfix">


                    <?php
                    echo $this->Form->control('user_id', ['options' => $staffs,'label' => 'Staff (*)', 'class' => 'form-control show-tick ms select2', 'required','empty' => true,'data-placeholder' => "Type to search ...", 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('health_id', ['options' => $healths, 'class' => 'form-control', 'label' => 'Health Status','required', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    ?>



                </div>

            </div>
        </div>

        <div class="card">
            <div class="header">
                <h2><strong>COVID-19 Test</strong> Result</h2>
            </div>
            <div class="body">
                <div class="row clearfix">


                    <?php
                    echo $this->Form->control('test_date', ['type' => 'date', 'class' => 'form-control', 'label' => 'Test Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo '<div class="col-md-4 form-group">';
                    echo $this->Form->radio('is_quick', [['text' => 'Quick Test', 'value' => "1"], ['text' => 'RT PRC', 'value' => "0"]], ['label' => 'Test Type', 'class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo '<div class="col-md-4 form-group">';
                    echo $this->Form->radio('is_negative', [['text' => 'Negative', 'value' => "1"], ['text' => 'Positive', 'value' => "0"]], ['class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo $this->Form->control('result_file', ['type' => 'file', 'class' => 'form-control',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    ?>

                    <div class="col-md-12 align-center">
                        <button class="btn btn-large btn-primary">Save</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->Form->end() ?>