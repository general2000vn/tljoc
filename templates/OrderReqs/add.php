<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq $orderReq
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $currencies
 * @var \Cake\Collection\CollectionInterface|string[] $originators
 * @var \Cake\Collection\CollectionInterface|string[] $deliAddresses
 * @var \Cake\Collection\CollectionInterface|string[] $singleSources
 * @var \Cake\Collection\CollectionInterface|string[] $groupLeaders
 * @var \Cake\Collection\CollectionInterface|string[] $deptLeaders
 * @var \Cake\Collection\CollectionInterface|string[] $finLeaders
 * @var \Cake\Collection\CollectionInterface|string[] $orStatuses
 */

$page_heading = 'Create New Order Requisition';

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

echo $this->Html->script(['myORAdd','myNumeric']);

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

                    echo $this->Form->control('department_id', ['type' => 'text', 'value' => $curDept->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('originator_id', ['type' => 'text', 'value' => $curUser->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('name', ['label' => 'Description', 'required' => 'required', 'templateVars' => ['ctnClass' => 'col-md-12', 'lblClass' => 'required']
                                //, 'groupAttribute' => ['required' => 'required', 'test' => "ABC"]
                                ]);

                    echo $this->Form->control('doc_company_id', ['label' => 'Company', 'options' => $docCompanies,  'templateVars' => ['extra_class' => 'form-select select2', 'lblClass' => 'required', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('contract_num', ['empty' => true, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('required_date', ['empty' => true, 'label' => 'Good/Service Required Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deli_address_id', ['label' => 'Delivery Address', 'options' => $deliAddresses, 'empty' => false, 'templateVars' => ['extra_class' => 'form-select select2', 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);


                    echo $this->Form->control('budget_code', ['empty' => true, 'required','templateVars' => ['ctnClass' => 'col-md-3', 'lblClass' => 'required']]);
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
                    <div class="row" id='item_label'>
                    </div>

                    <div id='item_list'>
                    </div>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-item', 'type' => 'button', 'data-bs-toggle' => "tooltip", 'title' => "Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-item btn-secondary btn-icon']]) ?>
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
                <h3 class="card-title">Suppliers</h3>
            </div>
            <div class="card-body">
                <div>
                    <div class="row" id='supplier_label'>
                    </div>

                    <div id='supplier_list'>
                    </div>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-supplier', 'type' => 'button', 'data-bs-toggle' => "tooltip", 'title' => "Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-supplier btn-secondary btn-icon']]) ?>
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
                    <div class="row" id="upload_label">
                        <!-- <div class="col-md-6"> <?= $this->Form->label('name',  'Name', ['templateVars' => ['ctnClass' => 'col-md-6']]) ?> </div>
                        <div class="col-md-5"> <?= $this->Form->label('file',  'File', ['templateVars' => ['ctnClass' => 'col-md-5']]) ?> </div>
                        <div class="col-md-1"> <?= $this->Form->label('delete',  'Delete', ['templateVars' => ['ctnClass' => 'col-md-1']]) ?> </div> -->
                    </div>

                    <div id='upload_list'>
                    </div>

                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <?= $this->Form->button('<i class="fe fe-plus"></i>', ['id' => 'btn-add-upload', 'type' => 'button', 'data-bs-toggle' => "tooltip", 'title' => "Add more", 'escapeTitle' => false, 'templateVars' => ['extra_class' => 'btn-add-upload btn-secondary btn-icon']]) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Create'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>