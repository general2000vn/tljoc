<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestAsTestB $testAsTestB
 * @var \Cake\Collection\CollectionInterface|string[] $testAs
 * @var \Cake\Collection\CollectionInterface|string[] $testBs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Test As Test Bs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAsTestBs form content">
            <?= $this->Form->create($testAsTestB) ?>
            <fieldset>
                <legend><?= __('Add Test As Test B') ?></legend>
                <?php
                    echo $this->Form->control('test_a_id', ['options' => $testAs]);
                    echo $this->Form->control('test_b_id', ['options' => $testBs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
