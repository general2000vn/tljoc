<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq[]|\Cake\Collection\CollectionInterface $orderReqs
 */
?>

<?php
$page_heading = 'Department ORs';

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
                <h3 class="card-title">Search by Department</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create(null, ['type' => 'get']) ?>
                <div class="row clearfix">
                    
                        


                                    <?php
                                    echo $this->Form->control('date_from', [ 'type' => 'date', 'value' => $criteria['date_from'], 'label' => 'From', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                                    echo $this->Form->control('date_to', [ 'type' => 'date', 'value' => $criteria['date_to'], 'label' => 'To', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                                    
                                    echo $this->Form->control('dept_id', ['type' => 'select','options' => $departments, 'label' => 'Department', 'value' => $criteria['dept_id'], 'templateVars' => ['ctnClass' => 'col-md-6']]);

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
                                <th><?= 'Submit Date' ?></th>
                                <th><?= 'Required Date' ?></th>
                                <th><?= 'Number' ?></th>
                                <th><?= 'Originator' ?></th>
                                <th><?= 'Description' ?></th>
                                <th><?= 'Status' ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderReqs as $orderReq) : ?>
                                <tr>
                                    <td><?= $orderReq->has('submit_date') ? $orderReq->submit_date->format('Y-m-d') : "" ?></td>
                                    <td><?= $orderReq->has('required_date') ? $orderReq->required_date->format('Y-m-d') : "" ?></td>
                                    <td><?= h($orderReq->req_num) ?></td>
                                    <td><?= h($orderReq->originator->name) ?></td>
                                    <td><?= $this->Html->link($orderReq->name, ['action' => 'view', $orderReq->id]) ?></td>
                                    <td>
                                        <?= '<span class="' .$orderReq->or_status->tag . '">' . $orderReq->or_status->name . '</span>' ?>
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