<?php
$this->layout = 'styleless';
?>

<?= $this->Form->create($hrPt) ?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Edit<strong>Pre-Termination</strong></h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <?php
                        echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                        echo $this->Form->control('status', ['type' => 'text', 'value' => $hrPt->hr_p_status->name, 'label' => 'Status', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                        echo $this->Form->control('name', ['label' => 'Staff', 'type' => 'text', 'disabled', 'class' => 'form-control', 'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('position', ['label' => 'Position', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('emp_type', ['label' => 'Employment Type', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                        echo $this->Form->control('department', ['label' => 'Department', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                        echo $this->Form->control('supervisor', ['label' => 'Supervisor', 'type' => 'text', 'value' => $hrPt->supervisor->name, 'disabled', 'class' => 'form-control', 'empty' => true, 'data-placeholder' => "Select a Supervisor", 'templateVars' => ['ctnClass' => 'col-md-6']]);

                        echo $this->Form->control('o_last_date', ['label' => 'Official Last day', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('last_date', ['label' => 'Last Working day', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('work_year', ['label' => 'Year in service', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <table>
        <thead>
            <th width='40%'>Task</th>
            <th width='30%'>Note</th>
            <th width='10%'>Date & Time</th>
            <th width='20%'>Person In Charge</th>
        </thead>
        <tbody>
            <?php
                foreach ($hrPt->hr_pt_tasks as $task){
                    echo '<tr>';
                        echo '<td>' . $task->description . '</td>';
                        echo '<td>' . $task->remark   . '</td>';
                        echo '<td>' . $task->modified . '</td>';
                        echo '<td>' . $task->modifier->name . '</td>';
                    echo '</tr>';
                }

            ?>
        </tbody>
    </table>
</div>
<?= $this->Form->end() ?>