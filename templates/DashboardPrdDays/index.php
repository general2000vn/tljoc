<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay[]|\Cake\Collection\CollectionInterface $dashboardPrdDays
 */


$page_heading = 'PRD Dashboard Statistics';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('PRD Statistics', ['controller' => 'DashboardPrdDays', 'action' => 'index']), 'class' => ""],
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
                <h3 class="card-title">Statistics List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dashboard-prd" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                
                            <th class="border-bottom-0 text-center">Date</th>
                            <th class="border-bottom-0 text-center">CNV Oil Rate</th>
                            <th class="border-bottom-0 text-center">TGT Oil Rate</th>

                            <th class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dashboardPrdDays as $dashboardPrdDay) : ?>
                                <tr>
                                    
                                    <td><?= $dashboardPrdDay->stat_date->format('Y-m-d') ?></td>
                                    <td class="text-end"><?= $this->Number->format($dashboardPrdDay->oil_rate_cnv,['pattern' => '#,###']) ?></td>
                                    <td class="text-end"><?= $this->Number->format($dashboardPrdDay->oil_rate_tgt,['pattern' => '#,###']) ?></td>

                                    <td class="actions">
                                        
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dashboardPrdDay->id]) ?>
                                        
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