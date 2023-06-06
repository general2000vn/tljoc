<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoingsPartner $docOutgoingsPartner
 * @var string[]|\Cake\Collection\CollectionInterface $docOutgoings
 * @var string[]|\Cake\Collection\CollectionInterface $partners
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docOutgoingsPartner->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docOutgoingsPartner->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Outgoings Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docOutgoingsPartners form content">
            <?= $this->Form->create($docOutgoingsPartner) ?>
            <fieldset>
                <legend><?= __('Edit Doc Outgoings Partner') ?></legend>
                <?php
                    echo $this->Form->control('doc_outgoing_id', ['options' => $docOutgoings]);
                    echo $this->Form->control('partner_id', ['options' => $partners]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
