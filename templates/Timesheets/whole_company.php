<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet[]|\Cake\Collection\CollectionInterface $timesheets
 */
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;
?>

<?php
$page_heading = 'HLHV Daily WFH Record: ' . $criteria['view_date'];
//$page_heading = 'Monthly: ' . $criteria['year'] . ' - ' . $criteria['month'] . ' ' . $this->Identity->get('name');

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Reports', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
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
                <?= $this->Form->create(null, ['method' => 'POST', 'url' => ['action' => 'wholeCompany']]) ?>
                <div class="row clearfix">



                    <div class="col-md-4 form-group">
                        <?= $this->Form->date('view_date', ['type' => 'date', 'caption' => 'Date', 'class' => 'form-control', 'value' => $criteria['view_date']]) ?>
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
                    <table class="table js-exportable table-bordered c_table table-hover table-striped dataTable  theme-color">
                        <thead>
                            <tr>
                                <th><?= h('Employee') ?></th>
                                <th><?= h('Department') ?></th>
                                <th><?= h('Check-in') ?></th>
                                <th><?= h('Leave') ?></th>
                                <th><?= h('Location') ?></th>
                                <th><?= h('Vaccine') ?></th>
                                <th><?= h('Health') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($timesheets as $timesheet) {
                                echo '<tr>';
                                echo '<td>' . $this->Html->link($timesheet->user->name, ['controller' => 'Timesheets', 'action' => 'userMonthly', $timesheet->user->id]) . '</td>';
                                echo '<td>' . $this->Html->link($groups[$timesheet->user->department_id], ['controller' => 'Timesheets', 'action' => 'deptDaily', $timesheet->user->department_id]) . '</td>';

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
                                        echo '<td>' .  $this->Html->link($timesheet->start_date->format('Y-m-d D') . ' ' . $timesheet->start_time, ['controller' => 'Timesheets', 'action' => 'view', $timesheet->id]) . '</td>';
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


                                echo '</tr>';        
 

                            }

                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>