<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dlm $dlm
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dlm'), ['action' => 'edit', $dlm->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dlm'), ['action' => 'delete', $dlm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dlm->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dlms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dlm'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dlms view content">
            <h3><?= h($dlm->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $dlm->has('user') ? $this->Html->link($dlm->user->name, ['controller' => 'Users', 'action' => 'view', $dlm->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dlm->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department Id') ?></th>
                    <td><?= $this->Number->format($dlm->department_id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Departments') ?></h4>
                <?php if (!empty($dlm->departments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Init') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Dlm Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Is Deleted') ?></th>
                            <th><?= __('Sec Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($dlm->departments as $departments) : ?>
                        <tr>
                            <td><?= h($departments->id) ?></td>
                            <td><?= h($departments->name) ?></td>
                            <td><?= h($departments->init) ?></td>
                            <td><?= h($departments->user_id) ?></td>
                            <td><?= h($departments->dlm_id) ?></td>
                            <td><?= h($departments->parent_id) ?></td>
                            <td><?= h($departments->is_deleted) ?></td>
                            <td><?= h($departments->sec_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Departments', 'action' => 'view', $departments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Departments', 'action' => 'edit', $departments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Departments', 'action' => 'delete', $departments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departments->id)]) ?>
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
