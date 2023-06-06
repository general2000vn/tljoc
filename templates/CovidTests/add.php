<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CovidTest $covidTest
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

//$this->layout = 'das';

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Add Test Result';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'WFH Record', 'class' => 'active'],
    ['caption' => 'COVID-19 Test', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
    //echo $this->Html->css('../newLib/select2.min.css');
    //echo $this->Html->css('../assets/plugins/select2/select2');

$this->end();

$this->start('head_scripts');
echo $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ;
$this->end();

$this->start('bottom_scripts');
    //echo $this->Html->script('../newLib/select2.min.js');

    //echo $this->Html->script('select2');
$this->end();



?>


<?= $this->Form->create($covidTest, ['type' => 'file']) ?>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>COVID-19 Test</strong> Result</h2>
            </div>
            <div class="body">
                <div class="row clearfix">


                    <?php
                    echo $this->Form->control('test_date', ['class' => 'form-control', 'label' => 'Test Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    
                    echo '<div class="col-md-4 form-group">';
                        echo $this->Form->radio('is_quick', [['text' => 'Quick Test', 'value' => "1"],['text' => 'RT PRC', 'value' => "0"]],['label' => 'Test Type','class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo '<div class="col-md-4 form-group">';
                        echo $this->Form->radio('is_negative', [['text' => 'Negative', 'value' => "1"],['text' => 'Positive', 'value' => "0"]],['class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo $this->Form->control('result_file', ['type' => 'file' ,'class' => 'form-control',  'templateVars' => ['ctnClass' => 'col-md-12']]); 
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
