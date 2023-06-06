<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestA $testA
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Test A'), ['action' => 'edit', $testA->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Test A'), ['action' => 'delete', $testA->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testA->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Test As'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Test A'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testAs view content">
            <h3><?= h($testA->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($testA->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($testA->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Test Bs') ?></h4>
                <?php if (!empty($testA->test_bs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($testA->test_bs as $testBs) : ?>
                        <tr>
                            <td><?= h($testBs->id) ?></td>
                            <td><?= h($testBs->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TestBs', 'action' => 'view', $testBs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TestBs', 'action' => 'edit', $testBs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TestBs', 'action' => 'delete', $testBs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testBs->id)]) ?>
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
