<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoingsPartner[]|\Cake\Collection\CollectionInterface $docOutgoingsPartners
 */
?>
<div class="docOutgoingsPartners index content">
    <?= $this->Html->link(__('New Doc Outgoings Partner'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc Outgoings Partners') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('doc_outgoing_id') ?></th>
                    <th><?= $this->Paginator->sort('partner_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docOutgoingsPartners as $docOutgoingsPartner): ?>
                <tr>
                    <td><?= $this->Number->format($docOutgoingsPartner->id) ?></td>
                    <td><?= $docOutgoingsPartner->has('doc_outgoing') ? $this->Html->link($docOutgoingsPartner->doc_outgoing->id, ['controller' => 'DocOutgoings', 'action' => 'view', $docOutgoingsPartner->doc_outgoing->id]) : '' ?></td>
                    <td><?= $docOutgoingsPartner->has('partner') ? $this->Html->link($docOutgoingsPartner->partner->name, ['controller' => 'Partners', 'action' => 'view', $docOutgoingsPartner->partner->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docOutgoingsPartner->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docOutgoingsPartner->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docOutgoingsPartner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docOutgoingsPartner->id)]) ?>
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
