<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcQuestion $abcQuestion
 * @var string[]|\Cake\Collection\CollectionInterface $abcCategories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $abcQuestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $abcQuestion->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Abc Questions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcQuestions form content">
            <?= $this->Form->create($abcQuestion) ?>
            <fieldset>
                <legend><?= __('Edit Abc Question') ?></legend>
                <?php
                    echo $this->Form->control('en');
                    echo $this->Form->control('vn');
                    echo $this->Form->control('abnormal');
                    echo $this->Form->control('abc_category_id', ['options' => $abcCategories]);
                    echo $this->Form->control('abc_campaign_id');
                    echo $this->Form->control('order_code');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
