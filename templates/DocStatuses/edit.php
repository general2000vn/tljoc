<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocStatus $docStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docStatuses form content">
            <?= $this->Form->create($docStatus) ?>
            <fieldset>
                <legend><?= __('Edit Doc Status') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
