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
            <?= $this->Html->link(__('Edit Or Item'), ['action' => 'edit', $orItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Or Item'), ['action' => 'delete', $orItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Or Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Or Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orItems view content">
            <h3><?= h($orItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($orItem->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($orItem->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($orItem->price) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Name') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($orItem->name)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
