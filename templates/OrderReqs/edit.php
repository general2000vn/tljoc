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

use App\Model\Table\OrUploadsTable;

$page_heading = 'Edit Order Requisition';

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

echo $this->Html->script('myOREdit');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

<?= $this->Form->create($orderReq, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Order Requisition</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    echo $this->Form->control('req_num', ['label' => 'OR Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('or_status_id', ['label' => 'OR Status', 'value' => 1, 'options' => $orStatuses, 'disabled', 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('submit_date', ['disabled', 'placeholder' => '', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('cp_method_id', ['options' => $cpMethods, 'label' => 'Procurement Mode', 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);


                    echo $this->Form->control('department_id', ['type' => 'text', 'value' => $orderReq->department->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('originator_id', ['type' => 'text', 'value' => $orderReq->originator->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);


                    echo $this->Form->control('name', ['label' => 'Description', 'required', 'templateVars' => ['ctnClass' => 'col-md-12', 'lblClass' => 'required']]);

                    echo $this->Form->control('doc_company_id', ['label' => 'Company', 'options' => $docCompanies,  'templateVars' => ['extra_class' => 'form-select select2', 'lblClass' => 'required', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('contract_num', ['empty' => true, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('required_date', ['empty' => true, 'label' => 'Good/Service Required Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deli_address_id', ['label' => 'Delivery Address', 'options' => $deliAddresses, 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);


                    echo $this->Form->control('budget_code', ['empty' => true, 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('currency_id', ['options' => $currencies, 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('exch_rate', ['label' => 'Exchange Rate', 'type' => 'text', 'empty' => true, 'templateVars' => ['extra_class' => 'numeric', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('est_total', ['label' => 'Cost Estimation',  'type' => 'text', 'empty' => true, 'templateVars' => ['extra_class' => 'numeric', 'ctnClass' => 'col-md-3']]);
                    ?>

                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Description of work or materials with part numbers</h3>
            </div>
            <div class="card-body">
                <div>
                    <?php if (count($orderReq->or_items) > 0) : ?>
                        <div class="row" id='item_label'>
                            <div class="col-md-2"> <?= $this->Form->label('',  'Item Code', ['templateVars' => ['ctnClass' => 'col-md-2']]) ?> </div>
                            <div class="col-md-5"> <?= $this->Form->label('',  'Item Name', ['templateVars' => ['ctnClass' => 'col-md-5', 'lblClass' => 'required']]) ?> </div>
                            <div class="col-md-2"> <?= $this->Form->label('',  'Quantity', ['templateVars' => ['ctnClass' => 'col-md-2', 'lblClass' => 'required']]) ?> </div>
                            <div class="col-md-3"> <?= $this->Form->label('',  'Est. Price', ['templateVars' => ['ctnClass' => 'col-md-3']]) ?> </div>
                        </div>
                        <div id='item_list'>
                            <?php for ($i = 0; $i < count($orderReq->or_items); $i++) {
                                echo '<div class="row" id="item-' . $i . '-">';

                                echo $this->Form->control('or_items.' . $i . '.code', ['label' => false, 'templateVars' => ['extra_class' => 'item_code', 'ctnClass' => 'col-md-2']]);
                                echo $this->Form->control('or_items.' . $i . '.name', ['label' => false, 'rows' => 3, 'class' => 'form-control', 'templateVars' => ['extra_class' => 'item_name', 'ctnClass' => 'col-md-5']]);
                                echo $this->Form->control('or_items.' . $i . '.quantity', ['label' => false,  'templateVars' => ['extra_class' => 'item_quantity', 'ctnClass' => 'col-md-2']]);
                                echo $this->Form->control('or_items.' . $i . '.price', ['type' => 'number', 'label' => false, 'templateVars' => ['extra_class' => 'item_price numeric', 'ctnClass' => 'col-md-2']]);
                                echo '<div class="col-md-1"><button class="btn btn-remove-item btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_item-' . $i . '-" type="button"><i class="fe fe-trash"></i></button></div>';
                                echo '</div>';
                            } ?>
                        </div>
                    <?php else : ?>
                        <div class="row" id='item_label'>
                        </div>

                        <div id='item_list'>
                        </div>

                    <?php endif; ?>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-item', 'type' => 'button', 'data-bs-toggle'=>"tooltip", 'title'=>"Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-item btn-secondary btn-icon']]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('intended_use', ['class' => 'form-control', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('justification', ['class' => 'form-control', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('others', ['label' => 'Notes', 'class' => 'form-control', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    ?>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Suggested Suppliers</h3>
            </div>
            <div class="card-body">
                <div>
                    <?php if (count($orderReq->or_suppliers) > 0) : ?>
                        <div class="row" id='supplier_label'>
                            <div class="col-md-4"> <?= $this->Form->label('',  'Name', ['templateVars' => ['ctnClass' => 'col-md-4', 'lblClass' => 'required']]) ?> </div>
                            <div class="col-md-3"> <?= $this->Form->label('',  'Representative', ['templateVars' => ['ctnClass' => 'col-md-3']]) ?> </div>
                            <div class="col-md-4"> <?= $this->Form->label('',  'Contact', ['templateVars' => ['ctnClass' => 'col-md-4']]) ?> </div>
                            <div class="col-md-1"> <?= $this->Form->label('',  '', ['templateVars' => ['ctnClass' => 'col-md-1']]) ?> </div>
                        </div>
                        <div id='supplier_list'>
                            <?php for ($i = 0; $i < count($orderReq->or_suppliers); $i++) {
                                echo '<div class="row" id="supplier-' . $i . '-">';

                                echo $this->Form->control('or_suppliers.' . $i . '.name', ['label' => false, 'templateVars' => ['extra_class' => 'supplier_name', 'ctnClass' => 'col-md-4']]);
                                echo $this->Form->control('or_suppliers.' . $i . '.rep', ['label' => false,  'templateVars' => ['extra_class' => 'supplier_rep', 'ctnClass' => 'col-md-3']]);
                                echo $this->Form->control('or_suppliers.' . $i . '.contact', ['label' => false,  'templateVars' => ['extra_class' => 'supplier_contact', 'ctnClass' => 'col-md-4']]);
                                echo '<div class="col-md-1"><button class="btn btn-remove-supplier btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_supplier-' . $i . '-" type="button"><i class="fe fe-trash"></i></button></div>';
                                echo '</div>';
                            } ?>
                        </div>
                    <?php else : ?>
                        <div class="row" id='supplier_label'>
                        </div>

                        <div id='supplier_list'>
                        </div>

                    <?php endif; ?>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-supplier', 'type' => 'button', 'data-bs-toggle'=>"tooltip", 'title'=>"Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-supplier btn-secondary btn-icon']]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attachments</h3>
            </div>
            <div class="card-body">
                <div>

                    <?php if (count($orderReq->or_uploads) > 0) : ?>
                        <div class="row" id='upload_label'>
                            <div class="col-md-6"> <?= $this->Form->label('',  'Name', ['templateVars' => ['ctnClass' => 'col-md-6', 'lblClass' => 'required']]) ?> </div>
                            <div class="col-md-5"> <?= $this->Form->label('',  'File', ['templateVars' => ['ctnClass' => 'col-md-5', 'lblClass' => 'required']]) ?> </div>
                            <div class="col-md-1"> <?= $this->Form->label('',  '', ['templateVars' => ['ctnClass' => 'col-md-1']]) ?> </div>
                        </div>
                        <div id='upload_list'>
                            <?php for ($i = 0; $i < count($orderReq->or_uploads); $i++) {
                                echo '<div class="row" id="upload-' . $i . '-">';

                                echo $this->Form->control('or_uploads.' . $i . '.name', ['label' => false, 'templateVars' => ['extra_class' => 'upload_name', 'ctnClass' => 'col-md-6']]);
                                echo '<div class="col-md-5">' . $this->Html->link('Click here to download', DS . OrUploadsTable::UPLOAD_DIR . $orderReq->or_uploads[$i]->filename, ['target' => '_blank']) . '</div>';
                                echo '<div class="col-md-1"><button class="btn btn-remove-upload btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_upload-' . $i . '-" type="button"><i class="fe fe-trash"></i></button></div>';
                                echo '</div>';
                            } ?>
                        </div>
                    <?php else : ?>
                        <div class="row" id='upload_label'>
                        </div>

                        <div id='upload_list'>
                        </div>

                    <?php endif; ?>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-upload', 'type' => 'button', 'data-bs-toggle'=>"tooltip", 'title'=>"Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-upload btn-secondary btn-icon']]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>