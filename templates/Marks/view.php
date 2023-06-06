<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mark $mark
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Mark'), ['action' => 'edit', $mark->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mark'), ['action' => 'delete', $mark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mark->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Marks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mark'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="marks view content">
            <h3><?= h($mark->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Student') ?></th>
                    <td><?= $mark->has('student') ? $this->Html->link($mark->student->name, ['controller' => 'Students', 'action' => 'view', $mark->student->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Class') ?></th>
                    <td><?= $mark->has('class') ? $this->Html->link($mark->class->name, ['controller' => 'Classes', 'action' => 'view', $mark->class->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mark->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mark') ?></th>
                    <td><?= $this->Number->format($mark->mark) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
