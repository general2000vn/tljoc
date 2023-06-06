<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

use App\Model\Table\AbcFormStatusesTable;

$page_heading = 'View form';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcForms', 'action' => 'myAck']), 'class' => ""],
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
                    echo $this->Form->control('staff', ['label' => 'Staff', 'value' => $abcForm->user->name, 'disabled',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('cperiod', ['label' => 'Year', 'value' => $abcCampaign->period, 'disabled',  'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'value' => $abcCampaign->deadline, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('abc_form_status_id', ['label' => 'Status', 'disabled', 'options' => $abcFormStatuses, 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    echo $this->Form->control('Abnormal', ['type' => 'text',  'label' => 'Abnormal', 'value' => $abcForm->is_abnormal?'Yes':'No', 'disabled',  'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('submit_date', ['label' => 'Submit time', 'disabled',  'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('handler.name', ['label' => 'Acknowledge by', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('ack_date', ['label' => 'Acknowledge time', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
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

                                    <?php foreach ($abcForm->abc_answers as $answer) : ?>
                                        <?php if ($question->id == $answer->abc_question_id) : ?>
                                            <div class="row" id="item-<?= $i ?>-">
                                                <?= $this->Form->hidden('abc_answers.' . $i . '.id', ['value' => $answer->id]) ?>

                                                <div class="col-md-2">
                                                    <div class="row">
                                                        <?= $this->Form->control('abc_questions.' . $i . 'order_code', ['value' => $question->order_code, 'disabled', 'label' => false,  'templateVars' => ['ctnClass' => 'col-md-12']]) ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="form-label">Answer</div>
                                                            <?= $this->Form->radio('abc_answers.' . $i . '.b_value', ['No', 'Yes'], ['disabled', 'class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
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
                    echo $this->Form->control('justification', [ 'rows' => 4 , 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    
                    ?>
                </div>
            </div>
        </div>

        <?php if ($abcForm->abc_form_status_id == AbcFormStatusesTable::S_REJECTED) : ?>
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Feedback</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('feedback', [ 'rows' => 4 , 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    
                    ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        
                        <?= $this->Html->link(__('Re-submit'), ['action' => 'edit', $abcForm->id],['class' => 'btn btn-medium btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        
                        <?= $this->Html->link(__('My Forms list'), ['action' => 'my'],['class' => 'btn btn-medium btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>


        

    </div>
</div>
<?= $this->Form->end() ?>