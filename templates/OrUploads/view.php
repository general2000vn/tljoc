<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrUpload $orUpload
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Or Upload'), ['action' => 'edit', $orUpload->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Or Upload'), ['action' => 'delete', $orUpload->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orUpload->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Or Uploads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Or Upload'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orUploads view content">
            <h3><?= h($orUpload->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($orUpload->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Filename') ?></th>
                    <td><?= h($orUpload->filename) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Req') ?></th>
                    <td><?= $orUpload->has('order_req') ? $this->Html->link($orUpload->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orUpload->order_req->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orUpload->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
