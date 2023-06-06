<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReqsPartner $orderReqsPartner
 * @var string[]|\Cake\Collection\CollectionInterface $orderReqs
 * @var string[]|\Cake\Collection\CollectionInterface $partners
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderReqsPartner->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderReqsPartner->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Order Reqs Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderReqsPartners form content">
            <?= $this->Form->create($orderReqsPartner) ?>
            <fieldset>
                <legend><?= __('Edit Order Reqs Partner') ?></legend>
                <?php
                    echo $this->Form->control('order_req_id', ['options' => $orderReqs]);
                    echo $this->Form->control('partner_id', ['options' => $partners]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
