<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use Cake\I18n\FrozenTime;
use App\Model\Table\CovidTestsTable;

?>

<?php
$page_heading = 'All Staff Vaccination status: ' . FrozenTime::now()->format('Y-m-d');

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'WFH Reports', 'class' => 'active'],
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

                <div class="table-responsive">
                    <table class="table js-exportable table-bordered c_table table-hover table-striped dataTable  theme-color">
                        <thead>
                            <tr>
                                <th><?= h('Fist Name') ?></th>
                                <th><?= h('Last Name') ?></th>
                                <th><?= h('Department') ?></th>

                                <th><?= h('Email') ?></th>
                                <th><?= h('DoB') ?></th>
                                <th><?= h('Mobile') ?></th>
                                <th><?= h('ID') ?></th>
                                <th><?= h('Issue Date') ?></th>
                                <th><?= h('Issuer Authority') ?></th>
                                
                                <th><?= h('Addr City') ?></th>
                                <th><?= h('Addr District') ?></th>
                                <th><?= h('Addr Ward') ?></th>
                                <th><?= h('Addr Detail') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($users as $user) {

                                        echo '<tr>';
                                        echo '<td>' . $this->Html->link($user->firstname, ['controller' => 'Users', 'action' => 'view', $user->id]) . '</td>';
                                        echo '<td>' . $this->Html->link($user->lastname, ['controller' => 'Users', 'action' => 'view', $user->id]) . '</td>';
                                        echo '<td>' .  h($user->group->name) . '</td>';
                                        echo '<td>' .  h($user->email) . '</td>';
                                        echo '<td>' .  h($user->dob) . '</td>';
                                        echo '<td>' .  h($user->mobile) . '</td>';

                                        echo '<td>' .  h($user->id_number) . '</td>';
                                        echo '<td>' .  h($user->id_date) . '</td>';
                                        echo '<td>' .  h($user->id_issuer) . '</td>';
                                        

                                        echo '<td>' .  h($user->addr_city) . '</td>';
                                        echo '<td>' .  h($user->addr_district) . '</td>';
                                        echo '<td>' .  h($user->addr_ward) . '</td>';
                                        echo '<td>' .  h($user->addr_detail) . '</td>';


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