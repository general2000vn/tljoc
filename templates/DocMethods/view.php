<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocMethod $docMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Method'), ['action' => 'edit', $docMethod->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Method'), ['action' => 'delete', $docMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docMethod->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Methods'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Method'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docMethods view content">
            <h3><?= h($docMethod->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($docMethod->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docMethod->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Doc Incomings') ?></h4>
                <?php if (!empty($docMethod->doc_incomings)) : ?>
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
                            <th><?= __('Inputter Id') ?></th>
                            <th><?= __('Reciving Date') ?></th>
                            <th><?= __('Doc Method Id') ?></th>
                            <th><?= __('Doc Status Id') ?></th>
                            <th><?= __('Doc Type Id') ?></th>
                            <th><?= __('Related Doc Id') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th><?= __('Modifier Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($docMethod->doc_incomings as $docIncomings) : ?>
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
                            <td><?= h($docIncomings->inputter_id) ?></td>
                            <td><?= h($docIncomings->reciving_date) ?></td>
                            <td><?= h($docIncomings->doc_method_id) ?></td>
                            <td><?= h($docIncomings->doc_status_id) ?></td>
                            <td><?= h($docIncomings->doc_type_id) ?></td>
                            <td><?= h($docIncomings->related_doc_id) ?></td>
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
