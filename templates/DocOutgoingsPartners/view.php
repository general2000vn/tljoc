<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoingsPartner $docOutgoingsPartner
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Outgoings Partner'), ['action' => 'edit', $docOutgoingsPartner->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Outgoings Partner'), ['action' => 'delete', $docOutgoingsPartner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docOutgoingsPartner->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Outgoings Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Outgoings Partner'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docOutgoingsPartners view content">
            <h3><?= h($docOutgoingsPartner->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Doc Outgoing') ?></th>
                    <td><?= $docOutgoingsPartner->has('doc_outgoing') ? $this->Html->link($docOutgoingsPartner->doc_outgoing->id, ['controller' => 'DocOutgoings', 'action' => 'view', $docOutgoingsPartner->doc_outgoing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Partner') ?></th>
                    <td><?= $docOutgoingsPartner->has('partner') ? $this->Html->link($docOutgoingsPartner->partner->name, ['controller' => 'Partners', 'action' => 'view', $docOutgoingsPartner->partner->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docOutgoingsPartner->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
