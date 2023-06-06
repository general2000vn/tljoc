<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign[]|\Cake\Collection\CollectionInterface $abcCampaigns
 */

use App\Model\Table\AbcFormStatusesTable;

?>
<?php
$page_heading = 'My Annual Business Compliance Form';

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
                <h3 class="card-title">My Forms List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="abc-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><?= 'Year' ?></th>
                                <th><?= 'Deadline' ?></th>
                                <th><?= 'Last Action' ?></th>
                                <th><?= 'Status' ?></th>
                                <th><?= 'Abnormal' ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abcForms as $abcForm) : ?>
                                <tr>
                                    <td>
                                        <?php
                                            switch ($abcForm->abc_form_status_id) {
                                                case AbcFormStatusesTable::S_ACKNOWLEDGED:
                                                    echo $this->Html->link($abcForm->abc_campaign->period, ['action' => 'view', $abcForm->id]);
                                                    break;
                                                case AbcFormStatusesTable::S_SUBMITTED:
                                                    echo $this->Html->link($abcForm->abc_campaign->period, ['action' => 'view', $abcForm->id]);
                                                    break;
                                                
                                                default:
                                                    echo $this->Html->link($abcForm->abc_campaign->period, ['action' => 'fill', $abcForm->id]);
                                                    break;
                                            }
                                            
                                        ?>
                                    </td>
                                    <td><?= $abcForm->abc_campaign->deadline->format('Y-m-d') ?></td>
                                    <td><?php if (is_null($abcForm->last_handler)) {
                                                echo "";    
                                            } else {
                                                echo $abcForm->last_handler->name;
                                            } ?>
                                                
                                    </td>
                                    <td><?= $abcForm->abc_form_status->name ?></td>
                                    <td><?= $abcForm->is_abnormal ? 'Abnormal':'' ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>