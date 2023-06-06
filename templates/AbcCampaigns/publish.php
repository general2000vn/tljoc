<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

$page_heading = 'Publish Annual Business Compliance campaign';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
//echo $this->Html->script(['../themes/sash/assets/plugins/fileuploads/js/fileupload', '../themes/sash/assets/plugins/fileuploads/js/file-upload']);

//echo $this->Html->script('myORAdd');
echo $this->Html->script('myAddAbcCampaign');

$this->end();
$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>



<?= $this->Form->create($abcCampaign) ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Campaign information</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php

                    echo $this->Form->control('period', ['label' => 'Year', 'disabled', 'type' => 'year', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('abc_status_id', ['disabled', 'options' => $abcStatuses, 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    ?>


                </div>

            </div>

        </div>

        <?php

        $i = 0;
        ?>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Staffs</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <?= $this->Form->checkbox('selectAll', ['type' => 'checkbox', 'hiddenField' => false, 'onClick' => "toggleCheckbox(this)", 'templateVars' => ['ctnClass' => 'custom-checkbox', 'text' => 'Select All']]) ?>
                    </div>
                </div>
                
                
                
                <br />
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($depts as $dept) : ?>
                        <div class="panel panel-default mt-2">
                            <div class="panel-heading " role="tab" id="heading<?= $dept->id ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse<?= $dept->id ?>" aria-expanded="true" aria-controls="collapse<?= $dept->id ?>">

                                        <?= $dept->name ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $dept->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $dept->id ?>">
                                <div class="panel-body">
                                    <div class="custom-controls-stacked">
                                        <?php foreach ($dept->users as $staff) : ?>
                                            <?= $this->Form->checkbox('staffs.' . $i, ['type' => 'checkbox', 'hiddenField' => false, 'value' => $staff->id, 'templateVars' => ['extra_class' => 'staff' ,'ctnClass' => 'custom-checkbox', 'text' => $staff->name]]) ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>





        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Publish'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>

