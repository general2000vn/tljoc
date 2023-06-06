<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDeptsDocIncoming[]|\Cake\Collection\CollectionInterface $docInDeptsDocIncomings
 */
?>
<div class="docInDeptsDocIncomings index content">
    <?= $this->Html->link(__('New Doc In Depts Doc Incoming'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc In Depts Doc Incomings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('doc_in_dept_id') ?></th>
                    <th><?= $this->Paginator->sort('doc_incoming_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docInDeptsDocIncomings as $docInDeptsDocIncoming): ?>
                <tr>
                    <td><?= $this->Number->format($docInDeptsDocIncoming->id) ?></td>
                    <td><?= $this->Number->format($docInDeptsDocIncoming->doc_in_dept_id) ?></td>
                    <td><?= $docInDeptsDocIncoming->has('doc_incoming') ? $this->Html->link($docInDeptsDocIncoming->doc_incoming->name, ['controller' => 'DocIncomings', 'action' => 'view', $docInDeptsDocIncoming->doc_incoming->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docInDeptsDocIncoming->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docInDeptsDocIncoming->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docInDeptsDocIncoming->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInDeptsDocIncoming->id)]) ?>
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
