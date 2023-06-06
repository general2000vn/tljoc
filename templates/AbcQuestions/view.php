<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcQuestion $abcQuestion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Abc Question'), ['action' => 'edit', $abcQuestion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Abc Question'), ['action' => 'delete', $abcQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcQuestion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Abc Questions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Abc Question'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcQuestions view content">
            <h3><?= h($abcQuestion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Abc Category') ?></th>
                    <td><?= $abcQuestion->has('abc_category') ? $this->Html->link($abcQuestion->abc_category->id, ['controller' => 'AbcCategories', 'action' => 'view', $abcQuestion->abc_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Code') ?></th>
                    <td><?= h($abcQuestion->order_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($abcQuestion->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Abc Campaign Id') ?></th>
                    <td><?= $this->Number->format($abcQuestion->abc_campaign_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Abnormal') ?></th>
                    <td><?= $abcQuestion->abnormal ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('En') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($abcQuestion->en)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Vn') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($abcQuestion->vn)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Abc Answers') ?></h4>
                <?php if (!empty($abcQuestion->abc_answers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Abc Form Id') ?></th>
                            <th><?= __('Abc Question Id') ?></th>
                            <th><?= __('Is Abnormal') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($abcQuestion->abc_answers as $abcAnswers) : ?>
                        <tr>
                            <td><?= h($abcAnswers->id) ?></td>
                            <td><?= h($abcAnswers->abc_form_id) ?></td>
                            <td><?= h($abcAnswers->abc_question_id) ?></td>
                            <td><?= h($abcAnswers->is_abnormal) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AbcAnswers', 'action' => 'view', $abcAnswers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AbcAnswers', 'action' => 'edit', $abcAnswers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AbcAnswers', 'action' => 'delete', $abcAnswers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcAnswers->id)]) ?>
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
