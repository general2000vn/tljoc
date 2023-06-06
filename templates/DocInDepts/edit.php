<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDept $docInDept
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $docIncomings
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docInDept->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docInDept->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc In Depts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInDepts form content">
            <?= $this->Form->create($docInDept) ?>
            <fieldset>
                <legend><?= __('Edit Doc In Dept') ?></legend>
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
