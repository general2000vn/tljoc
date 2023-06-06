<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocMethod $docMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docMethod->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docMethod->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Methods'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docMethods form content">
            <?= $this->Form->create($docMethod) ?>
            <fieldset>
                <legend><?= __('Edit Doc Method') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
