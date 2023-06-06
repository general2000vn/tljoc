<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrType $orType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Or Type'), ['action' => 'edit', $orType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Or Type'), ['action' => 'delete', $orType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Or Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Or Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orTypes view content">
            <h3><?= h($orType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($orType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Display Order') ?></th>
                    <td><?= $this->Number->format($orType->display_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Deleted') ?></th>
                    <td><?= $orType->is_deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
