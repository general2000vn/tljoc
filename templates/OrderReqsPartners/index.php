<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReqsPartner[]|\Cake\Collection\CollectionInterface $orderReqsPartners
 */
?>
<div class="orderReqsPartners index content">
    <?= $this->Html->link(__('New Order Reqs Partner'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Reqs Partners') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_req_id') ?></th>
                    <th><?= $this->Paginator->sort('partner_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderReqsPartners as $orderReqsPartner): ?>
                <tr>
                    <td><?= $this->Number->format($orderReqsPartner->id) ?></td>
                    <td><?= $orderReqsPartner->has('order_req') ? $this->Html->link($orderReqsPartner->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orderReqsPartner->order_req->id]) : '' ?></td>
                    <td><?= $orderReqsPartner->has('partner') ? $this->Html->link($orderReqsPartner->partner->name, ['controller' => 'Partners', 'action' => 'view', $orderReqsPartner->partner->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderReqsPartner->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderReqsPartner->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderReqsPartner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderReqsPartner->id)]) ?>
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
