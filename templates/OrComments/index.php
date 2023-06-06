<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrComment[]|\Cake\Collection\CollectionInterface $orComments
 */
?>
<div class="orComments index content">
    <?= $this->Html->link(__('New Or Comment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Comments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('cmt_date') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('order_req_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orComments as $orComment): ?>
                <tr>
                    <td><?= $this->Number->format($orComment->id) ?></td>
                    <td><?= h($orComment->cmt_date) ?></td>
                    <td><?= $orComment->has('user') ? $this->Html->link($orComment->user->name, ['controller' => 'Users', 'action' => 'view', $orComment->user->id]) : '' ?></td>
                    <td><?= $orComment->has('order_req') ? $this->Html->link($orComment->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orComment->order_req->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orComment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orComment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orComment->id)]) ?>
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
