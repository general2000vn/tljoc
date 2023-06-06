<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcModule $acModule
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $acModule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $acModule->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ac Modules'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acModules form content">
            <?= $this->Form->create($acModule) ?>
            <fieldset>
                <legend><?= __('Edit Ac Module') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
