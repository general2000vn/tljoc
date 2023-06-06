<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Currency[]|\Cake\Collection\CollectionInterface $currencies
 */
?>
<div class="currencies index content">
    <?= $this->Html->link(__('New Currency'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Currencies') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_deleted') ?></th>
                    <th><?= $this->Paginator->sort('display_order') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currencies as $currency): ?>
                <tr>
                    <td><?= $this->Number->format($currency->id) ?></td>
                    <td><?= h($currency->name) ?></td>
                    <td><?= h($currency->is_deleted) ?></td>
                    <td><?= $this->Number->format($currency->display_order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $currency->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $currency->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $currency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $currency->id)]) ?>
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
