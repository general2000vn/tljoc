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

use App\Model\Entity\OrStatus;
use App\Model\Table\OrStatusesTable;
use App\Model\Table\OrUploadsTable;

$page_heading = 'Approve Order Requisition';

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
                <h3 class="card-title">Comment</h3>
            </div>
            <div class="card-body">
                <div>
                    <div class="row">
                        <!-- <?php
                            if ($orderReq->or_status_id == OrStatusesTable::S_ISSUED) {
                                echo $this->Form->control('budget_code', ['empty' => true, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                                echo $this->Form->control('budget_available', ['empty' => true, 'templateVars' => ['ctnClass' => 'col-md-4']]);
                                echo $this->Form->control('budget_remain', ['empty' => true,  'templateVars' => ['ctnClass' => 'col-md-4']]);
                            }
                        ?> -->

                        <?= $this->Form->control('comment', ['type' => 'textarea', 'label' => 'Comment', 'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                           
                    </div>

                    
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Approve'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                        <?= $this->Html->link('Back', ['action' => 'view', $orderReq->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>