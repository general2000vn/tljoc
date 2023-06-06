<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TsLocation $tsLocation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ts Location'), ['action' => 'edit', $tsLocation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ts Location'), ['action' => 'delete', $tsLocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tsLocation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ts Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ts Location'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tsLocations view content">
            <h3><?= h($tsLocation->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($tsLocation->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tsLocation->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Timesheets') ?></h4>
                <?php if (!empty($tsLocation->timesheets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('Vaccination Id') ?></th>
                            <th><?= __('Health Id') ?></th>
                            <th><?= __('Addr City') ?></th>
                            <th><?= __('Addr District') ?></th>
                            <th><?= __('Addr Ward') ?></th>
                            <th><?= __('Addr Detail') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Total Hour') ?></th>
                            <th><?= __('On Leave') ?></th>
                            <th><?= __('Ts Location Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tsLocation->timesheets as $timesheets) : ?>
                        <tr>
                            <td><?= h($timesheets->id) ?></td>
                            <td><?= h($timesheets->user_id) ?></td>
                            <td><?= h($timesheets->start_date) ?></td>
                            <td><?= h($timesheets->start_time) ?></td>
                            <td><?= h($timesheets->vaccination_id) ?></td>
                            <td><?= h($timesheets->health_id) ?></td>
                            <td><?= h($timesheets->addr_city) ?></td>
                            <td><?= h($timesheets->addr_district) ?></td>
                            <td><?= h($timesheets->addr_ward) ?></td>
                            <td><?= h($timesheets->addr_detail) ?></td>
                            <td><?= h($timesheets->remark) ?></td>
                            <td><?= h($timesheets->end_date) ?></td>
                            <td><?= h($timesheets->end_time) ?></td>
                            <td><?= h($timesheets->total_hour) ?></td>
                            <td><?= h($timesheets->on_leave) ?></td>
                            <td><?= h($timesheets->ts_location_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Timesheets', 'action' => 'view', $timesheets->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Timesheets', 'action' => 'edit', $timesheets->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Timesheets', 'action' => 'delete', $timesheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timesheets->id)]) ?>
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
