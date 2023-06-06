<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdYear $dashboardPrdYear
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dashboard Prd Year'), ['action' => 'edit', $dashboardPrdYear->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dashboard Prd Year'), ['action' => 'delete', $dashboardPrdYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardPrdYear->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dashboard Prd Years'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dashboard Prd Year'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dashboardPrdYears view content">
            <h3><?= h($dashboardPrdYear->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($dashboardPrdYear->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dashboardPrdYear->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cnv Target') ?></th>
                    <td><?= $this->Number->format($dashboardPrdYear->cnv_target) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tgt Target') ?></th>
                    <td><?= $this->Number->format($dashboardPrdYear->tgt_target) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
