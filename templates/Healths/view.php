<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Health $health
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Health'), ['action' => 'edit', $health->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Health'), ['action' => 'delete', $health->id], ['confirm' => __('Are you sure you want to delete # {0}?', $health->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Healths'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Health'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="healths view content">
            <h3><?= h($health->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($health->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($health->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Timesheets') ?></h4>
                <?php if (!empty($health->timesheets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Total Hour') ?></th>
                            <th><?= __('Vaccination Id') ?></th>
                            <th><?= __('Health Id') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($health->timesheets as $timesheets) : ?>
                        <tr>
                            <td><?= h($timesheets->id) ?></td>
                            <td><?= h($timesheets->user_id) ?></td>
                            <td><?= h($timesheets->start_date) ?></td>
                            <td><?= h($timesheets->start_time) ?></td>
                            <td><?= h($timesheets->end_date) ?></td>
                            <td><?= h($timesheets->end_time) ?></td>
                            <td><?= h($timesheets->total_hour) ?></td>
                            <td><?= h($timesheets->vaccination_id) ?></td>
                            <td><?= h($timesheets->health_id) ?></td>
                            <td><?= h($timesheets->remark) ?></td>
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
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($health->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Mobile') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Auth Type') ?></th>
                            <th><?= __('Is Deleted') ?></th>
                            <th><?= __('Profiles Id') ?></th>
                            <th><?= __('User Dn') ?></th>
                            <th><?= __('Is Deleted Ldap') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Group Id') ?></th>
                            <th><?= __('Vaccination Id') ?></th>
                            <th><?= __('Health Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($health->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->name) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->phone) ?></td>
                            <td><?= h($users->mobile) ?></td>
                            <td><?= h($users->lastname) ?></td>
                            <td><?= h($users->firstname) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->is_active) ?></td>
                            <td><?= h($users->comment) ?></td>
                            <td><?= h($users->auth_type) ?></td>
                            <td><?= h($users->is_deleted) ?></td>
                            <td><?= h($users->profiles_id) ?></td>
                            <td><?= h($users->user_dn) ?></td>
                            <td><?= h($users->is_deleted_ldap) ?></td>
                            <td><?= h($users->picture) ?></td>
                            <td><?= h($users->group_id) ?></td>
                            <td><?= h($users->vaccination_id) ?></td>
                            <td><?= h($users->health_id) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
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
