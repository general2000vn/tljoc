<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcStatus[]|\Cake\Collection\CollectionInterface $abcStatuses
 */
?>
<div class="abcStatuses index content">
    <?= $this->Html->link(__('New Abc Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Abc Statuses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abcStatuses as $abcStatus): ?>
                <tr>
                    <td><?= $this->Number->format($abcStatus->id) ?></td>
                    <td><?= h($abcStatus->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $abcStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abcStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abcStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcStatus->id)]) ?>
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
