<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CovidTest $covidTest
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */

use App\Model\Table\CovidTestsTable;

//$this->layout = 'das';

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Edit My Test Result';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'WFH Record', 'class' => 'active'],
    ['caption' => 'COVID-19 Test', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');


$this->end();

$this->start('head_scripts');
echo $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']);
$this->end();

$this->start('bottom_scripts');

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
                    echo $this->Form->radio('is_quick', [['text' => 'Quick Test', 'value' => "1"], ['text' => 'RT PRC', 'value' => "0"]], ['label' => 'Test Type', 'class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo '<div class="col-md-4 form-group">';
                    echo $this->Form->radio('is_negative', [['text' => 'Negative', 'value' => "1"], ['text' => 'Positive', 'value' => "0"]], ['class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';
                    if (!is_null($covidTest->result_file) && ($covidTest->result_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Document File');
                        echo "<br>";
                        echo '<div class="form-control">';
                        //echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $docIncoming->id], ['confirm' => __('Are you sure you want to delete the file?'), 'class' => 'btn-sm btn-danger']) ;
                        echo $this->Html->link(__('Delete'), ['action' => 'deleteFile', $covidTest->id], ['confirm' => __('Are you sure you want to delete the file?'), 'class' => 'btn-sm btn-danger']);

                        //echo $this->Html->link($docIncoming->doc_file, ROOT . DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file, [ 'class' => 'form-control']) ;
                        echo $this->Html->link($covidTest->result_file, DS . CovidTestsTable::UPLOAD_DIR . $covidTest->result_file, ['target' => "_blank"]);

                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo $this->Form->control('result_file', ['type' => 'file', 'class' => 'form-control',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }
                    ?>

                    <?= $this->Form->submit('Save', ['class' => 'btn btn-primary', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>

                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->Form->end() ?>