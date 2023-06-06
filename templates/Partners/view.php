<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partner $partner
 * @var \Cake\Collection\CollectionInterface|string[] $docOutgoings
 */


//$this->layout = 'das';

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'External Entities Detail Information';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    ['caption' => 'External Entities', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
echo $this->Html->css('../newLib/select2.min.css');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
//echo $this->Html->script('../assets/plugins/select2/select2.min');

echo $this->Html->script('../newLib/select2.min.js');
echo $this->Html->script('select2');
$this->end();

?>

<?= $this->Form->create($partner) ?>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>External Entity</strong> Detail</h2>
            </div>
            <div class="body">
                <div class="row clearfix">

                    <?php
                    echo $this->Form->control('name', ['label' => 'Name *', 'class' => 'form-control', 'disabled','templateVars' => ['ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('name2', ['label' => 'Abbreviation', 'disabled','class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('tax_code', ['label' => 'Tax Code', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                                        
                    ?>
                    <div class='align-center'>
                    <?= $this->Html->Link('Back', $this->request->referer() ,['class' => 'btn btn-large btn-primary align-center']) ?>
                    
                    </div>
                </div>

            </div>
        </div>

        
    </div>

</div>

<?= $this->Form->end() ?>