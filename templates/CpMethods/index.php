<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CpMethod[]|\Cake\Collection\CollectionInterface $cpMethods
 */
?>
<div class="cpMethods index content">
    <?= $this->Html->link(__('New Cp Method'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cp Methods') ?></h3>
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
                <?php foreach ($cpMethods as $cpMethod): ?>
                <tr>
                    <td><?= $this->Number->format($cpMethod->id) ?></td>
                    <td><?= h($cpMethod->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cpMethod->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cpMethod->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cpMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cpMethod->id)]) ?>
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
