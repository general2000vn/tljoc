<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestB $testB
 * @var \Cake\Collection\CollectionInterface|string[] $testAs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Test Bs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testBs form content">
            <?= $this->Form->create($testB) ?>
            <fieldset>
                <legend><?= __('Add Test B') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('test_as._ids', ['options' => $testAs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
