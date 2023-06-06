<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CovidTest $covidTest
 */
use App\Model\Table\CovidTestsTable;

//$this->layout = 'das';

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Test Result Detail';

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
                    echo $this->Form->control('username', ['class' => 'form-control', 'value' => $covidTest->user->name, 'disabled','label' => 'Staff', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('test_date', ['class' => 'form-control', 'disabled','label' => 'Test Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    
                    echo '<div class="col-md-4 form-group">';
                        echo $this->Form->radio('is_quick', [['text' => 'Quick Test', 'value' => "1"],['text' => 'RT PRC', 'value' => "0"]],['disabled','label' => 'Test Type','class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    echo '<div class="col-md-4 form-group">';
                        echo $this->Form->radio('is_negative', [['text' => 'Negative', 'value' => "1"],['text' => 'Positive', 'value' => "0"]],['disabled','class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]);
                    echo '</div>';

                    if (!is_null($covidTest->result_file) && ($covidTest->result_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Test Result File');
                        echo "<br>";
                        echo '<div class="form-control">';
                       
                        //echo $this->Html->link($docIncoming->doc_file, ROOT . DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file, [ 'class' => 'form-control']) ;
                        echo $this->Html->link($covidTest->result_file, DS . CovidTestsTable::UPLOAD_DIR . $covidTest->result_file, ['target' => "_blank"]);

                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                    <div class="col-md-12 align-center">
                        <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-primary btn-large']) ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->Form->end() ?>
