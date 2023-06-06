<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocSecLevel[]|\Cake\Collection\CollectionInterface $docSecLevels
 */
?>
<div class="docSecLevels index content">
    <?= $this->Html->link(__('New Doc Sec Level'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc Sec Levels') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docSecLevels as $docSecLevel): ?>
                <tr>
                    <td><?= $this->Number->format($docSecLevel->id) ?></td>
                    <td><?= h($docSecLevel->name) ?></td>
                    <td><?= h($docSecLevel->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docSecLevel->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docSecLevel->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docSecLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docSecLevel->id)]) ?>
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
