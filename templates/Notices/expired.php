<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice[]|\Cake\Collection\CollectionInterface $notices
 */
$page_heading = 'Expired Notices';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Notices Management', ['controller' => 'Notices', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
//echo $this->Html->script('Dashboard/myPrdStatDataTable');
$this->end();

?>
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dashboard-prd" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">Start Date</th>
                                <th class="border-bottom-0 text-center">End Date</th>
                                <th class="border-bottom-0 text-center">Content</th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notices as $notice) : ?>
                                <tr>

                                    <td><?= h($notice->start_date) ?></td>
                                    <td><?= h($notice->end_date) ?></td>
                                    <td><?= $this->Html->link($notice->content, ['controller' => 'Notices','action' => 'view', $notice->id]) ?></td>
                                    <td class="actions">

                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notice->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notice->id], ['confirm' => __('Are you sure you want to delete: {0}?', $notice->content)]) ?>
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