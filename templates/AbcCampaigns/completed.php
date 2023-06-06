<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign[]|\Cake\Collection\CollectionInterface $abcCampaigns
 */

use App\Model\Table\AbcStatusesTable;

?>
<?php
$page_heading = 'Completed Business Compliance campaigns';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myAbcCampaignDataTable');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

<div class="row row-sm">
    <div class="col-lg-12">
        

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Completed campaigns list</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="abc-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Year' ?></th>
                                <th><?= 'Deadline' ?></th>
                                <th><?= 'Status' ?></th>
                                <th><?= 'Created by' ?></th>
                                <th><?= 'Actions' ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abcCampaigns as $abcCampaign) : ?>
                                <tr>
                                    <td><?= $this->Html->link($abcCampaign->period, ['action' => 'view', $abcCampaign->id]) ?></td>
                                    <td><?= $abcCampaign->deadline->format('Y-m-d') ?></td>
                                    <td><?= $abcCampaign->abc_status->name ?></td>
                                    <td><?= $abcCampaign->initiator->name ?></td>
                                    <td>
                                        <?php
                                            echo $this->Html->link('<i class="pe-7s-note2 text-success" data-bs-toggle="tooltip" title="View Questions"></i>  ', ['action' => 'view', $abcCampaign->id], ['class' => 'text-info', 'escape' => false]) . '  ' ;
                                            
                                            if ($abcCampaign->abc_status_id == AbcStatusesTable::S_DRAFT){
                                                echo $this->Html->link('<i class="fa fa-pencil-square text-secondary" data-bs-toggle="tooltip" title="Edit"></i>  ', ['action' => 'Edit', $abcCampaign->id], ['class' => 'text-info', 'escape' => false])  . '  ' ;
                                            } elseif ($abcCampaign->abc_status_id == AbcStatusesTable::S_PROCESSING){
                                                echo $this->Html->link('<i class="icon icon-chart text-secondary" data-bs-toggle="tooltip" title="Statistic"></i>  ', ['action' => 'stat', $abcCampaign->id], ['class' => 'text-info', 'escape' => false])  . '  ' ;         
                                            }
                                        ?>
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