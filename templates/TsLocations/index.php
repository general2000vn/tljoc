<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TsLocation[]|\Cake\Collection\CollectionInterface $tsLocations
 */
?>
<div class="tsLocations index content">
    <?= $this->Html->link(__('New Ts Location'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ts Locations') ?></h3>
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
                <?php foreach ($tsLocations as $tsLocation): ?>
                <tr>
                    <td><?= $this->Number->format($tsLocation->id) ?></td>
                    <td><?= h($tsLocation->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tsLocation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tsLocation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tsLocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tsLocation->id)]) ?>
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
