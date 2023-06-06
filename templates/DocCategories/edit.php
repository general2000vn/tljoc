<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocCategory $docCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docCategories form content">
            <?= $this->Form->create($docCategory) ?>
            <fieldset>
                <legend><?= __('Edit Doc Category') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
