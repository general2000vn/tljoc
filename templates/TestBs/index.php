<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestB[]|\Cake\Collection\CollectionInterface $testBs
 */
?>
<div class="testBs index content">
    <?= $this->Html->link(__('New Test B'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Test Bs') ?></h3>
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
                <?php foreach ($testBs as $testB): ?>
                <tr>
                    <td><?= $this->Number->format($testB->id) ?></td>
                    <td><?= h($testB->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $testB->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testB->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testB->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testB->id)]) ?>
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
