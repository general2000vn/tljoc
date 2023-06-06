<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Testfam[]|\Cake\Collection\CollectionInterface $testfans
 */
?>

<?php

use Cake\I18n\FrozenDate;
//use PhpParser\Node\Stmt\For_;

//$this->layout = 'das';

$page_heading = 'FAM Status';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

echo $this->Html->script('../assets/bundles/datatablescripts.bundle');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/dataTables.buttons.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.colVis.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.flash.min');
echo $this->Html->script('../assets/js/pages/tables/jquery-datatable');


echo $this->Html->script('../newLib/jszip.min.js');
echo $this->Html->script('../newLib/pdfmake.min.js');
echo $this->Html->script('../newLib/vfs_fonts.js');
echo $this->Html->script('../newLib/buttons.html5.min.js');
echo $this->Html->script('../newLib/buttons.print.min.js');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

?>

<div class="row clearfix">

    <div class="col-md-12">

        <div class="card">
            <div class="header">
                <h2><strong>FAM Status</strong> List</h2>
            </div>
            <div class="align-right">

                        <?= $this->Html->link('Add New', ['action' => 'add'], ['class' => 'btn btn-primary btn-large']) ?>

            </div>
            <div class="body">

                <div class="table-responsive">
                    <table class="table js-exportable table-bordered c_table table-hover table-striped dataTable  theme-color">
                        <thead>
                            <tr>

                                <th><?= __('ID') ?></th>
                                <th><?= __('Name') ?></th>
                                                               

                                <th><?= __('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($testfams as $testfam) : ?>
                                <tr>
                                <td><?= h($testfam->Status_ID) ?></td>
                                <td><?= $this->Html->link($testfam->Status_Name, ['action' => 'view', $testfam->Status_ID]) ?></td>
                                
                                

                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $testfam->Status_ID]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testfam->Status_ID]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testfam->Status_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $testfam->Status_ID)]) ?>
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
