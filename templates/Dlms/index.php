<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dlm[]|\Cake\Collection\CollectionInterface $dlms
 */
?>
<div class="dlms index content">
    <?= $this->Html->link(__('New Dlm'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Dlms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('department_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dlms as $dlm): ?>
                <tr>
                    <td><?= $this->Number->format($dlm->id) ?></td>
                    <td><?= $this->Number->format($dlm->department_id) ?></td>
                    <td><?= $dlm->has('user') ? $this->Html->link($dlm->user->name, ['controller' => 'Users', 'action' => 'view', $dlm->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $dlm->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dlm->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dlm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dlm->id)]) ?>
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
