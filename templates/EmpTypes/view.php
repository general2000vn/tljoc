<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmpType $empType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Emp Type'), ['action' => 'edit', $empType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Emp Type'), ['action' => 'delete', $empType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $empType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Emp Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Emp Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="empTypes view content">
            <h3><?= h($empType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($empType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($empType->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Hr Pts') ?></h4>
                <?php if (!empty($empType->hr_pts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Issue Date') ?></th>
                            <th><?= __('Last Date') ?></th>
                            <th><?= __('Staff Id') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Emp Type Id') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Supervisor Id') ?></th>
                            <th><?= __('Work Year') ?></th>
                            <th><?= __('Hr P Status Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($empType->hr_pts as $hrPts) : ?>
                        <tr>
                            <td><?= h($hrPts->id) ?></td>
                            <td><?= h($hrPts->issue_date) ?></td>
                            <td><?= h($hrPts->last_date) ?></td>
                            <td><?= h($hrPts->staff_id) ?></td>
                            <td><?= h($hrPts->position) ?></td>
                            <td><?= h($hrPts->emp_type_id) ?></td>
                            <td><?= h($hrPts->department_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($empType->users)) : ?>
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
                            <th><?= __('Emp Type Id') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Auth Type') ?></th>
                            <th><?= __('Is Deleted') ?></th>
                            <th><?= __('Profiles Id') ?></th>
                            <th><?= __('User Dn') ?></th>
                            <th><?= __('Is Deleted Ldap') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Group Id') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Vaccination Id') ?></th>
                            <th><?= __('Health Id') ?></th>
                            <th><?= __('Id Number') ?></th>
                            <th><?= __('Id Date') ?></th>
                            <th><?= __('Id Issuer') ?></th>
                            <th><?= __('Vaccine1 Id') ?></th>
                            <th><?= __('Vaccine1 Date') ?></th>
                            <th><?= __('Vaccine1 Place') ?></th>
                            <th><?= __('Vaccine2 Id') ?></th>
                            <th><?= __('Vaccine2 Date') ?></th>
                            <th><?= __('Vaccine2 Place') ?></th>
                            <th><?= __('Vaccine3 Id') ?></th>
                            <th><?= __('Vaccine3 Date') ?></th>
                            <th><?= __('Vaccine3 Place') ?></th>
                            <th><?= __('Addr City') ?></th>
                            <th><?= __('Addr District') ?></th>
                            <th><?= __('Addr Ward') ?></th>
                            <th><?= __('Addr Detail') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($empType->users as $users) : ?>
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
                            <td><?= h($users->emp_type_id) ?></td>
                            <td><?= h($users->is_active) ?></td>
                            <td><?= h($users->comment) ?></td>
                            <td><?= h($users->auth_type) ?></td>
                            <td><?= h($users->is_deleted) ?></td>
                            <td><?= h($users->profiles_id) ?></td>
                            <td><?= h($users->user_dn) ?></td>
                            <td><?= h($users->is_deleted_ldap) ?></td>
                            <td><?= h($users->picture) ?></td>
                            <td><?= h($users->group_id) ?></td>
                            <td><?= h($users->department_id) ?></td>
                            <td><?= h($users->vaccination_id) ?></td>
                            <td><?= h($users->health_id) ?></td>
                            <td><?= h($users->id_number) ?></td>
                            <td><?= h($users->id_date) ?></td>
                            <td><?= h($users->id_issuer) ?></td>
                            <td><?= h($users->vaccine1_id) ?></td>
                            <td><?= h($users->vaccine1_date) ?></td>
                            <td><?= h($users->vaccine1_place) ?></td>
                            <td><?= h($users->vaccine2_id) ?></td>
                            <td><?= h($users->vaccine2_date) ?></td>
                            <td><?= h($users->vaccine2_place) ?></td>
                            <td><?= h($users->vaccine3_id) ?></td>
                            <td><?= h($users->vaccine3_date) ?></td>
                            <td><?= h($users->vaccine3_place) ?></td>
                            <td><?= h($users->addr_city) ?></td>
                            <td><?= h($users->addr_district) ?></td>
                            <td><?= h($users->addr_ward) ?></td>
                            <td><?= h($users->addr_detail) ?></td>
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
