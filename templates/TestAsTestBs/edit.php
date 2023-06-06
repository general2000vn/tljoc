<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestAsTestB $testAsTestB
 * @var string[]|\Cake\Collection\CollectionInterface $testAs
 * @var string[]|\Cake\Collection\CollectionInterface $testBs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $testAsTestB->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $testAsTestB->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Test As Test Bs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAsTestBs form content">
            <?= $this->Form->create($testAsTestB) ?>
            <fieldset>
                <legend><?= __('Edit Test As Test B') ?></legend>
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
