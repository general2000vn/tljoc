<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestB $testB
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Test B'), ['action' => 'edit', $testB->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Test B'), ['action' => 'delete', $testB->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testB->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Test Bs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Test B'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="testBs view content">
            <h3><?= h($testB->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($testB->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($testB->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Test As') ?></h4>
                <?php if (!empty($testB->test_as)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($testB->test_as as $testAs) : ?>
                        <tr>
                            <td><?= h($testAs->id) ?></td>
                            <td><?= h($testAs->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TestAs', 'action' => 'view', $testAs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TestAs', 'action' => 'edit', $testAs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TestAs', 'action' => 'delete', $testAs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testAs->id)]) ?>
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
