<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcStatus $abcStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Abc Status'), ['action' => 'edit', $abcStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Abc Status'), ['action' => 'delete', $abcStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Abc Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Abc Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcStatuses view content">
            <h3><?= h($abcStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($abcStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($abcStatus->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Abc Campaigns') ?></h4>
                <?php if (!empty($abcStatus->abc_campaigns)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Period') ?></th>
                            <th><?= __('Initiator Id') ?></th>
                            <th><?= __('Deadline') ?></th>
                            <th><?= __('Abc Status Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($abcStatus->abc_campaigns as $abcCampaigns) : ?>
                        <tr>
                            <td><?= h($abcCampaigns->id) ?></td>
                            <td><?= h($abcCampaigns->period) ?></td>
                            <td><?= h($abcCampaigns->initiator_id) ?></td>
                            <td><?= h($abcCampaigns->deadline) ?></td>
                            <td><?= h($abcCampaigns->abc_status_id) ?></td>
                            <td><?= h($abcCampaigns->created) ?></td>
                            <td><?= h($abcCampaigns->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AbcCampaigns', 'action' => 'view', $abcCampaigns->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AbcCampaigns', 'action' => 'edit', $abcCampaigns->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AbcCampaigns', 'action' => 'delete', $abcCampaigns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcCampaigns->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Abc Forms') ?></h4>
                <?php if (!empty($abcStatus->abc_forms)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Abc Canpaign Id') ?></th>
                            <th><?= __('Is Abnormal') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Is Vn') ?></th>
                            <th><?= __('Abc Status Id') ?></th>
                            <th><?= __('Justification') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($abcStatus->abc_forms as $abcForms) : ?>
                        <tr>
                            <td><?= h($abcForms->id) ?></td>
                            <td><?= h($abcForms->user_id) ?></td>
                            <td><?= h($abcForms->abc_canpaign_id) ?></td>
                            <td><?= h($abcForms->is_abnormal) ?></td>
                            <td><?= h($abcForms->modified) ?></td>
                            <td><?= h($abcForms->is_vn) ?></td>
                            <td><?= h($abcForms->abc_status_id) ?></td>
                            <td><?= h($abcForms->justification) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AbcForms', 'action' => 'view', $abcForms->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AbcForms', 'action' => 'edit', $abcForms->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AbcForms', 'action' => 'delete', $abcForms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abcForms->id)]) ?>
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
