<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsUser $departmentsUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Departments User'), ['action' => 'edit', $departmentsUser->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Departments User'), ['action' => 'delete', $departmentsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsUser->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departments Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Departments User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departmentsUsers view content">
            <h3><?= h($departmentsUser->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $departmentsUser->has('user') ? $this->Html->link($departmentsUser->user->name, ['controller' => 'Users', 'action' => 'view', $departmentsUser->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $departmentsUser->has('department') ? $this->Html->link($departmentsUser->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsUser->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($departmentsUser->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
