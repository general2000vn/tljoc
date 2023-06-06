<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInternalType $docInternalType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Internal Type'), ['action' => 'edit', $docInternalType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Internal Type'), ['action' => 'delete', $docInternalType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInternalType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Internal Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Internal Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInternalTypes view content">
            <h3><?= h($docInternalType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($docInternalType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docInternalType->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Doc Internals') ?></h4>
                <?php if (!empty($docInternalType->doc_internals)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reg Date') ?></th>
                            <th><?= __('Doc Internal Type Id') ?></th>
                            <th><?= __('Doc Status Id') ?></th>
                            <th><?= __('Doc Company Id') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Reg Text') ?></th>
                            <th><?= __('Reg Num') ?></th>
                            <th><?= __('Issued Date') ?></th>
                            <th><?= __('Originator Id') ?></th>
                            <th><?= __('Inputter Id') ?></th>
                            <th><?= __('Modifier Id') ?></th>
                            <th><?= __('Doc File') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($docInternalType->doc_internals as $docInternals) : ?>
                        <tr>
                            <td><?= h($docInternals->id) ?></td>
                            <td><?= h($docInternals->reg_date) ?></td>
                            <td><?= h($docInternals->doc_internal_type_id) ?></td>
                            <td><?= h($docInternals->doc_status_id) ?></td>
                            <td><?= h($docInternals->doc_company_id) ?></td>
                            <td><?= h($docInternals->department_id) ?></td>
                            <td><?= h($docInternals->reg_text) ?></td>
                            <td><?= h($docInternals->reg_num) ?></td>
                            <td><?= h($docInternals->issued_date) ?></td>
                            <td><?= h($docInternals->originator_id) ?></td>
                            <td><?= h($docInternals->inputter_id) ?></td>
                            <td><?= h($docInternals->modifier_id) ?></td>
                            <td><?= h($docInternals->doc_file) ?></td>
                            <td><?= h($docInternals->created) ?></td>
                            <td><?= h($docInternals->modified) ?></td>
                            <td><?= h($docInternals->subject) ?></td>
                            <td><?= h($docInternals->remark) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DocInternals', 'action' => 'view', $docInternals->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DocInternals', 'action' => 'edit', $docInternals->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DocInternals', 'action' => 'delete', $docInternals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInternals->id)]) ?>
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
