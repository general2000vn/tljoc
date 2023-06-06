<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCategory[]|\Cake\Collection\CollectionInterface $abcCategories
 */
?>
<div class="abcCategories index content">
    <?= $this->Html->link(__('New Abc Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Abc Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('en') ?></th>
                    <th><?= $this->Paginator->sort('vn') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abcCategories as $abcCategory): ?>
                <tr>
                    <td><?= $this->Number->format($abcCategory->id) ?></td>
                    <td><?= h($abcCategory->en) ?></td>
                    <td><?= h($abcCategory->vn) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $abcCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abcCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abcCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcCategory->id)]) ?>
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
