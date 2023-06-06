<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcForm[]|\Cake\Collection\CollectionInterface $abcForms
 */
?>
<div class="abcForms index content">
    <?= $this->Html->link(__('New Abc Form'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Abc Forms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('abc_canpaign_id') ?></th>
                    <th><?= $this->Paginator->sort('is_abnormal') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('is_vn') ?></th>
                    <th><?= $this->Paginator->sort('abc_status_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abcForms as $abcForm): ?>
                <tr>
                    <td><?= $this->Number->format($abcForm->id) ?></td>
                    <td><?= $abcForm->has('user') ? $this->Html->link($abcForm->user->name, ['controller' => 'Users', 'action' => 'view', $abcForm->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($abcForm->abc_canpaign_id) ?></td>
                    <td><?= h($abcForm->is_abnormal) ?></td>
                    <td><?= h($abcForm->modified) ?></td>
                    <td><?= h($abcForm->is_vn) ?></td>
                    <td><?= $abcForm->has('abc_status') ? $this->Html->link($abcForm->abc_status->name, ['controller' => 'AbcStatuses', 'action' => 'view', $abcForm->abc_status->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $abcForm->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abcForm->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abcForm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcForm->id)]) ?>
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
