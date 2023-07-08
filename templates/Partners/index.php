<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partner[]|\Cake\Collection\CollectionInterface $partners
 */
?>

<?php

$page_heading = 'All External Entities';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    ['caption' => 'External Entities', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myDataTable');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

?>
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table data-order='[[ 0, "asc" ]]' class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= __('Code') ?></th>
                                <th><?= __('Name') ?></th>
                                
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partners as $partner) : ?>
                                <tr>
                                    <td><?= h($partner->name2) ?></td>
                                    <td><?= $this->Html->link($partner->name, ['action' => 'view', $partner->id]) ?></td>

                                    <td class="actions">
                                        <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $partner->id]) ?> -->
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partner->id],['class' => 'btn btn-sm btn-primary']) ?>
                                        <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]) ?> -->
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