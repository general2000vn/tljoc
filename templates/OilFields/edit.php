<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OilField $oilField
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $oilField->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $oilField->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Oil Fields'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oilFields form content">
            <?= $this->Form->create($oilField) ?>
            <fieldset>
                <legend><?= __('Edit Oil Field') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
