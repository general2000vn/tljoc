<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPTaskStatus $hrPTaskStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hrPTaskStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hrPTaskStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Hr P Task Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPTaskStatuses form content">
            <?= $this->Form->create($hrPTaskStatus) ?>
            <fieldset>
                <legend><?= __('Edit Hr P Task Status') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
