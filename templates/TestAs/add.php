<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestA $testA
 * @var \Cake\Collection\CollectionInterface|string[] $testBs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Test As'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAs form content">
            <?= $this->Form->create($testA, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Test A') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('test_bs._ids', ['options' => $testBs]);
                    echo $this->Form->control('file', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
