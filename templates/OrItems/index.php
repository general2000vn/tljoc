<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrItem[]|\Cake\Collection\CollectionInterface $orItems
 */
?>
<div class="orItems index content">
    <?= $this->Html->link(__('New Or Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orItems as $orItem): ?>
                <tr>
                    <td><?= $this->Number->format($orItem->id) ?></td>
                    <td><?= $this->Number->format($orItem->quantity) ?></td>
                    <td><?= $this->Number->format($orItem->price) ?></td>
                    <td><?= h($orItem->code) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orItem->id)]) ?>
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
