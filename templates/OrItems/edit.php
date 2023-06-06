<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrItem $orItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Or Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orItems form content">
            <?= $this->Form->create($orItem) ?>
            <fieldset>
                <legend><?= __('Edit Or Item') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('price');
                    echo $this->Form->control('code');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
