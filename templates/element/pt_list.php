<?php

use App\Model\Table\HrPStatusesTable;
?>
<div class="table-responsive">
    <table data-order='[[ 0, "asc" ]]' class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
        <thead>
            <tr>
                <th><?= __('Last Working Day') ?></th>
                <th><?= __('Official Last Day') ?></th>
                <th><?= __('Staff Name') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hrPts as $hrPt) : ?>
                <tr>
                    <td><?= $hrPt->last_date ?>
                    <td><?= $hrPt->o_last_date ?>
                    <td><?= $hrPt->staff->name ?>
                    <td>
                        <?php
                        switch ($hrPt->hr_p_status_id) {
                            case HrPStatusesTable::S_DRAFT:
                                echo '<span class="tag tag-orange">' . $hrPt->hr_p_status->name . '</span>';
                                break;
                            case HrPStatusesTable::S_COMPLETED:
                                echo '<span class="tag tag-azure">' . $hrPt->hr_p_status->name . '</span>';
                                break;
                            case HrPStatusesTable::S_PENDING:
                                echo '<span class="tag tag-pink">' . $hrPt->hr_p_status->name . '</span>';
                                break;
                        }
                        ?>
                    <td>
                        <?php
                        switch ($hrPt->hr_p_status_id) {
                            case HrPStatusesTable::S_DRAFT:
                                echo $this->Html->link('<i class="fe fe-eye"></i>  ', ['action' => 'view', $hrPt->id], ['data-bs-toggle'=>"tooltip", 'title'=>"View", 'class' => 'btn btn-sm btn-primary', 'escape' => false]) . '  ';
                                echo $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'Edit', $hrPt->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Edit", 'class' => 'btn btn-sm btn-primary', 'escape' => false])  . '  ';
                                
                                break;

                            default:
                                echo $this->Html->link('<i class="fe fe-eye"></i>  ', ['action' => 'view', $hrPt->id], ['data-bs-toggle'=>"tooltip", 'title'=>"View", 'class' => 'btn btn-sm btn-primary', 'escape' => false]) . '  ';
                                break;
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>