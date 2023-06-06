<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCategory $abcCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Abc Category'), ['action' => 'edit', $abcCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Abc Category'), ['action' => 'delete', $abcCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Abc Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Abc Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcCategories view content">
            <h3><?= h($abcCategory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('En') ?></th>
                    <td><?= h($abcCategory->en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vn') ?></th>
                    <td><?= h($abcCategory->vn) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($abcCategory->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Abc Questions') ?></h4>
                <?php if (!empty($abcCategory->abc_questions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('En') ?></th>
                            <th><?= __('Vn') ?></th>
                            <th><?= __('Abnormal') ?></th>
                            <th><?= __('Abc Category Id') ?></th>
                            <th><?= __('Order Code') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($abcCategory->abc_questions as $abcQuestions) : ?>
                        <tr>
                            <td><?= h($abcQuestions->id) ?></td>
                            <td><?= h($abcQuestions->en) ?></td>
                            <td><?= h($abcQuestions->vn) ?></td>
                            <td><?= h($abcQuestions->abnormal) ?></td>
                            <td><?= h($abcQuestions->abc_category_id) ?></td>
                            <td><?= h($abcQuestions->order_code) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AbcQuestions', 'action' => 'view', $abcQuestions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AbcQuestions', 'action' => 'edit', $abcQuestions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AbcQuestions', 'action' => 'delete', $abcQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcQuestions->id)]) ?>
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
