<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcFormStatus $abcFormStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Abc Form Status'), ['action' => 'edit', $abcFormStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Abc Form Status'), ['action' => 'delete', $abcFormStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcFormStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Abc Form Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Abc Form Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcFormStatuses view content">
            <h3><?= h($abcFormStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($abcFormStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($abcFormStatus->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
