<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq[]|\Cake\Collection\CollectionInterface $orderReqs
 */
?>

<?php
$page_heading = 'Processing ORs';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Order Requisition', ['controller' => 'order-reqs', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myDataTable');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Search by C&P User</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create(null, ['type' => 'get']) ?>
                <div class="row clearfix">

                    <?php
                    if (isset($staff_id))  {
                        echo $this->Form->control('staff_id', ['type' => 'select', 'empty' => true,'options' => $staffs, 'value' => $staff_id,'label' => 'C&P Staff',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    } else {
                        echo $this->Form->control('staff_id', ['type' => 'select', 'empty' => true,'options' => $staffs, 'label' => 'C&P Staff',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }
                    
                    ?>
                    
                </div>

                <div class="text-center"> 
                    <?= $this->Form->submit('Search', ['class' => 'btn btn-primary',  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                </div>      

                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Department ORs List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="or-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Number' ?></th>
                                <th><?= 'Submit Date' ?></th>
                                <th><?= 'Required Date' ?></th>
                                <th><?= 'Department' ?></th>
                                <th><?= 'Type' ?></th>
                                <th><?= 'Name' ?></th>
                                <th><?= 'Status' ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderReqs as $orderReq) : ?>
                                <tr>
                                    <td><?= h($orderReq->req_num) ?></td>
                                    <td><?= $orderReq->has('submit_date') ? $orderReq->submit_date->format('Y-m-d') : "" ?></td>
                                    <td><?= $orderReq->has('required_date') ? $orderReq->required_date->format('Y-m-d') : "" ?></td>
                                    <td><?= h($orderReq->department->name) ?></td>
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