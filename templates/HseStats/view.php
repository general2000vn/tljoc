<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HseStat $hseStat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Hse Stat'), ['action' => 'edit', $hseStat->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Hse Stat'), ['action' => 'delete', $hseStat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hseStat->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Hse Stats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Hse Stat'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hseStats view content">
            <h3><?= h($hseStat->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $hseStat->has('user') ? $this->Html->link($hseStat->user->name, ['controller' => 'Users', 'action' => 'view', $hseStat->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($hseStat->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Man Hour') ?></th>
                    <td><?= $this->Number->format($hseStat->man_hour) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lost Time') ?></th>
                    <td><?= $this->Number->format($hseStat->lost_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Med Treat Case') ?></th>
                    <td><?= $this->Number->format($hseStat->med_treat_case) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Aid Case') ?></th>
                    <td><?= $this->Number->format($hseStat->first_aid_case) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fire Explosion') ?></th>
                    <td><?= $this->Number->format($hseStat->fire_explosion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Near Miss') ?></th>
                    <td><?= $this->Number->format($hseStat->near_miss) ?></td>
                </tr>
                <tr>
                    <th><?= __('Obs Card') ?></th>
                    <td><?= $this->Number->format($hseStat->obs_card) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stat Date') ?></th>
                    <td><?= h($hseStat->stat_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($hseStat->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($hseStat->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
