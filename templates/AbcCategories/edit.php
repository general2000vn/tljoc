<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCategory $abcCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $abcCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $abcCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Abc Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcCategories form content">
            <?= $this->Form->create($abcCategory) ?>
            <fieldset>
                <legend><?= __('Edit Abc Category') ?></legend>
                <?php
                    echo $this->Form->control('en');
                    echo $this->Form->control('vn');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
