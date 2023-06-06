<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcResult $acResult
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ac Result'), ['action' => 'edit', $acResult->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ac Result'), ['action' => 'delete', $acResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acResult->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ac Results'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ac Result'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acResults view content">
            <h3><?= h($acResult->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($acResult->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($acResult->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
