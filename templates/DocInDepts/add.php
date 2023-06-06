<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDept $docInDept
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $docIncomings
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Doc In Depts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInDepts form content">
            <?= $this->Form->create($docInDept) ?>
            <fieldset>
                <legend><?= __('Add Doc In Dept') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('initial');
                    echo $this->Form->control('doc_incomings._ids', ['options' => $docIncomings]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
