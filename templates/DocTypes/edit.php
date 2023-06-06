<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocType $docType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docType->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docTypes form content">
            <?= $this->Form->create($docType) ?>
            <fieldset>
                <legend><?= __('Edit Doc Type') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
