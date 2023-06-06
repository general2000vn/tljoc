<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppComment[]|\Cake\Collection\CollectionInterface $appComments
 */

use Cake\I18n\Number;

?>
<?php
$page_heading = 'Unresolved Comments';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Application Comments', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myUserTable');
$this->end();

?>


<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Unresolved Comments</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center"><?= __('ID') ?></th>
                                <th class="border-bottom-0 text-center"><?= __('Type') ?></th>
                                <th class="border-bottom-0 text-center"><?= __('Brief')  ?></th>
                                <th class="border-bottom-0 text-center"><?= __('Status') ?></th>
                                <th class="border-bottom-0 text-center"><?= __('Result') ?></th>
                                <th class="actions text-center"><?= __('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appComments as $appComment) : ?>
                                <tr>
                                    <td><?= $this->Number->format($appComment->id) ?></td>
                                    <td><?= $appComment->has('ac_type') ? $this->Html->link($appComment->ac_type->name, ['action' => 'edit', $appComment->id]) : '' ?></td>
                                    <td><?= h($appComment->brief) ?></td>
                                    <td><?= $appComment->has('ac_status') ? $this->Html->link($appComment->ac_status->name, ['action' => 'process', $appComment->id]) : '' ?></td>
                                    <td><?= $appComment->has('ac_result') ? $appComment->ac_result->name : '' ?></td>
                                    
                                    <td class="actions">
                                        
                                        <?= $this->Html->link('<i class="fe fe-eye"></i>', ['action' => 'view', $appComment->id], ['data-bs-toggle'=>"tooltip", 'title'=>"View", 'class' => 'btn btn-sm btn-primary', 'escape' => false])  . '  ' ?>
                                        <?= $this->Html->link('<i class="fe fe-edit"></i>  ', ['action' => 'process', $appComment->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Process", 'class' => 'btn btn-sm btn-secondary', 'escape' => false]) . '  ' ?>
                                        
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