<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestAsTestB[]|\Cake\Collection\CollectionInterface $testAsTestBs
 */
?>
<div class="testAsTestBs index content">
    <?= $this->Html->link(__('New Test As Test B'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Test As Test Bs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('test_a_id') ?></th>
                    <th><?= $this->Paginator->sort('test_b_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testAsTestBs as $testAsTestB): ?>
                <tr>
                    <td><?= $this->Number->format($testAsTestB->id) ?></td>
                    <td><?= $testAsTestB->has('test_a') ? $this->Html->link($testAsTestB->test_a->name, ['controller' => 'TestAs', 'action' => 'view', $testAsTestB->test_a->id]) : '' ?></td>
                    <td><?= $testAsTestB->has('test_b') ? $this->Html->link($testAsTestB->test_b->name, ['controller' => 'TestBs', 'action' => 'view', $testAsTestB->test_b->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $testAsTestB->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testAsTestB->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testAsTestB->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testAsTestB->id)]) ?>
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
