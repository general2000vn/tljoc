<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrComment $orComment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Or Comment'), ['action' => 'edit', $orComment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Or Comment'), ['action' => 'delete', $orComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orComment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Or Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Or Comment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orComments view content">
            <h3><?= h($orComment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $orComment->has('user') ? $this->Html->link($orComment->user->name, ['controller' => 'Users', 'action' => 'view', $orComment->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Req') ?></th>
                    <td><?= $orComment->has('order_req') ? $this->Html->link($orComment->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orComment->order_req->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orComment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cmt Date') ?></th>
                    <td><?= h($orComment->cmt_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comment') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($orComment->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
