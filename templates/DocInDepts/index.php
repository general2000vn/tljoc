<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDept[]|\Cake\Collection\CollectionInterface $docInDepts
 */
?>
<div class="docInDepts index content">
    <?= $this->Html->link(__('New Doc In Dept'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc In Depts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('initial') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docInDepts as $docInDept): ?>
                <tr>
                    <td><?= $this->Number->format($docInDept->id) ?></td>
                    <td><?= h($docInDept->name) ?></td>
                    <td><?= h($docInDept->initial) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docInDept->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docInDept->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docInDept->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInDept->id)]) ?>
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
