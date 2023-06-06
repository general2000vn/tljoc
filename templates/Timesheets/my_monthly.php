<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet[]|\Cake\Collection\CollectionInterface $timesheets
 */

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
?>


<?php
$page_heading = 'Monthly: ' . $criteria['year'] . ' - ' . $criteria['month'] . ' ' . $this->Identity->get('name');
//$page_heading = 'My Monthly WFH Record: ' . $criteria['year'] ;


$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'My WFH Records', 'class' => 'active'],
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

                <?= $this->Form->create() ?>
                <div class="row clearfix">
                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('year', ['type' => 'number', 'value' => $criteria['year'], 'min' => $criteria['year'] - 10, 'max' => $criteria['year'], 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group">
                        <?= $this->Form->control('month', ['type' => 'number', 'value' => $criteria['month'], 'min' => 1, 'max' => 12, 'class' => 'form-control']) ?>
                    </div>

                    <div class="col-md-4 form-group align-center">
                        <?= $this->Form->button(__('View'), ['class' => 'btn btn-large btn-primary']) ?>
                    </div>

                </div>

                <?= $this->Form->end() ?>

            </div>
        </div>

        <div class="card">
            <div class="body">
                <div class="table-responsive">


                    <table class="table table-bordered c_table table-hover table-striped js-exportable dataTable  theme-color">
                        <thead>
                            <tr>
                                <th><?= h('Check-in') ?></th>
                                <th><?= h('Leave') ?></th>
                                <th><?= h('Location') ?></th>
                                <th><?= h('Vaccine') ?></th>
                                <th><?= h('Health') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!is_null($timesheets)) : ?>
                                <?php foreach ($timesheets as $timesheet) : ?>
                                    <tr>
                                        <?php
                                        if ($timesheet->has('start_time')){
                                            $testTime = new FrozenTime($timesheet->start_time);
                                            $testDate = new FrozenDate($timesheet->start_date);
                                            if (!$testTime->isPast() && !$testDate->isPast()){
                                                echo '<td>' . h($timesheet->start_date->format('Y-m-d D')) . '</td>';
                                                echo '<td>' .  h($timesheet->on_leave ? "On leave" : "") . '</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                
                                            } else {
                                                echo '<td>' .  $this->Html->link($timesheet->start_date->format('Y-m-d D') . ' ' . $timesheet->start_time, ['controller' => 'Timesheets', 'action' => 'edit', $timesheet->id]) . '</td>';
                                                echo '<td>' .  h($timesheet->on_leave ? "On leave" : "") . '</td>';
                                                echo '<td>' .  h($timesheet->has('ts_location') ? $timesheet->ts_location->name : "") . '</td>';
                                                echo '<td>' .  h($timesheet->has('vaccination') ? $timesheet->vaccination->name : "") . '</td>';
                                                echo '<td>' .  h($timesheet->has('health') ? $timesheet->health->name : "") . '</td>';
                                            }
                                        } else {
                                            echo '<td>' .  h($timesheet->start_date->format('Y-m-d D')) . '</td>';
                                            echo '<td>' .  h($timesheet->on_leave ? "On leave" : "") . '</td>';
                                            echo '<td>&nbsp;</td>';
                                            echo '<td>&nbsp;</td>';
                                            echo '<td>&nbsp;</td>';
                                        }
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>