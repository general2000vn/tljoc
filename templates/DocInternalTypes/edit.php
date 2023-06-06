<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInternalType $docInternalType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docInternalType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docInternalType->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Internal Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInternalTypes form content">
            <?= $this->Form->create($docInternalType) ?>
            <fieldset>
                <legend><?= __('Edit Doc Internal Type') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
