<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcAnswer $abcAnswer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Abc Answer'), ['action' => 'edit', $abcAnswer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Abc Answer'), ['action' => 'delete', $abcAnswer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcAnswer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Abc Answers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Abc Answer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcAnswers view content">
            <h3><?= h($abcAnswer->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Abc Form') ?></th>
                    <td><?= $abcAnswer->has('abc_form') ? $this->Html->link($abcAnswer->abc_form->id, ['controller' => 'AbcForms', 'action' => 'view', $abcAnswer->abc_form->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Abc Question') ?></th>
                    <td><?= $abcAnswer->has('abc_question') ? $this->Html->link($abcAnswer->abc_question->id, ['controller' => 'AbcQuestions', 'action' => 'view', $abcAnswer->abc_question->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($abcAnswer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Abnormal') ?></th>
                    <td><?= $this->Number->format($abcAnswer->is_abnormal) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
