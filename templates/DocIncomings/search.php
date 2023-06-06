<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocIncoming $docIncoming
 * @var string[]|\Cake\Collection\CollectionInterface $docCompanies
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $docStatuses
 * @var string[]|\Cake\Collection\CollectionInterface $docTypes
 */
?>
<?php

use Cake\I18n\FrozenDate;
use PhpParser\Node\Stmt\For_;

//$this->layout = 'das';

$page_heading = 'Incoming Document';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    ['caption' => 'Incoming Documents', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
//echo $this->Html->css('../newLib/select2.min.css');
echo $this->Html->css('../assets/plugins/select2/select2');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

//echo $this->Html->script('https://code.jquery.com/jquery-1.12.4.js');
//echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
echo $this->Html->script('../assets/bundles/datatablescripts.bundle');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/dataTables.buttons.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.colVis.min');
echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.flash.min');
// echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.html5.min');
// echo $this->Html->script('../assets/plugins/jquery-datatable/buttons/buttons.print.min');
echo $this->Html->script('../assets/js/pages/tables/jquery-datatable');

// echo $this->Html->script('https://code.jquery.com/jquery-3.5.1.js');
// echo $this->Html->script('https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js');
// echo $this->Html->script('https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js');
echo $this->Html->script('../newLib/jszip.min.js');
echo $this->Html->script('../newLib/pdfmake.min.js');
echo $this->Html->script('../newLib/vfs_fonts.js');
echo $this->Html->script('../newLib/buttons.html5.min.js');
echo $this->Html->script('../newLib/buttons.print.min.js');

echo $this->Html->script('../assets/plugins/momentjs/moment.js');
echo $this->Html->script('../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker');

echo $this->Html->script('myDocSearch');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

?>


<div class="row clearfix">
<?= $this->Form->create() ?>

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Search</strong> Criteria</h2>
            </div>
            <div class="body">
                <div class="row clearfix">


                    <?php
                    echo $this->Form->control('doc.reg_date_from', ['class' => 'form-control','type' => 'date', 'label' => 'Registration From', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc.reg_date_to', ['class' => 'form-control','type' => 'date', 'label' => 'Registration To','templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc.reg_text', ['class' => 'form-control', 'label' => 'Registration Number', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('inputter_id', ['type' => 'text',  'class' => 'form-control',  'label' => 'Inputter', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['type' => 'text',  'class' => 'form-control',  'label' => 'Last Modifier', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
                    echo $this->Form->control('doc_sec_level_id', ['options' => $secretLevels, 'empty' => true, 'label' => 'Secret','class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('subject', ['class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-10']]);

                    echo $this->Form->control('partner_id', ['class' => 'form-control show-tick ms mySelect2 selectPartner', 'label' => 'Sender', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
                    echo $this->Form->control('ref_text', ['class' => 'form-control', 'label' => 'Reference Number', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('receiving_date_from', ['type' => 'date','class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4'], 'empty' => true]);
                    echo $this->Form->control('receiving_date_to', ['type' => 'date','class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4'], 'empty' => true]);
                    echo $this->Form->control('doc_method_id', ['empty' => true,'class' => 'form-control', 'label' => 'Method', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('doc_company_id', ['empty' => true,'options' => $docCompanies, 'label' => 'To Company', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                                       
                    echo $this->Form->control('doc_status_id', ['empty' => true,'options' => $docStatuses , 'label' => 'Status', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('doc_type_id', ['empty' => true,'options' => $docTypes , 'label' => 'Type','class' => 'form-control',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('contract_num' , ['class' => 'form-control', 'label' => 'Contract Number', 'templateVars' => ['ctnClass' => 'col-md-4']]);                  

                    echo $this->Form->control('docInDepts.id', ['label' => 'Department','empty' => true, 'options' => $docInDepts, 'class' => 'form-control show-tick ms select2', 'data-placeholder' => "Type to seach", 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('doc_outgoing_id', ['label' => 'Related Outgoing Document', 'empty' => true, 'class' => 'form-control show-tick ms mySelect2 selectDocOut',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                 


                    echo $this->Form->submit('Search', ['class' => 'btn btn-primary',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    ?>

                </div>

            </div>
        </div>
    </div>



<?= $this->Form->end() ?>




    <div class="col-lg-12">

        <div class="card">
            <div class="header">
                <h2><strong>Data</strong> List</h2>
            </div>
            <div class="body">

                <div class="table-responsive">
                    <table class="table js-exportable table-bordered c_table table-hover table-striped dataTable  theme-color">
                        <thead>
                            <tr>

                                <th><?= __('Recieved') ?></th>
                                <th><?= __('From') ?></th>
                                <th><?= __('To') ?></th>
                                <th><?= __('Registration') ?></th>

                                <th><?= __('Subject') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Status') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docIncomings as $docIncoming) : ?>
                                <tr>
                                    <td><?= $docIncoming->receiving_date ?></td>
                                    <td><?= h($docIncoming->partner->name) ?></td>
                                    <td><?= h($docIncoming->doc_company->name) ?></td>
                                    <td><?= $this->Html->link($docIncoming->reg_text, ['action' => 'view', $docIncoming->id]) ?></td>
                                    <td><?= $this->Html->link($docIncoming->subject, ['action' => 'view', $docIncoming->id]) ?></td>
                                    <td><?= h($docIncoming->doc_type->name) ?></td>
                                    <td><?= h($docIncoming->doc_status->name) ?></td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>