<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OilField $oilField
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Oil Field'), ['action' => 'edit', $oilField->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Oil Field'), ['action' => 'delete', $oilField->id], ['confirm' => __('Are you sure you want to delete # {0}?', $oilField->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Oil Fields'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Oil Field'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oilFields view content">
            <h3><?= h($oilField->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($oilField->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($oilField->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Dashboard Prd Days') ?></h4>
                <?php if (!empty($oilField->dashboard_prd_days)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Oil Rate') ?></th>
                            <th><?= __('Oil Field Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($oilField->dashboard_prd_days as $dashboardPrdDays) : ?>
                        <tr>
                            <td><?= h($dashboardPrdDays->id) ?></td>
                            <td><?= h($dashboardPrdDays->oil_rate) ?></td>
                            <td><?= h($dashboardPrdDays->oil_field_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DashboardPrdDays', 'action' => 'view', $dashboardPrdDays->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DashboardPrdDays', 'action' => 'edit', $dashboardPrdDays->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DashboardPrdDays', 'action' => 'delete', $dashboardPrdDays->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardPrdDays->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Dashboard Prd Years') ?></h4>
                <?php if (!empty($oilField->dashboard_prd_years)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Ytd') ?></th>
                            <th><?= __('Target') ?></th>
                            <th><?= __('Oil Field Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($oilField->dashboard_prd_years as $dashboardPrdYears) : ?>
                        <tr>
                            <td><?= h($dashboardPrdYears->id) ?></td>
                            <td><?= h($dashboardPrdYears->year) ?></td>
                            <td><?= h($dashboardPrdYears->ytd) ?></td>
                            <td><?= h($dashboardPrdYears->target) ?></td>
                            <td><?= h($dashboardPrdYears->oil_field_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DashboardPrdYears', 'action' => 'view', $dashboardPrdYears->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DashboardPrdYears', 'action' => 'edit', $dashboardPrdYears->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DashboardPrdYears', 'action' => 'delete', $dashboardPrdYears->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardPrdYears->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
