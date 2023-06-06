<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

use App\Model\Entity\AbcStatus;
use App\Model\Table\AbcStatusesTable;
use App\Model\Table\AbcFormStatusesTable;

$page_heading = 'Campaign Statistic';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
echo $this->Html->script(['../themes/sash/../assets/plugins/chart/Chart.bundle', 'myAbcChart']);
?>
<!-- <script>
    $(function() {
        "use strict";
        var datapie = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                data: [20, 20, 30, 5, 25],
                backgroundColor: ['#6c5ffc', '#05c3fb', '#09ad95', '#1170e4', '#e82646']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        /* Doughbut Chart*/
        var ctx6 = document.getElementById('chartPie');
        var myPieChart6 = new Chart(ctx6, {
            type: 'doughnut',
            data: datapie,
            options: optionpie
        });

        /* Pie Chart*/
        var ctx7 = document.getElementById('chartDonut');
        var myPieChart7 = new Chart(ctx7, {
            type: 'pie',
            data: datapie,
            options: optionpie
        });
    });
</script> -->
<?php
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

?>


<?= $this->Form->create($abcCampaign) ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Campaign information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('period', ['label' => 'Year', 'disabled', 'type' => 'year', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('abc_status.name', ['disabled',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Completeness</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartDonut" class="h-275"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Normality</h3>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPie" class="h-275"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">All Forms List</h3>
            </div>
            <div class="card-body">
                
            <div class="table-responsive">
                    <table id="abc-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Staff' ?></th>
                                <th><?= 'Department' ?></th>
                                
                                <th><?= 'Last Action' ?></th>
                                <th><?= 'Status' ?></th>
                                <th><?= 'Action' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abcCampaign->abc_forms as $abcForm) : ?>
                                <tr>
                                    <td><?= $abcForm->user->name ?></td>
                                    <td><?= $abcForm->user->department->name ?></td>
                                    
                                    <td><?= is_null($abcForm->last_handler) ? '' : $abcForm->last_handler->name ?></td>
                                    <td><?= $abcForm->abc_form_status->name ?></td>
                                    <td>
                                        <?php echo $this->Html->link('<i class="pe-7s-note2" data-bs-toggle="tooltip" title="View"></i>  ', ['action' => 'view', $abcForm->id], ['class' => 'text-warning', 'escape' => false]); 



                                        // if (in_array($abcForm->abc_form_status_id, [AbcFormStatusesTable::S_ACKNOWLEDGED, AbcFormStatusesTable::S_REJECTED, AbcFormStatusesTable::S_SUBMITTED])) {
                                        //     echo $this->Html->link('<i class="pe-7s-note2" data-bs-toggle="tooltip" title="View"></i>  ', ['action' => 'view', $abcForm->id], ['class' => 'text-warning', 'escape' => false]);
                                        // }
                                        
                                        // if ($abcForm->handler_id == $this->Identity->get('id')) {
                                        //     switch ($abcForm->abc_form_status_id) {
                                        //         case AbcFormStatusesTable::S_INITIATED:
                                        //             echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Fill Form"></i>  ', ['action' => 'fill', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                        //             break;

                                        //         case AbcFormStatusesTable::S_SUBMITTED:
                                        //             echo $this->Html->link('<i class="pe-7s-hammer" data-bs-toggle="tooltip" title="Acknowledge"></i>  ', ['action' => 'acknowledge', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                        //             break;
                                        //         case AbcFormStatusesTable::S_REJECTED:
                                        //             echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Re-submit Form"></i>  ', ['action' => 'edit', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                        //             break;
                                        //         case AbcFormStatusesTable::S_DRAFT:
                                        //             echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Edit Form"></i>  ', ['action' => 'edit', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                        //             break;

                                        //         default:
                                        //             # code...
                                        //             break;
                                        //     }
                                        // }
                                        
                                        ?>
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



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">


                        <?= $this->Html->link(__('Back'), ['action' => 'incomplete'], ['class' => 'btn btn-large btn-primary']) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>