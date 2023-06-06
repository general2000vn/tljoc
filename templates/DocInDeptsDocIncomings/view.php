<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDeptsDocIncoming $docInDeptsDocIncoming
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc In Depts Doc Incoming'), ['action' => 'edit', $docInDeptsDocIncoming->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc In Depts Doc Incoming'), ['action' => 'delete', $docInDeptsDocIncoming->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInDeptsDocIncoming->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc In Depts Doc Incomings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc In Depts Doc Incoming'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInDeptsDocIncomings view content">
            <h3><?= h($docInDeptsDocIncoming->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Doc Incoming') ?></th>
                    <td><?= $docInDeptsDocIncoming->has('doc_incoming') ? $this->Html->link($docInDeptsDocIncoming->doc_incoming->name, ['controller' => 'DocIncomings', 'action' => 'view', $docInDeptsDocIncoming->doc_incoming->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docInDeptsDocIncoming->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc In Dept Id') ?></th>
                    <td><?= $this->Number->format($docInDeptsDocIncoming->doc_in_dept_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
