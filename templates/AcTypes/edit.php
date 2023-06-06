<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcType $acType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $acType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $acType->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ac Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acTypes form content">
            <?= $this->Form->create($acType) ?>
            <fieldset>
                <legend><?= __('Edit Ac Type') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
