<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay $dashboardPrdDay
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dashboard Prd Day'), ['action' => 'edit', $dashboardPrdDay->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dashboard Prd Day'), ['action' => 'delete', $dashboardPrdDay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardPrdDay->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dashboard Prd Days'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dashboard Prd Day'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dashboardPrdDays view content">
            <h3><?= h($dashboardPrdDay->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dashboardPrdDay->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Oil Rate Cnv') ?></th>
                    <td><?= $this->Number->format($dashboardPrdDay->oil_rate_cnv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Oil Rate Tgt') ?></th>
                    <td><?= $this->Number->format($dashboardPrdDay->oil_rate_tgt) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($dashboardPrdDay->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stat Date') ?></th>
                    <td><?= h($dashboardPrdDay->stat_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($dashboardPrdDay->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($dashboardPrdDay->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
