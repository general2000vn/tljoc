<?php
use App\Model\Table\HrPStatusesTable;
?>
<div class="table-responsive">
    <table data-order='[[ 0, "asc" ]]' class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
        <thead>
            <tr>
                <th><?= __('Last Working Day') ?></th>
                <th><?= __('Official Last day') ?></th>
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
                    <td><?= $hrPt->hr_p_status->name ?>

                    <td><?= $this->Html->link('Process', ['action' => 'process', $hrPt->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>