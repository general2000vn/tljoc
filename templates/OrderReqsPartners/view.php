<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReqsPartner $orderReqsPartner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Reqs Partner'), ['action' => 'edit', $orderReqsPartner->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Reqs Partner'), ['action' => 'delete', $orderReqsPartner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderReqsPartner->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Reqs Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Reqs Partner'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderReqsPartners view content">
            <h3><?= h($orderReqsPartner->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order Req') ?></th>
                    <td><?= $orderReqsPartner->has('order_req') ? $this->Html->link($orderReqsPartner->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orderReqsPartner->order_req->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Partner') ?></th>
                    <td><?= $orderReqsPartner->has('partner') ? $this->Html->link($orderReqsPartner->partner->name, ['controller' => 'Partners', 'action' => 'view', $orderReqsPartner->partner->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderReqsPartner->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
