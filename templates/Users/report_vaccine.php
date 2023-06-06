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

                                <th><?= h('Vaccine') ?></th>
                                <th><?= h('Health') ?></th>
                                <th><?= h('Covid-19 Test') ?></th>
                                <th><?= h('ID') ?></th>
                                <th><?= h('Issue Date') ?></th>
                                <th><?= h('Issuer Authority') ?></th>
                                <th><?= h('1st Vaccine') ?></th>
                                <th><?= h('Date') ?></th>
                                <th><?= h('Place') ?></th>
                                <th><?= h('2nd Vaccine') ?></th>
                                <th><?= h('Date') ?></th>
                                <th><?= h('Place') ?></th>
                                <th><?= h('3rd Vaccine') ?></th>
                                <th><?= h('Date') ?></th>
                                <th><?= h('Place') ?></th>
                                <th><?= h('4th Vaccine') ?></th>
                                <th><?= h('Date') ?></th>
                                <th><?= h('Place') ?></th>
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
                                        echo '<td>' .  h($user->vaccination->name) . '</td>';
                                        echo '<td>' .  h($user->health->name) . '</td>';
                                        echo '<td>';
                                        if (!empty($user->covid_tests)){


                                            if ($user->covid_tests[0]->is_negative){
                                                $text = $user->covid_tests[0]->test_date . ' Negative';
                                            } else {
                                                $text = $user->covid_tests[0]->test_date . ' Positive';
                                            }

                                            if (is_null($user->covid_tests[0]->result_file) || ($user->covid_tests[0]->result_file == "")){
                                                echo $text;
                                            } else {
                                                echo $this->Html->link($text, DS . CovidTestsTable::UPLOAD_DIR . $user->covid_tests[0]->result_file, ['target' => "_blank"]);
                                            }

                                            
                                            
                                        } else {
                                            echo '&nbsp';
                                            //echo count($user->covid_tests);
                                        }
                                        echo '</td>';

                                        echo '<td>' .  h($user->id_number) . '</td>';
                                        echo '<td>' .  h($user->id_date) . '</td>';
                                        echo '<td>' .  h($user->id_issuer) . '</td>';
                                        echo '<td>' .  h($user->has('vaccine1')? $user->vaccine1->name : "") . '</td>';
                                        echo '<td>' .  $user->vaccine1_date . '</td>';
                                        echo '<td>' .  h($user->vaccine1_place) . '</td>';
                                        echo '<td>' .  h($user->has('vaccine2')? $user->vaccine2->name : "") . '</td>';
                                        echo '<td>' .  $user->vaccine2_date . '</td>';
                                        echo '<td>' .  h($user->vaccine2_place) . '</td>';
                                        echo '<td>' .  h($user->has('vaccine3')? $user->vaccine3->name : "") . '</td>';
                                        echo '<td>' .  $user->vaccine3_date . '</td>';
                                        echo '<td>' .  h($user->vaccine3_place) . '</td>';
                                        echo '<td>' .  h($user->has('vaccine4')? $user->vaccine4->name : "") . '</td>';
                                        echo '<td>' .  $user->vaccine4_date . '</td>';
                                        echo '<td>' .  h($user->vaccine4_place) . '</td>';

                                        echo '<td>' .  h($user->addr_city) . '</td>';
                                        echo '<td>' .  h($user->addr_district) . '</td>';
                                        echo '<td>' .  h($user->addr_ward) . '</td>';
                                        echo '<td>' .  h($user->addr_detail) . '</td>';

                                        // echo '<td> &nbsp</td>';
                                        // echo '<td> &nbsp</td>';
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