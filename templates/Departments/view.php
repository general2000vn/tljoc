<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="departments view content">
            <h3><?= h($department->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($department->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Init') ?></th>
                    <td><?= h($department->init) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Department') ?></th>
                    <td><?= $department->has('parent_department') ? $this->Html->link($department->parent_department->name, ['controller' => 'Departments', 'action' => 'view', $department->parent_department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($department->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($department->user_id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($department->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Lastname') ?></th>
                            
                            
                        </tr>
                        <?php foreach ($department->users as $users) : ?>
                        <tr>
                           
                            
                            <td><?= h($users->firstname) ?></td>
                            <td><?= h($users->lastname) ?></td>
                            
                            
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>
