<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrType[]|\Cake\Collection\CollectionInterface $orTypes
 */
?>
<div class="orTypes index content">
    <?= $this->Html->link(__('New Or Type'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Types') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_deleted') ?></th>
                    <th><?= $this->Paginator->sort('display_order') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orTypes as $orType): ?>
                <tr>
                    <td><?= $this->Number->format($orType->id) ?></td>
                    <td><?= h($orType->name) ?></td>
                    <td><?= h($orType->is_deleted) ?></td>
                    <td><?= $this->Number->format($orType->display_order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orType->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orType->id)]) ?>
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
