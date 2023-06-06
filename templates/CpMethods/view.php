<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CpMethod $cpMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cp Method'), ['action' => 'edit', $cpMethod->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cp Method'), ['action' => 'delete', $cpMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cpMethod->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cp Methods'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cp Method'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cpMethods view content">
            <h3><?= h($cpMethod->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($cpMethod->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cpMethod->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Order Reqs') ?></h4>
                <?php if (!empty($cpMethod->order_reqs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Req Num') ?></th>
                            <th><?= __('Or Type Id') ?></th>
                            <th><?= __('Submit Date') ?></th>
                            <th><?= __('Doc Company Id') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Required Date') ?></th>
                            <th><?= __('Contract Num') ?></th>
                            <th><?= __('Cp Method Id') ?></th>
                            <th><?= __('Budget Code') ?></th>
                            <th><?= __('Budget Available') ?></th>
                            <th><?= __('Budget Remain') ?></th>
                            <th><?= __('Currency Id') ?></th>
                            <th><?= __('Handler Id') ?></th>
                            <th><?= __('Originator Id') ?></th>
                            <th><?= __('Intended Use') ?></th>
                            <th><?= __('Justification') ?></th>
                            <th><?= __('Deli Address Id') ?></th>
                            <th><?= __('Single Source Id') ?></th>
                            <th><?= __('Group Leader Id') ?></th>
                            <th><?= __('Group Approve Time') ?></th>
                            <th><?= __('Dept Leader Id') ?></th>
                            <th><?= __('Dept Approve Time') ?></th>
                            <th><?= __('Fin Approve Time') ?></th>
                            <th><?= __('Fin Verifier Id') ?></th>
                            <th><?= __('Or Status Id') ?></th>
                            <th><?= __('Est Total') ?></th>
                            <th><?= __('Exch Rate') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Group Comment') ?></th>
                            <th><?= __('Dept Comment') ?></th>
                            <th><?= __('Fin Comment') ?></th>
                            <th><?= __('Pic Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cpMethod->order_reqs as $orderReqs) : ?>
                        <tr>
                            <td><?= h($orderReqs->id) ?></td>
                            <td><?= h($orderReqs->name) ?></td>
                            <td><?= h($orderReqs->req_num) ?></td>
                            <td><?= h($orderReqs->or_type_id) ?></td>
                            <td><?= h($orderReqs->submit_date) ?></td>
                            <td><?= h($orderReqs->doc_company_id) ?></td>
                            <td><?= h($orderReqs->department_id) ?></td>
                            <td><?= h($orderReqs->required_date) ?></td>
                            <td><?= h($orderReqs->contract_num) ?></td>
                            <td><?= h($orderReqs->cp_method_id) ?></td>
                            <td><?= h($orderReqs->budget_code) ?></td>
                            <td><?= h($orderReqs->budget_available) ?></td>
                            <td><?= h($orderReqs->budget_remain) ?></td>
                            <td><?= h($orderReqs->currency_id) ?></td>
                            <td><?= h($orderReqs->handler_id) ?></td>
                            <td><?= h($orderReqs->originator_id) ?></td>
                            <td><?= h($orderReqs->intended_use) ?></td>
                            <td><?= h($orderReqs->justification) ?></td>
                            <td><?= h($orderReqs->deli_address_id) ?></td>
                            <td><?= h($orderReqs->single_source_id) ?></td>
                            <td><?= h($orderReqs->group_leader_id) ?></td>
                            <td><?= h($orderReqs->group_approve_time) ?></td>
                            <td><?= h($orderReqs->dept_leader_id) ?></td>
                            <td><?= h($orderReqs->dept_approve_time) ?></td>
                            <td><?= h($orderReqs->fin_approve_time) ?></td>
                            <td><?= h($orderReqs->fin_verifier_id) ?></td>
                            <td><?= h($orderReqs->or_status_id) ?></td>
                            <td><?= h($orderReqs->est_total) ?></td>
                            <td><?= h($orderReqs->exch_rate) ?></td>
                            <td><?= h($orderReqs->modified) ?></td>
                            <td><?= h($orderReqs->created) ?></td>
                            <td><?= h($orderReqs->group_comment) ?></td>
                            <td><?= h($orderReqs->dept_comment) ?></td>
                            <td><?= h($orderReqs->fin_comment) ?></td>
                            <td><?= h($orderReqs->pic_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderReqs', 'action' => 'view', $orderReqs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderReqs', 'action' => 'edit', $orderReqs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderReqs', 'action' => 'delete', $orderReqs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderReqs->id)]) ?>
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
