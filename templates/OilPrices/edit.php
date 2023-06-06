<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OilPrice $oilPrice
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $oilPrice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $oilPrice->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Oil Prices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oilPrices form content">
            <?= $this->Form->create($oilPrice) ?>
            <fieldset>
                <legend><?= __('Edit Oil Price') ?></legend>
                <?php
                    echo $this->Form->control('brent');
                    echo $this->Form->control('wti');
                    echo $this->Form->control('usd');
                    echo $this->Form->control('update_date');
                    echo $this->Form->control('update_time');
                    echo $this->Form->control('update_timestamp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
