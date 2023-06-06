<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

$page_heading = 'Annual Business Compliance form';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
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



<?= $this->Form->create($abcForm) ?>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Form information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('staff', ['label' => 'Staff', 'value' => $abcForm->user->name, 'disabled' ,  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('cperiod', ['label' => 'Year', 'value' => $abcCampaign->period, 'disabled' ,  'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'value' => $abcCampaign->deadline, 'disabled' ,'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('abc_form_status_id', ['label' => 'Status', 'disabled', 'options' => $abcFormStatuses, 'templateVars' => ['ctnClass' => 'col-md-3']]);
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
                            <?php foreach ($abcCampaign->abc_questions as $question) : ?>
                                <?php if ($question->abc_category_id == $category->id) : ?>


                                    <div class="row" id="item-<?= $i ?>-">
                                        <?= $this->Form->hidden('abc_answers.' . $i . '.abc_question_id', ['value' => $question->id]) ?>
                                        <?= $this->Form->hidden('abc_answers.' . $i . '.abc_question.abnormal', ['value' => $question->abnormal]) ?>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <?= $this->Form->control('abc_questions.' . $i . 'order_code' , ['value' => $question->order_code, 'disabled', 'label' => false,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="form-label">Answer</div>
                                                    <?= $this->Form->radio('abc_answers.' . $i . '.b_value', ['No', 'Yes'], ['required','class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <?= $this->Form->control('abc_questions.' . $i . '.vn', ['value' => $question->vn, 'disabled', 'label' => false, 'rows' => 3,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                                <?= $this->Form->control('abc_questions.' . $i . '.en', ['value' => $question->en, 'disabled', 'label' => false, 'rows' => 3,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
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

            <div class="card-header">
                <h3 class="card-title">Justification</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('justification', [ 'rows' => 4 ,  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    
                    ?>
                </div>
            </div>
        </div>

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