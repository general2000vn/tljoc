<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestA $testA
 * @var string[]|\Cake\Collection\CollectionInterface $testBs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $testA->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $testA->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Test As'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAs form content">
            <?= $this->Form->create($testA) ?>
            <fieldset>
                <legend><?= __('Edit Test A') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('test_bs._ids', ['options' => $testBs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
