<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReqsPartner $orderReqsPartner
 * @var \Cake\Collection\CollectionInterface|string[] $orderReqs
 * @var \Cake\Collection\CollectionInterface|string[] $partners
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Order Reqs Partners'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderReqsPartners form content">
            <?= $this->Form->create($orderReqsPartner) ?>
            <fieldset>
                <legend><?= __('Add Order Reqs Partner') ?></legend>
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
