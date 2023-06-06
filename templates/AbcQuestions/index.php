<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcQuestion[]|\Cake\Collection\CollectionInterface $abcQuestions
 */
?>
<div class="abcQuestions index content">
    <?= $this->Html->link(__('New Abc Question'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Abc Questions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('abnormal') ?></th>
                    <th><?= $this->Paginator->sort('abc_category_id') ?></th>
                    <th><?= $this->Paginator->sort('abc_campaign_id') ?></th>
                    <th><?= $this->Paginator->sort('order_code') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abcQuestions as $abcQuestion): ?>
                <tr>
                    <td><?= $this->Number->format($abcQuestion->id) ?></td>
                    <td><?= h($abcQuestion->abnormal) ?></td>
                    <td><?= $abcQuestion->has('abc_category') ? $this->Html->link($abcQuestion->abc_category->id, ['controller' => 'AbcCategories', 'action' => 'view', $abcQuestion->abc_category->id]) : '' ?></td>
                    <td><?= $this->Number->format($abcQuestion->abc_campaign_id) ?></td>
                    <td><?= h($abcQuestion->order_code) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $abcQuestion->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abcQuestion->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abcQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcQuestion->id)]) ?>
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
