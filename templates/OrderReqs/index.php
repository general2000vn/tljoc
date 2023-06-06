<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq[]|\Cake\Collection\CollectionInterface $orderReqs
 */

use App\Model\Table\OrStatusesTable;

?>

<?php
$page_heading = 'My Handling ORs';

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
//echo $this->element('sash/datatable/new_lib_bottom_scripts');
echo $this->Html->script('Sash/myDataTable');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Handling ORs List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="or-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Submit Date' ?></th>
                                <th><?= 'Required Date' ?></th>
                                <th><?= 'Number' ?></th>

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

                                    <td><?= $this->Html->link($orderReq->name, ['action' => 'view', $orderReq->id]) ?></td>
                                    <td>
                                        <!--
                                         <?php
                                        switch ($orderReq->or_status_id) {
                                            case OrStatusesTable::S_DRAFT:
                                                $tag_color = 'tag-gray';
                                                break;
                                            case OrStatusesTable::S_GROUP_APPROVING:
                                                $tag_color = 'tag-indigo';
                                                break;
                                            case OrStatusesTable::S_DEPT_APPROVING:
                                                $tag_color = 'tag-purple';
                                                break;
                                            case OrStatusesTable::S_ISSUED:
                                                $tag_color = 'tag-orange';
                                                break;
                                            case OrStatusesTable::S_PROCESSING:
                                                $tag_color = 'tag-pink';
                                                break;
                                            case OrStatusesTable::S_DISAPPROVED:
                                                $tag_color = 'tag-red';
                                                break;
                                            case OrStatusesTable::S_COMPLETED:
                                                $tag_color = 'tag-teal';
                                                break;
                                            case OrStatusesTable::S_CANCELLED:
                                                $tag_color = 'tag-gray-dark';
                                                break;

                                            default:
                                                # code...
                                                break;
                                        } ?>
                                        -->

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