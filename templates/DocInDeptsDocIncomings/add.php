<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDeptsDocIncoming $docInDeptsDocIncoming
 * @var \Cake\Collection\CollectionInterface|string[] $docIncomings
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Doc In Depts Doc Incomings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInDeptsDocIncomings form content">
            <?= $this->Form->create($docInDeptsDocIncoming) ?>
            <fieldset>
                <legend><?= __('Add Doc In Depts Doc Incoming') ?></legend>
                <?php
                    echo $this->Form->control('doc_in_dept_id');
                    echo $this->Form->control('doc_incoming_id', ['options' => $docIncomings]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
