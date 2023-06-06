<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OilPrice $oilPrice
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Oil Price'), ['action' => 'edit', $oilPrice->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Oil Price'), ['action' => 'delete', $oilPrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $oilPrice->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Oil Prices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Oil Price'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oilPrices view content">
            <h3><?= h($oilPrice->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($oilPrice->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Brent') ?></th>
                    <td><?= $this->Number->format($oilPrice->brent) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wti') ?></th>
                    <td><?= $this->Number->format($oilPrice->wti) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usd') ?></th>
                    <td><?= $this->Number->format($oilPrice->usd) ?></td>
                </tr>
                <tr>
                    <th><?= __('Update Date') ?></th>
                    <td><?= h($oilPrice->update_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Update Time') ?></th>
                    <td><?= h($oilPrice->update_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Update Timestamp') ?></th>
                    <td><?= h($oilPrice->update_timestamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
