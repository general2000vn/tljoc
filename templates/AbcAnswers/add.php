<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcAnswer $abcAnswer
 * @var \Cake\Collection\CollectionInterface|string[] $abcForms
 * @var \Cake\Collection\CollectionInterface|string[] $abcQuestions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Abc Answers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="abcAnswers form content">
            <?= $this->Form->create($abcAnswer) ?>
            <fieldset>
                <legend><?= __('Add Abc Answer') ?></legend>
                <?php
                    echo $this->Form->control('abc_form_id', ['options' => $abcForms]);
                    echo $this->Form->control('abc_question_id', ['options' => $abcQuestions]);
                    echo $this->Form->control('is_abnormal');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
