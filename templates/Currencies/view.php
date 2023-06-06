<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Currency $currency
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Currency'), ['action' => 'edit', $currency->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Currency'), ['action' => 'delete', $currency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $currency->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Currencies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Currency'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="currencies view content">
            <h3><?= h($currency->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($currency->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($currency->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Display Order') ?></th>
                    <td><?= $this->Number->format($currency->display_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Deleted') ?></th>
                    <td><?= $currency->is_deleted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Order Reqs') ?></h4>
                <?php if (!empty($currency->order_reqs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Req Num') ?></th>
                            <th><?= __('Req Type') ?></th>
                            <th><?= __('Submit Date') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Required Date') ?></th>
                            <th><?= __('Contract Num') ?></th>
                            <th><?= __('Budget Code') ?></th>
                            <th><?= __('Currency Id') ?></th>
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
                            <th><?= __('Fin Leader Id') ?></th>
                            <th><?= __('Or Status Id') ?></th>
                            <th><?= __('Est Total') ?></th>
                            <th><?= __('Exch Rate') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($currency->order_reqs as $orderReqs) : ?>
                        <tr>
                            <td><?= h($orderReqs->id) ?></td>
                            <td><?= h($orderReqs->name) ?></td>
                            <td><?= h($orderReqs->req_num) ?></td>
                            <td><?= h($orderReqs->req_type) ?></td>
                            <td><?= h($orderReqs->submit_date) ?></td>
                            <td><?= h($orderReqs->department_id) ?></td>
                            <td><?= h($orderReqs->required_date) ?></td>
                            <td><?= h($orderReqs->contract_num) ?></td>
                            <td><?= h($orderReqs->budget_code) ?></td>
                            <td><?= h($orderReqs->currency_id) ?></td>
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
