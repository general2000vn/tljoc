<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrStatus $orStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Or Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orStatuses form content">
            <?= $this->Form->create($orStatus) ?>
            <fieldset>
                <legend><?= __('Add Or Status') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('is_deleted');
                    echo $this->Form->control('display_order');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
