<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPStatus $hrPStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Hr P Status'), ['action' => 'edit', $hrPStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Hr P Status'), ['action' => 'delete', $hrPStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Hr P Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Hr P Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPStatuses view content">
            <h3><?= h($hrPStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($hrPStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($hrPStatus->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Hr Pts') ?></h4>
                <?php if (!empty($hrPStatus->hr_pts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Issue Date') ?></th>
                            <th><?= __('Last Date') ?></th>
                            <th><?= __('Staff Id') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Emp Type Id') ?></th>
                            <th><?= __('Group Id') ?></th>
                            <th><?= __('Supervisor Id') ?></th>
                            <th><?= __('Work Year') ?></th>
                            <th><?= __('Hr P Status Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($hrPStatus->hr_pts as $hrPts) : ?>
                        <tr>
                            <td><?= h($hrPts->id) ?></td>
                            <td><?= h($hrPts->issue_date) ?></td>
                            <td><?= h($hrPts->last_date) ?></td>
                            <td><?= h($hrPts->staff_id) ?></td>
                            <td><?= h($hrPts->position) ?></td>
                            <td><?= h($hrPts->emp_type_id) ?></td>
                            <td><?= h($hrPts->group_id) ?></td>
                            <td><?= h($hrPts->supervisor_id) ?></td>
                            <td><?= h($hrPts->work_year) ?></td>
                            <td><?= h($hrPts->hr_p_status_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'HrPts', 'action' => 'view', $hrPts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'HrPts', 'action' => 'edit', $hrPts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'HrPts', 'action' => 'delete', $hrPts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPts->id)]) ?>
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
