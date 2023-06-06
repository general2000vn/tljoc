<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPStatus $hrPStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hrPStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hrPStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Hr P Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPStatuses form content">
            <?= $this->Form->create($hrPStatus) ?>
            <fieldset>
                <legend><?= __('Edit Hr P Status') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
