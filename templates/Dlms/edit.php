<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dlm $dlm
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dlm->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dlm->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Dlms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dlms form content">
            <?= $this->Form->create($dlm) ?>
            <fieldset>
                <legend><?= __('Edit Dlm') ?></legend>
                <?php
                    echo $this->Form->control('department_id');
                    echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>