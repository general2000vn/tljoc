<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CpMethod $cpMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cpMethod->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cpMethod->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Cp Methods'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cpMethods form content">
            <?= $this->Form->create($cpMethod) ?>
            <fieldset>
                <legend><?= __('Edit Cp Method') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
