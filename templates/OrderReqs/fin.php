<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq[]|\Cake\Collection\CollectionInterface $orderReqs
 */
?>

<?php
$page_heading = 'FIN Verifying ORs';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Order Requisitions', ['controller' => 'DashboardPrdDays', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');

$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Processing ORs List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dashboard-prd" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Submit Date' ?></th>
                                <th><?= 'Required Date' ?></th>
                                <th><?= 'Number' ?></th>
                                <th><?= 'Type' ?></th>
                                <th><?= 'Name' ?></th>
                                <th><?= 'Status' ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderReqs as $orderReq) : ?>
                                <tr>
                                    <td><?= $orderReq->has('submit_date')? $orderReq->submit_date->format('Y-m-d'):"" ?></td>
                                    <td><?= $orderReq->has('required_date')? $orderReq->required_date->format('Y-m-d'):"" ?></td>
                                    <td><?= h($orderReq->req_num) ?></td>
                                    <td><?= h($orderReq->or_type->name) ?></td>
                                    <td><?= $this->Html->link($orderReq->name, ['action' => 'view', $orderReq->id]) ?></td>
                                    <td><?= h($orderReq->or_status->name) ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>