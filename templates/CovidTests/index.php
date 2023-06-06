<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet[]|\Cake\Collection\CollectionInterface $timesheets
 */

use App\Model\Table\CovidTestsTable;

?>

<?php
$page_heading = 'COVID-19 Test Results List: ' . $this->Identity->get('name');

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Covid-19', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('bottom_scripts');
echo $this->Html->script('../assets/bundles/datatablescripts.bundle');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/dataTables.buttons.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.colVis.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.flash.min');
// echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.html5.min');
// echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.print.min');
echo $this->Html->script('../assets/js/pages/tables/jquery-datatable');

// echo $this->Html->script('https://code.jquery.com/jquery-3.5.1.js');
// echo $this->Html->script('https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js');
// echo $this->Html->script('https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js');
echo $this->Html->script('../newLib/jszip.min.js');
echo $this->Html->script('../newLib/pdfmake.min.js');
echo $this->Html->script('../newLib/vfs_fonts.js');
echo $this->Html->script('../newLib/buttons.html5.min.js');
echo $this->Html->script('../newLib/buttons.print.min.js');
// echo $this->Html->script('myExcelExport');
$this->end();

?>


<div class="row clearfix">
    <div class="col-lg-12">


        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-12 align-right">

                        <?= $this->Html->link('Add New', ['action' => 'add'], ['class' => 'btn btn-primary btn-large']) ?>

                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered c_table table-hover table-striped js-exportable dataTable  theme-color">
                                <thead>
                                    <tr>
                                        <th><?= h('Date') ?></th>
                                        <th><?= h('Type') ?></th>
                                        <th><?= h('Result') ?></th>
                                        <th><?= h('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($covidTests as $test) : ?>

                                        <tr>

                                            <td><?= $this->Html->link($test->test_date->format('Y-m-d'), ['action' => 'view', $test->id]) ?></td>
                                            <td><?= h($test->is_quick ? "Quick" : "RT-PCR") ?></td>
                                            <td><?php
                                                if (is_null($test->result_file)){
                                                    echo ($test->is_negative ? "Negative" : "Positive");
                                                } else {
                                                    echo $this->Html->link(($test->is_negative ? "Negative" : "Positive"), DS . CovidTestsTable::UPLOAD_DIR . $test->result_file, ['target' => '_blank']);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $this->Html->Link(__('Edit'), ['action' => 'edit', $test->id], ['class' => 'btn btn-primary btn-small']) ?>
                                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $test->id], ['confirm' => __('Are you sure you want to delete test result on date: {0}?', $test->test_date->format('Y-m-d')), 'class' => 'btn btn-primary btn-small']) ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>