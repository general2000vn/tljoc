<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrSupplier[]|\Cake\Collection\CollectionInterface $orSuppliers
 */
?>
<div class="orSuppliers index content">
    <?= $this->Html->link(__('New Or Supplier'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Suppliers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('contact') ?></th>
                    <th><?= $this->Paginator->sort('order_req_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orSuppliers as $orSupplier): ?>
                <tr>
                    <td><?= $this->Number->format($orSupplier->id) ?></td>
                    <td><?= h($orSupplier->name) ?></td>
                    <td><?= h($orSupplier->contact) ?></td>
                    <td><?= $orSupplier->has('order_req') ? $this->Html->link($orSupplier->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orSupplier->order_req->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orSupplier->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orSupplier->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orSupplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orSupplier->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
