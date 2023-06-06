<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Currency $currency
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $currency->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $currency->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Currencies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="currencies form content">
            <?= $this->Form->create($currency) ?>
            <fieldset>
                <legend><?= __('Edit Currency') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('is_deleted');
                    echo $this->Form->control('display_order');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
