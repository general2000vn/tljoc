<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocStatus[]|\Cake\Collection\CollectionInterface $docStatuses
 */
?>
<div class="docStatuses index content">
    <?= $this->Html->link(__('New Doc Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc Statuses') ?></h3>
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
                <?php foreach ($docStatuses as $docStatus): ?>
                <tr>
                    <td><?= $this->Number->format($docStatus->id) ?></td>
                    <td><?= h($docStatus->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docStatus->id)]) ?>
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
