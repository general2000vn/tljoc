<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcModule $acModule
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ac Module'), ['action' => 'edit', $acModule->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ac Module'), ['action' => 'delete', $acModule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acModule->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ac Modules'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ac Module'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acModules view content">
            <h3><?= h($acModule->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($acModule->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($acModule->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
