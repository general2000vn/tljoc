<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocInDept $docInDept
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc In Dept'), ['action' => 'edit', $docInDept->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc In Dept'), ['action' => 'delete', $docInDept->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docInDept->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc In Depts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc In Dept'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docInDepts view content">
            <h3><?= h($docInDept->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($docInDept->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Initial') ?></th>
                    <td><?= h($docInDept->initial) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docInDept->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Doc Incomings') ?></h4>
                <?php if (!empty($docInDept->doc_incomings)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Reg Date') ?></th>
                            <th><?= __('Reg Num') ?></th>
                            <th><?= __('Reg Text') ?></th>
                            <th><?= __('Ref Text') ?></th>
                            <th><?= __('Doc Company Id') ?></th>
                            <th><?= __('Doc Sec Level Id') ?></th>
                            <th><?= __('Partner Id') ?></th>
                            <th><?= __('Contract Num') ?></th>
                            <th><?= __('Inputter Id') ?></th>
                            <th><?= __('Receiving Date') ?></th>
                            <th><?= __('Doc Method Id') ?></th>
                            <th><?= __('Doc Status Id') ?></th>
                            <th><?= __('Doc Type Id') ?></th>
                            <th><?= __('Doc Outgoing Id') ?></th>
                            <th><?= __('Doc File') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th><?= __('Modifier Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($docInDept->doc_incomings as $docIncomings) : ?>
                        <tr>
                            <td><?= h($docIncomings->id) ?></td>
                            <td><?= h($docIncomings->subject) ?></td>
                            <td><?= h($docIncomings->reg_date) ?></td>
                            <td><?= h($docIncomings->reg_num) ?></td>
                            <td><?= h($docIncomings->reg_text) ?></td>
                            <td><?= h($docIncomings->ref_text) ?></td>
                            <td><?= h($docIncomings->doc_company_id) ?></td>
                            <td><?= h($docIncomings->doc_sec_level_id) ?></td>
                            <td><?= h($docIncomings->partner_id) ?></td>
                            <td><?= h($docIncomings->contract_num) ?></td>
                            <td><?= h($docIncomings->inputter_id) ?></td>
                            <td><?= h($docIncomings->receiving_date) ?></td>
                            <td><?= h($docIncomings->doc_method_id) ?></td>
                            <td><?= h($docIncomings->doc_status_id) ?></td>
                            <td><?= h($docIncomings->doc_type_id) ?></td>
                            <td><?= h($docIncomings->doc_outgoing_id) ?></td>
                            <td><?= h($docIncomings->doc_file) ?></td>
                            <td><?= h($docIncomings->remark) ?></td>
                            <td><?= h($docIncomings->modifier_id) ?></td>
                            <td><?= h($docIncomings->created) ?></td>
                            <td><?= h($docIncomings->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DocIncomings', 'action' => 'view', $docIncomings->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DocIncomings', 'action' => 'edit', $docIncomings->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DocIncomings', 'action' => 'delete', $docIncomings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docIncomings->id)]) ?>
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
