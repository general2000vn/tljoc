<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrSupplier $orSupplier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Or Supplier'), ['action' => 'edit', $orSupplier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Or Supplier'), ['action' => 'delete', $orSupplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orSupplier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Or Suppliers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Or Supplier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orSuppliers view content">
            <h3><?= h($orSupplier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($orSupplier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact') ?></th>
                    <td><?= h($orSupplier->contact) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Req') ?></th>
                    <td><?= $orSupplier->has('order_req') ? $this->Html->link($orSupplier->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orSupplier->order_req->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orSupplier->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
