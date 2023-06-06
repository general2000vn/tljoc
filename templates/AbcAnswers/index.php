<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcAnswer[]|\Cake\Collection\CollectionInterface $abcAnswers
 */
?>
<div class="abcAnswers index content">
    <?= $this->Html->link(__('New Abc Answer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Abc Answers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('abc_form_id') ?></th>
                    <th><?= $this->Paginator->sort('abc_question_id') ?></th>
                    <th><?= $this->Paginator->sort('is_abnormal') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abcAnswers as $abcAnswer): ?>
                <tr>
                    <td><?= $this->Number->format($abcAnswer->id) ?></td>
                    <td><?= $abcAnswer->has('abc_form') ? $this->Html->link($abcAnswer->abc_form->id, ['controller' => 'AbcForms', 'action' => 'view', $abcAnswer->abc_form->id]) : '' ?></td>
                    <td><?= $abcAnswer->has('abc_question') ? $this->Html->link($abcAnswer->abc_question->id, ['controller' => 'AbcQuestions', 'action' => 'view', $abcAnswer->abc_question->id]) : '' ?></td>
                    <td><?= $this->Number->format($abcAnswer->is_abnormal) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $abcAnswer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $abcAnswer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $abcAnswer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcAnswer->id)]) ?>
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
