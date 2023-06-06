<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mark[]|\Cake\Collection\CollectionInterface $marks
 */
?>
<div class="marks index content">
    <?= $this->Html->link(__('New Mark'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Marks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('student_id') ?></th>
                    <th><?= $this->Paginator->sort('class_id') ?></th>
                    <th><?= $this->Paginator->sort('mark') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marks as $mark): ?>
                <tr>
                    <td><?= $this->Number->format($mark->id) ?></td>
                    <td><?= $mark->has('student') ? $this->Html->link($mark->student->name, ['controller' => 'Students', 'action' => 'view', $mark->student->id]) : '' ?></td>
                    <td><?= $mark->has('class') ? $this->Html->link($mark->class->name, ['controller' => 'Classes', 'action' => 'view', $mark->class->id]) : '' ?></td>
                    <td><?= $this->Number->format($mark->mark) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $mark->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mark->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mark->id)]) ?>
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
