<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

$page_heading = 'Edit campaign';

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
                    echo $this->Form->control('period', ['label' => 'Year', 'type' => 'year', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('abc_status_id', ['disabled', 'options' => $abcStatuses, 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    ?>
                </div>
            </div>
        </div>

        <?php
        $cat = 1;
        $i = 0;
        ?>

        <?php foreach ($abcCategories as $category) : ?>
            <div class="card">

                <div class="card-header">

                    <h3 class="card-title"><?= $category->en ?></h3>
                </div>
                <div class="card-body">
                    <div>
                        <div id="item_list_<?= $cat ?>">
                            <?php foreach ($questions as $question) : ?>
                                <?php if ($question->abc_category_id == $category->id) : ?>


                                    <div class="row" id="item-<?= $i ?>-">
                                        <?= $this->Form->hidden('abc_questions.' . $i . '.id') ?>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <?= $this->Form->control('abc_questions.' . $i . '.order_code', ['label' => false,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="form-label">Abnormal Answer</div>
                                                    <?= $this->Form->radio('abc_questions.' . $i . '.abnormal', ['No', 'Yes'], ['class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <?= $this->Form->control('abc_questions.' . $i . '.vn', ['label' => false, 'rows' => 3,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                                <?= $this->Form->control('abc_questions.' . $i . '.en', ['label' => false, 'rows' => 3,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    </div>

                                    <br />
                                    <br />


                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>


            </div>
        <?php endforeach; ?>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>