<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OilPrice[]|\Cake\Collection\CollectionInterface $oilPrices
 */
?>
<div class="oilPrices index content">
    <?= $this->Html->link(__('New Oil Price'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Oil Prices') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('brent') ?></th>
                    <th><?= $this->Paginator->sort('wti') ?></th>
                    <th><?= $this->Paginator->sort('usd') ?></th>
                    <th><?= $this->Paginator->sort('update_date') ?></th>
                    <th><?= $this->Paginator->sort('update_time') ?></th>
                    <th><?= $this->Paginator->sort('update_timestamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($oilPrices as $oilPrice): ?>
                <tr>
                    <td><?= $this->Number->format($oilPrice->id) ?></td>
                    <td><?= $this->Number->format($oilPrice->brent) ?></td>
                    <td><?= $this->Number->format($oilPrice->wti) ?></td>
                    <td><?= $this->Number->format($oilPrice->usd) ?></td>
                    <td><?= h($oilPrice->update_date) ?></td>
                    <td><?= h($oilPrice->update_time) ?></td>
                    <td><?= h($oilPrice->update_timestamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $oilPrice->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $oilPrice->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $oilPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $oilPrice->id)]) ?>
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
