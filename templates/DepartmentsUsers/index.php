<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsUser[]|\Cake\Collection\CollectionInterface $departmentsUsers
 */
?>
<div class="departmentsUsers index content">
    <?= $this->Html->link(__('New Departments User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Departments Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('department_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departmentsUsers as $departmentsUser): ?>
                <tr>
                    <td><?= $this->Number->format($departmentsUser->id) ?></td>
                    <td><?= $departmentsUser->has('user') ? $this->Html->link($departmentsUser->user->name, ['controller' => 'Users', 'action' => 'view', $departmentsUser->user->id]) : '' ?></td>
                    <td><?= $departmentsUser->has('department') ? $this->Html->link($departmentsUser->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsUser->department->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $departmentsUser->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentsUser->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsUser->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
