<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcStatus $acStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ac Status'), ['action' => 'edit', $acStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ac Status'), ['action' => 'delete', $acStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ac Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ac Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acStatuses view content">
            <h3><?= h($acStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($acStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($acStatus->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
