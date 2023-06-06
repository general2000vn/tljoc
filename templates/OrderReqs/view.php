<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq $orderReq
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 * @var string[]|\Cake\Collection\CollectionInterface $currencies
 * @var string[]|\Cake\Collection\CollectionInterface $originators
 * @var string[]|\Cake\Collection\CollectionInterface $deliAddresses
 * @var string[]|\Cake\Collection\CollectionInterface $singleSources
 * @var string[]|\Cake\Collection\CollectionInterface $groupLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $deptLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $finLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $orStatuses
 */

use App\Model\Entity\OrderReq;
use App\Model\Table\OrStatusesTable;
use App\Model\Table\OrUploadsTable;

$page_heading = 'View Order Requisition';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Order Requisition', ['controller' => 'order-reqs', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
//echo $this->Html->script(['../themes/sash/assets/plugins/fileuploads/js/fileupload', '../themes/sash/assets/plugins/fileuploads/js/file-upload']);

//echo $this->Html->script('myOREdit');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>



<div class="row">
    <div class="col-md-12">
        <?= $this->Form->create($orderReq) ?>
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Order Requisition</h3>
            </div>
            <div class="card-body">

                <div class="row">
                <?php
                    echo $this->Form->control('req_num', ['label' => 'OR Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('or_status_id', ['label' => 'OR Status', 'options' => $orStatuses, 'disabled', 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('submit_date', ['disabled', 'placeholder' => '', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('cp_method_id', ['options' => $cpMethods, 'label' => 'Procurement Mode', 'disabled', 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);


                    echo $this->Form->control('department_id', ['type' => 'text', 'value' => $orderReq->department->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('originator_id', ['type' => 'text', 'value' => $orderReq->originator->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);


                    echo $this->Form->control('name', ['label' => 'Description', 'required', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('doc_company_id', ['label' => 'Company', 'options' => $docCompanies, 'disabled',  'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('contract_num', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('required_date', ['empty' => true, 'label' => 'Good/Service Required Date', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deli_address_id', ['label' => 'Delivery Address', 'options' => $deliAddresses, 'disabled', 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);


                    echo $this->Form->control('budget_code', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('currency_id', ['options' => $currencies, 'empty' => false, 'disabled', 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('exch_rate', ['label' => 'Exchange Rate', 'type' => 'text', 'empty' => true, 'disabled', 'templateVars' => ['extra_class' => 'numeric', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('est_total', ['label' => 'Cost Estimation',  'type' => 'text', 'empty' => true, 'disabled', 'templateVars' => ['extra_class' => 'numeric', 'ctnClass' => 'col-md-3']]);
                    ?>
                </div>

            </div>

        </div>

        <?php if (count($orderReq->or_items) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Description of work or materials with part numbers</h3>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-2"> <?= $this->Form->label('',  'Item Code', ['templateVars' => ['ctnClass' => 'col-md-2']]) ?> </div>
                            <div class="col-md-5"> <?= $this->Form->label('',  'Item Name', ['templateVars' => ['ctnClass' => 'col-md-5']]) ?> </div>
                            <div class="col-md-2"> <?= $this->Form->label('',  'Quantity', ['templateVars' => ['ctnClass' => 'col-md-2']]) ?> </div>
                            <div class="col-md-3"> <?= $this->Form->label('',  'Est. Price', ['templateVars' => ['ctnClass' => 'col-md-3']]) ?> </div>
                        </div>
                        <div id='item_list'>
                            <?php for ($i = 0; $i < count($orderReq->or_items); $i++) {
                                echo '<div class="row" id="item-' . $i . '-">';

                                echo $this->Form->control('or_items.' . $i . '.code', ['label' => false, 'disabled', 'templateVars' => ['extra_class' => 'item_code', 'ctnClass' => 'col-md-2']]);
                                echo $this->Form->control('or_items.' . $i . '.name', ['label' => false, 'disabled', 'rows' => 3, 'class' => 'form-control', 'templateVars' => ['extra_class' => 'item_name', 'ctnClass' => 'col-md-5']]);
                                echo $this->Form->control('or_items.' . $i . '.quantity', ['label' => false, 'disabled',  'templateVars' => ['extra_class' => 'item_quantity', 'ctnClass' => 'col-md-2']]);
                                echo $this->Form->control('or_items.' . $i . '.price', ['type' => 'number', 'label' => false, 'disabled', 'templateVars' => ['extra_class' => 'item_price', 'ctnClass' => 'col-md-3']]);

                                echo '</div>';
                            } ?>
                        </div>


                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <?= $this->Form->control('intended_use', ['class' => 'form-control', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                
                    <?= $this->Form->control('justification', ['class' => 'form-control', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                
                    <?= $this->Form->control('others', ['label' => 'Notes', 'class' => 'form-control', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                </div>
            </div>
        </div>

        <?php if (count($orderReq->or_uploads) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attachments</h3>
                </div>
                <div class="card-body">
                    <div>
                        <!-- <div class="row">
                            <div class="col-md-6"> <?= $this->Form->label('name',  'Name', ['templateVars' => ['ctnClass' => 'col-md-6']]) ?> </div>
                            <div class="col-md-5"> <?= $this->Form->label('file',  'File', ['templateVars' => ['ctnClass' => 'col-md-6']]) ?> </div>
                        </div> -->
                        <div id='upload_list'>
                            <?php for ($i = 0; $i < count($orderReq->or_uploads); $i++) {
                                echo '<div class="row" id="upload-' . $i . '-">';

                                echo '<div class="col-md-1"><div class="form-group">';
                                echo $this->Html->link('<i class="fa fa-cloud-download"></i>', DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, [ 'class' => "btn btn-info btn-icon", 'data-bs-toggle'=>"tooltip", 'title'=>"Download", 'escape' => false,'target' => '_blank']);
                                echo '</div></div>';

                                echo '<div class="col-md-11"><div class="form-group">';
                                echo $this->Html->link($orderReq->or_uploads[$i]->name, DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, [ 'class' => 'form-control', 'target' => '_blank']);
                                echo '</div></div>';

                                // echo '<div class="col-md-6"><div class="form-group">';
                                // echo $this->Html->link($orderReq->or_uploads[$i]->filename, DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, ['target' => '_blank']);
                                // echo '</div></div>';

                                echo '</div>';
                            } ?>
                        </div>


                    </div>
                </div>
            </div>
        <?php endif; ?>



        <?php if (count($orderReq->or_suppliers) > 0) : ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Suggested Suppliers</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4"> <?= $this->Form->label('',  'Name', ['templateVars' => ['ctnClass' => 'col-md-4']]) ?> </div>
                        <div class="col-md-4"> <?= $this->Form->label('',  'Representative', ['templateVars' => ['ctnClass' => 'col-md-4']]) ?> </div>
                        <div class="col-md-4"> <?= $this->Form->label('',  'Contact', ['templateVars' => ['ctnClass' => 'col-md-4']]) ?> </div>
                    </div>
                    <?php foreach ($orderReq->or_suppliers as $supplier) : ?>
                        <div class="row">
                            <?= $this->Form->control('supplier.name', ['value' => $supplier->name, 'disabled', 'label' => false, 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                            <?= $this->Form->control('supplier.rep', ['value' => $supplier->rep, 'disabled', 'label' => false, 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                            <?= $this->Form->control('supplier.contact', ['value' => $supplier->contact, 'disabled', 'label' => false, 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>




    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?= $this->Form->control('group_leader.name', ['label' => 'Group Approval', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                    <?= $this->Form->control('group_approve_time', ['label' => false, 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                    <?= $this->Form->control('group_comment', ['label' => 'Comment', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?= $this->Form->control('dept_leader.name', ['label' => 'Department Approval', 'type' => 'text',  'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                    <?= $this->Form->control('dept_approve_time', ['label' => false, 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                    <?= $this->Form->control('dept_comment', ['label' => 'Comment', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                </div>
            </div>
        </div>

    </div>
    <?= $this->Form->end() ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php

                //$approve_case = [OrStatusesTable::S_GROUP_APPROVING, OrStatusesTable::S_DEPT_APPROVING];
                

                if ($this->Identity->get('id') == $orderReq->handler_id) {
                    switch ($orderReq->or_status_id) {
                        case OrStatusesTable::S_DRAFT: //Draft
                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                            echo $this->Html->link(__('Submit'), ['action' => 'submit', $orderReq->id], ['class' => 'btn btn-secondary']);
                            echo $this->Html->link(__('Edit'), ['action' => 'edit', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo $this->Form->postLink(__('Cancel Order Requisition'), ['action' => 'cancel', $orderReq->id], ['confirm' => __('Are you sure you want to Cancel this Order Requisition ?'), 'class' => 'btn btn-danger']);
                            echo "</div>";
                            echo "</div>";
                            break;
                            //case in_array($orderReq->or_status_id, $approve_case): //Submitted
                        case OrStatusesTable::S_GROUP_APPROVING:
                        case OrStatusesTable::S_DEPT_APPROVING:
                            echo $this->Form->create($orderReq, ['url' => ['controller' => 'OrderReqs', 'action' => 'approval']]);

                            echo '<div class="row">';
                            echo $this->Form->hidden('id', ['value' => $orderReq->id]);
                            echo $this->Form->control('comment', ['type' => 'textarea', 'label' => 'Comment', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                            echo '</div>';

                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Form->button(__('Disapprove'), ['name' => 'btnDisapprove', 'templateVars' => ['extra_class' => 'btn-danger']]);
                            echo $this->Form->button(__('Approve'), ['name' => 'btnApprove', 'templateVars' => ['extra_class' => 'btn-primary']]);
                            echo "</div>";
                            echo "</div>";

                            echo $this->Form->end();
                            break;

                        case OrStatusesTable::S_DISAPPROVED: //Disapproved
                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                            echo $this->Html->link(__('Revise'), ['action' => 'revise', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo "</div>";
                            echo "</div>";
                            break;
                        case OrStatusesTable::S_ISSUED: //Disapproved
                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                            echo $this->Html->link(__('Assign PIC'), ['action' => 'assign', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo "</div>";
                            echo "</div>";
                            break;
                        case OrStatusesTable::S_PROCESSING: //PIC Processing
                            echo $this->Form->create($orderReq, ['url' => ['controller' => 'OrderReqs', 'action' => 'complete']]);

                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                            echo $this->Html->link(__('Complete'), ['action' => 'complete', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo "</div>";
                            echo "</div>";

                            echo $this->Form->end();
                            break;
                        case OrStatusesTable::S_CANCELLED: //PIC Processing
                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                            echo $this->Form->postLink(__('Revise'), ['action' => 'revise', $orderReq->id], ['confirm' => __('Are you sure you want to Revise this Order Requisition ?'), 'class' => 'btn btn-info']);
                            echo "</div>";
                            echo "</div>";
                            break;
                    }
                } else if ($this->Identity->get('id') == $orderReq->originator_id) {
                    echo '<div class="row">';
                    echo '<div class="form-footer mt-2 text-center">';
                    echo $this->Html->link(__('Preview'), ['action' => 'preview', $orderReq->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                    echo $this->Form->postLink(__('Cancel Order Requisition'), ['action' => 'cancel', $orderReq->id], ['confirm' => __('Are you sure you want to Cancel this Order Requisition ?'), 'class' => 'btn btn-danger']);
                    echo "</div>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div>
</div>