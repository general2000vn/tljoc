
<?= $this->Form->create(null, ['type' => 'get']) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Search Criteria</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <?php
                    echo $this->Form->control('date_from', ['class' => 'form-control', 'type' => 'date', 'value' => $criteria['date_from'], 'label' => 'From', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('date_to', ['class' => 'form-control', 'type' => 'date', 'value' => $criteria['date_to'], 'label' => 'To', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('dept_id', ['class' => 'form-control', 'type' => 'select', 'empty' => false, 'value' => $criteria['dept_id'], 'options' => $deptList, 'label' => 'Department', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('search_text', ['class' => 'form-control', 'label' => 'Contain', 'value' => $criteria['search_text'], 'placeholder' => 'search by: Document Number, Subject, Reference Number, Attachment name','templateVars' => ['ctnClass' => 'col-md-6']]);

                    ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Search'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<?= $this->Form->end() ?>
