<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestAsTestB $testAsTestB
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Test As Test B'), ['action' => 'edit', $testAsTestB->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Test As Test B'), ['action' => 'delete', $testAsTestB->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testAsTestB->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Test As Test Bs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Test As Test B'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAsTestBs view content">
            <h3><?= h($testAsTestB->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Test A') ?></th>
                    <td><?= $testAsTestB->has('test_a') ? $this->Html->link($testAsTestB->test_a->name, ['controller' => 'TestAs', 'action' => 'view', $testAsTestB->test_a->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Test B') ?></th>
                    <td><?= $testAsTestB->has('test_b') ? $this->Html->link($testAsTestB->test_b->name, ['controller' => 'TestBs', 'action' => 'view', $testAsTestB->test_b->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($testAsTestB->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
