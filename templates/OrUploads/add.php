<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrUpload $orUpload
 * @var \Cake\Collection\CollectionInterface|string[] $orderReqs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Or Uploads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orUploads form content">
            <?= $this->Form->create($orUpload, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Or Upload') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('filename', ['type' => 'file']);
                    echo $this->Form->control('order_req_id', ['options' => $orderReqs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
