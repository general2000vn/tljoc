<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrUpload[]|\Cake\Collection\CollectionInterface $orUploads
 */
?>
<div class="orUploads index content">
    <?= $this->Html->link(__('New Or Upload'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Uploads') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('filename') ?></th>
                    <th><?= $this->Paginator->sort('order_req_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orUploads as $orUpload): ?>
                <tr>
                    <td><?= $this->Number->format($orUpload->id) ?></td>
                    <td><?= h($orUpload->name) ?></td>
                    <td><?= h($orUpload->filename) ?></td>
                    <td><?= $orUpload->has('order_req') ? $this->Html->link($orUpload->order_req->name, ['controller' => 'OrderReqs', 'action' => 'view', $orUpload->order_req->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orUpload->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orUpload->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'ajaxDelete', $orUpload->id . '.json'], ['confirm' => __('Are you sure you want to delete # {0}?', $orUpload->id)]) ?>
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
