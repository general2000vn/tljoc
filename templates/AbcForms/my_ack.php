<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign[]|\Cake\Collection\CollectionInterface $abcCampaigns
 */

use App\Model\Table\AbcFormStatusesTable;

?>
<?php
$page_heading = 'Department Forms list';

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
                <h3 class="card-title">Current Forms List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="abc-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Year' ?></th>
                                <th><?= 'Deadline' ?></th>
                                <th><?= 'Staff' ?></th>
                                <th><?= 'Is Abnormal' ?></th>
                                <th><?= 'Status' ?></th>
                                <th><?= 'Action' ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abcForms as $abcForm) : ?>
                                <tr>
                                    <td><?= $abcForm->abc_campaign->period ?></td>
                                    <td><?= $abcForm->abc_campaign->deadline->format('Y-m-d') ?></td>
                                    <td><?= $abcForm->user->name ?></td>
                                    <td><?= $abcForm->is_abnormal ? 'Abnormal' : '' ?></td>
                                    <td><?= $abcForm->abc_form_status->name ?></td>
                                    <td>
                                        <?php
                                        if (in_array($abcForm->abc_form_status_id, [AbcFormStatusesTable::S_ACKNOWLEDGED, AbcFormStatusesTable::S_REJECTED, AbcFormStatusesTable::S_SUBMITTED])) {
                                            echo $this->Html->link('<i class="pe-7s-note2" data-bs-toggle="tooltip" title="View"></i>  ', ['action' => 'view', $abcForm->id], ['class' => 'text-warning', 'escape' => false]);
                                        }
                                        
                                        if ($abcForm->handler_id == $this->Identity->get('id')) {
                                            switch ($abcForm->abc_form_status_id) {
                                                case AbcFormStatusesTable::S_INITIATED:
                                                    echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Fill Form"></i>  ', ['action' => 'fill', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                                    break;

                                                case AbcFormStatusesTable::S_SUBMITTED:
                                                    echo $this->Html->link('<i class="pe-7s-hammer" data-bs-toggle="tooltip" title="Acknowledge"></i>  ', ['action' => 'acknowledge', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                                    break;
                                                case AbcFormStatusesTable::S_REJECTED:
                                                    echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Re-submit Form"></i>  ', ['action' => 'edit', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                                    break;
                                                case AbcFormStatusesTable::S_DRAFT:
                                                    echo $this->Html->link('<i class="fe fe-check-square" data-bs-toggle="tooltip" title="Edit Form"></i>  ', ['action' => 'edit', $abcForm->id], ['class' => 'text-info', 'escape' => false]);
                                                    break;

                                                default:
                                                    # code...
                                                    break;
                                            }
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