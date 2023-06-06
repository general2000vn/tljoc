<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdYear[]|\Cake\Collection\CollectionInterface $dashboardPrdYears
 */
?>
<?php
$page_heading = 'PRD Targets';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('PRD Statistic', ['controller' => 'DashboardPrdDays', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->element('sash/datatable/bottom_scripts');
    echo $this->Html->script('Dashboard/myPrdStatDataTable');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>


<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Production Targets List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dashboard-prd" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                
                            <th class="border-bottom-0">Year</th>
                            <th class="border-bottom-0">CNV Target</th>
                            <th class="border-bottom-0">TGT Target</th>

                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dashboardPrdYears as $dashboardPrdYear) : ?>
                                <tr>
                                    
                                    <td><?= h($dashboardPrdYear->target_year) ?></td>
                                    <td><?= $this->Number->format($dashboardPrdYear->cnv_target) ?></td>
                                    <td><?= $this->Number->format($dashboardPrdYear->tgt_target) ?></td>

                                    <td class="actions">
                                        
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dashboardPrdYear->id]) ?>
                                        
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