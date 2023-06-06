<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcModule[]|\Cake\Collection\CollectionInterface $acModules
 */
?>
<div class="acModules index content">
    <?= $this->Html->link(__('New Ac Module'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ac Modules') ?></h3>
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
                <?php foreach ($acModules as $acModule): ?>
                <tr>
                    <td><?= $this->Number->format($acModule->id) ?></td>
                    <td><?= h($acModule->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $acModule->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $acModule->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $acModule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acModule->id)]) ?>
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
