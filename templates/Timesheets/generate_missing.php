<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet[]|\Cake\Collection\CollectionInterface $timesheets
 */

use Cake\I18n\FrozenDate;

?>

<?php
$page_heading = 'Generate Missing - ' . FrozenDate::now();
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
                <?= $this->Form->create(null, ['method' => 'POST', 'url' => ['action' => 'generateMissing']]) ?>
                <div class="row clearfix">



                    <div class="col-md-4 form-group">
                        <?= $this->Form->date('view_date', ['type' => 'date', 'caption' => 'Date', 'class' => 'form-control', 'value' => $criteria['view_date']]) ?>
                    </div>
                    
                    <div class="col-md-4 form-group align-center">
                        <?= $this->Form->button(__('Generate'), ['class' => 'btn btn-large btn-primary']) ?>
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
                                <th><?= h('Date') ?></th>
                                <th><?= h('Time') ?></th>
                                <th><?= h('On leave') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($users as $user) {


                                if (!empty($user->timesheets)) {
                                    for ($i = 0; $i < count($user->timesheets); $i++) {
                                        echo '<tr>';
                                        echo '<td>' . $this->Html->link($user->name, ['controller' => 'Timesheets', 'action' => 'userMonthly', $user->id]) . '</td>';
                                        echo '<td>' . $this->Html->link($user->timesheets[$i]->start_date , ['controller' => 'Timesheets', 'action' => 'view', $user->timesheets[$i]->id]) . '</td>';
                                        echo '<td>' . $user->timesheets[$i]->start_time . '</td>';
                                        if ($user->timesheets[$i]->on_leave) {
                                            echo '<td>' . 'Leave' . '</td>';
                                        } else {
                                            echo '<td>' . '&nbsp' . '</td>';
                                        }
                                        
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td>' . $this->Html->link($user->name, ['controller' => 'Timesheets', 'action' => 'userMonthly', $user->id]) . '</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                   
                                    echo '</tr>';
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>