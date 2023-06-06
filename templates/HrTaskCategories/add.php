<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrTaskCategory $hrTaskCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Hr Task Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrTaskCategories form content">
            <?= $this->Form->create($hrTaskCategory) ?>
            <fieldset>
                <legend><?= __('Add Hr Task Category') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('is_deleted');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
