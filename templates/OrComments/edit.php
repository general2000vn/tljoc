<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrComment $orComment
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $orderReqs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orComment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Or Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orComments form content">
            <?= $this->Form->create($orComment) ?>
            <fieldset>
                <legend><?= __('Edit Or Comment') ?></legend>
                <?php
                    echo $this->Form->control('comment');
                    echo $this->Form->control('cmt_date');
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('order_req_id', ['options' => $orderReqs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
