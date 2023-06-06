<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocCompany $docCompany
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docCompany->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docCompany->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Companies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docCompanies form content">
            <?= $this->Form->create($docCompany) ?>
            <fieldset>
                <legend><?= __('Edit Doc Company') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
