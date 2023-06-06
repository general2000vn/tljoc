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

<?php
$this->start('block_draft');
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-footer mt-2 text-center">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderReq->id], ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Submit'), ['action' => 'submit', $orderReq->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->end();
?>

<?php
$this->start('block_revise');
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-footer mt-2 text-center">
                <?= $this->Html->link(__('Revise'), ['action' => 'revise', $orderReq->id], ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->end();
?>

<?php
$this->start('block_complete');
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-footer mt-2 text-center">
                <?= $this->Html->link(__('Complete'), ['action' => 'complete', $orderReq->id], ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->end();
?>


<?php
$this->start('block_submit');
?>
<?= $this->Form->create($orderReq, ['url' => ['controller' => 'OrderReqs', 'action' => 'approve']]) ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <?= $this->Form->control('comment', ['type' => 'textarea', 'label' => 'Comment', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
        </div>

        <div class="form-footer mt-2 text-center">
            <?= $this->Form->button(__('Approve'), ['name' => 'btnApprove', 'templateVars' => ['extra_class' => 'btn-secondary']]) ?>
            <?= $this->Form->button(__('Approve'), ['name' => 'btnDisapprove', 'templateVars' => ['extra_class' => 'btn-danger']]) ?>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
<?php
$this->end();
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

                    echo $this->Form->control('req_num', ['label' => 'OR Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('or_type_id', ['label' => 'Type', 'disabled', 'options' => $orTypes, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('submit_date', ['disabled', 'placeholder' => '', 'templateVars' => ['ctnClass' => 'col-md-4']]);


                    echo $this->Form->control('name', ['label' => 'Description of work or materials with part numbers', 'disabled', 'required', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('or_status_id', ['label' => 'OR Status',  'options' => $orStatuses, 'disabled', 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('doc_company_id', ['label' => 'Company', 'options' => $docCompanies, 'disabled', 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('department_id', ['type' => 'text', 'value' => $curDept->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('originator_id', ['type' => 'text', 'value' => $curUser->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);


                    echo $this->Form->control('required_date', ['empty' => true, 'disabled', 'label' => 'Good/Service Required Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deli_address_id', ['label' => 'Delivery Address', 'disabled', 'options' => $deliAddresses, 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('contract_num', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);


                    echo $this->Form->control('est_total', ['label' => 'Cost Estimation',  'empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('currency_id', ['options' => $currencies, 'disabled', 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('exch_rate', ['label' => 'Exchange Rate', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('budget_code', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    //echo $this->Form->control('budget_available', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    //echo $this->Form->control('budget_remain', ['empty' => true,  'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('cp_method_id', ['options' => $cpMethods, 'label' => 'Procurement Mode', 'disabled', 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('single_source_id', ['options' => $suppliers, 'empty' => true, 'disabled', 'templateVars' => ['extra_class' => 'select2-show-search search-single form-select', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('intended_use', ['class' => 'form-control', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('justification', ['class' => 'form-control', 'disabled', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    ?>





                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Required Items</h3>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Suggested Suppliers</h3>
            </div>
            <div class="card-body">
                <!--
                <div class="row">
                    <div class="col-md-10"> <?= $this->Form->label('',  'Supplier Name', ['templateVars' => ['ctnClass' => 'col-md-5']]) ?> </div>
                </div>

                <div class="row" id="supplier-0-">
                    <?= $this->Form->control('suppliers._ids', ['options' => $suppliers, 'disabled', 'label' => false, 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]) ?>
                </div>
                -->
                <div class="row">
                    <?= $this->Form->control('suppliers._ids', ['options' => $suppliers, 'disabled', 'label' => 'Suppliers', 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]) ?>
                    <?= $this->Form->control('others', ['label' => 'Remark/Others', 'rows' => 2, 'disabled', 'class' => 'form-control', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                </div>
            </div>
        </div>


        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Attachments</h3>
            </div>
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-md-6"> <?= $this->Form->label('name',  'Name', ['templateVars' => ['ctnClass' => 'col-md-6']]) ?> </div>
                        <div class="col-md-5"> <?= $this->Form->label('file',  'File', ['templateVars' => ['ctnClass' => 'col-md-6']]) ?> </div>


                    </div>
                    <div id='upload_list'>
                        <?php for ($i = 0; $i < count($orderReq->or_uploads); $i++) {
                            echo '<div class="row" id="upload-' . $i . '-">';

                            echo '<div class="col-md-6"><div class="form-group">';
                            echo $this->Html->link($orderReq->or_uploads[$i]->name, DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, ['class' => 'form-control', 'target' => '_blank']);
                            echo '</div></div>';

                            echo '<div class="col-md-6"><div class="form-group">';
                            echo $this->Html->link($orderReq->or_uploads[$i]->filename, DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, ['target' => '_blank']);
                            echo '</div></div>';

                            echo '</div>';
                        } ?>
                    </div>


                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Approval</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <?= $this->Form->control('group_leader.name', ['label' => 'Group Approver', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('group_approve_time', ['label' => 'Date & Time', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('group_comment', ['label' => 'Comment', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <?= $this->Form->control('dept_leader.name', ['label' => 'Dept. Approver', 'type' => 'text',  'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('dept_approve_time', ['label' => 'Date & Time', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('dept_comment', ['label' => 'Comment', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <?= $this->Form->control('fin_verifier.name', ['label' => 'FIN Verifier', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('fin_approve_time', ['label' => 'Date & Time', 'type' => 'text', 'empty' => true, 'disabled' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('budget_available', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                            <?= $this->Form->control('budget_remain', ['empty' => true,  'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="card">
            <div class="card-body">
                <?php

                //$approve_case = [OrStatusesTable::S_GROUP_APPROVING, OrStatusesTable::S_DEPT_APPROVING];

                if ($this->Identity->get('id') == $orderReq->handler_id) {
                    switch ($orderReq->or_status_id) {
                        case OrStatusesTable::S_DRAFT: //Draft
                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Edit'), ['action' => 'edit', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo $this->Html->link(__('Submit'), ['action' => 'submit', $orderReq->id], ['class' => 'btn btn-secondary']);
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
                            echo $this->Html->link(__('Revise'), ['action' => 'revise', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo "</div>";
                            echo "</div>";
                            break;
                        case OrStatusesTable::S_PROCESSING: //PIC Processing
                            echo $this->Form->create($orderReq, ['url' => ['controller' => 'OrderReqs', 'action' => 'complete']]);

                            echo '<div class="row">';
                            echo '<div class="form-footer mt-2 text-center">';
                            echo $this->Html->link(__('Complete'), ['action' => 'complete', $orderReq->id], ['class' => 'btn btn-primary']);
                            echo "</div>";
                            echo "</div>";

                            echo $this->Form->end();
                            break;
                    }
                }

                ?>
            </div>
        </div>

    </div>
</div>