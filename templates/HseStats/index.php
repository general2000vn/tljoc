<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HseStat[]|\Cake\Collection\CollectionInterface $hseStats
 */


$page_heading = 'HSE Dashboard Statistics List';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HSE', ['controller' => 'hseStats', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>


<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistics List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-datatable" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                

                                <th class="border-bottom-0">From Date</th>
                                <th class="border-bottom-0">Man-Hours</th>
                                <th class="border-bottom-0">Lost Time</th>
                                <th class="border-bottom-0">Med. Treatment</th>
                                <th class="border-bottom-0">First Aid</th>
                                <th class="border-bottom-0">Fire/Expl.</th>
                                <th class="border-bottom-0">Near-miss</th>
                                <th class="border-bottom-0">Obs. Card</th>

                                <th class="actions"><?= __('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hseStats as $hseStat) : ?>
                                <tr>
                                    
                                    <td><?= h($hseStat->from_date) ?></td>
                                    <td><?= $this->Number->format($hseStat->man_hour) ?></td>
                                    <td><?= $this->Number->format($hseStat->lost_time) ?></td>
                                    <td><?= $this->Number->format($hseStat->med_treat_case) ?></td>
                                    <td><?= $this->Number->format($hseStat->first_aid_case) ?></td>
                                    <td><?= $this->Number->format($hseStat->fire_explosion) ?></td>
                                    <td><?= $this->Number->format($hseStat->near_miss) ?></td>
                                    <td><?= $this->Number->format($hseStat->obs_card) ?></td>
                                    
                                    <td class="actions">
                                        
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hseStat->id]) ?>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>