<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPTaskStatus $hrPTaskStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Hr P Task Status'), ['action' => 'edit', $hrPTaskStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Hr P Task Status'), ['action' => 'delete', $hrPTaskStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPTaskStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Hr P Task Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Hr P Task Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPTaskStatuses view content">
            <h3><?= h($hrPTaskStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($hrPTaskStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($hrPTaskStatus->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Hr Pt Tasks') ?></h4>
                <?php if (!empty($hrPTaskStatus->hr_pt_tasks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Hr P Task Status Id') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Modifier Id') ?></th>
                            <th><?= __('Hr Pt Id') ?></th>
                            <th><?= __('Reminding Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($hrPTaskStatus->hr_pt_tasks as $hrPtTasks) : ?>
                        <tr>
                            <td><?= h($hrPtTasks->id) ?></td>
                            <td><?= h($hrPtTasks->description) ?></td>
                            <td><?= h($hrPtTasks->hr_p_task_status_id) ?></td>
                            <td><?= h($hrPtTasks->modified) ?></td>
                            <td><?= h($hrPtTasks->modifier_id) ?></td>
                            <td><?= h($hrPtTasks->hr_pt_id) ?></td>
                            <td><?= h($hrPtTasks->reminding_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'HrPtTasks', 'action' => 'view', $hrPtTasks->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'HrPtTasks', 'action' => 'edit', $hrPtTasks->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'HrPtTasks', 'action' => 'delete', $hrPtTasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPtTasks->id)]) ?>
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
