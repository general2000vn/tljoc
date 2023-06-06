<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocCategory[]|\Cake\Collection\CollectionInterface $docCategories
 */
?>
<div class="docCategories index content">
    <?= $this->Html->link(__('New Doc Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc Categories') ?></h3>
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
                <?php foreach ($docCategories as $docCategory): ?>
                <tr>
                    <td><?= $this->Number->format($docCategory->id) ?></td>
                    <td><?= h($docCategory->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docCategory->id)]) ?>
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
