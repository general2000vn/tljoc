<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocStatus $docStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Status'), ['action' => 'edit', $docStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Status'), ['action' => 'delete', $docStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docStatuses view content">
            <h3><?= h($docStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($docStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docStatus->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Doc Incomings') ?></h4>
                <?php if (!empty($docStatus->doc_incomings)) : ?>
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
                            <th><?= __('Partner Id') ?></th>
                            <th><?= __('Contract Num') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Reciving Date') ?></th>
                            <th><?= __('Doc Method Id') ?></th>
                            <th><?= __('Doc Status Id') ?></th>
                            <th><?= __('Doc Type Id') ?></th>
                            <th><?= __('Related Doc Id') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($docStatus->doc_incomings as $docIncomings) : ?>
                        <tr>
                            <td><?= h($docIncomings->id) ?></td>
                            <td><?= h($docIncomings->subject) ?></td>
                            <td><?= h($docIncomings->reg_date) ?></td>
                            <td><?= h($docIncomings->reg_num) ?></td>
                            <td><?= h($docIncomings->reg_text) ?></td>
                            <td><?= h($docIncomings->ref_text) ?></td>
                            <td><?= h($docIncomings->doc_company_id) ?></td>
                            <td><?= h($docIncomings->partner_id) ?></td>
                            <td><?= h($docIncomings->contract_num) ?></td>
                            <td><?= h($docIncomings->user_id) ?></td>
                            <td><?= h($docIncomings->reciving_date) ?></td>
                            <td><?= h($docIncomings->doc_method_id) ?></td>
                            <td><?= h($docIncomings->doc_status_id) ?></td>
                            <td><?= h($docIncomings->doc_type_id) ?></td>
                            <td><?= h($docIncomings->related_doc_id) ?></td>
                            <td><?= h($docIncomings->remark) ?></td>
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
