<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcForm $abcForm
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Abc Forms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcForms form content">
            <?= $this->Form->create($abcForm) ?>
            <fieldset>
                <legend><?= __('Add Abc Form') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('abc_canpaign_id');
                    echo $this->Form->control('is_abnormal');
                    echo $this->Form->control('is_vn');
                    echo $this->Form->control('abc_status_id', ['options' => $abcStatuses]);
                    echo $this->Form->control('justification');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
