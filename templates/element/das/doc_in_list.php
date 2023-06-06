<?php
// use App\Model\Table\HrPStatusesTable;
?>
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table data-order='[[ 1, "desc" ]]' class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th><i class="zmdi zmdi-hc-fw"></i></th>
                                <th><?= __('Registration') ?></th>
                                <th><?= __('Recieved') ?></th>
                                <th><?= __('Subject') ?></th>
                                <th><?= __('From') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Status') ?></th>
                                <!-- <th><?= __('To') ?></th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docIncomings as $docIncoming) : ?>
                                <tr>

                                    <td><?php
                                        if (!is_null($docIncoming->doc_file) && ($docIncoming->doc_file != "")) {
                                            echo '<i class="zmdi zmdi-hc-fw"></i>';
                                        } else {
                                            echo '&nbsp;';
                                        }

                                        ?></td>
                                    <td><?= $this->Html->link($docIncoming->reg_text, ['action' => 'edit', $docIncoming->id]) ?></td>
                                    <td><?= $docIncoming->receiving_date ?></td>
                                    <td><?= $this->Html->link($docIncoming->subject, ['action' => 'view', $docIncoming->id]) ?></td>
                                    <td><?= h($docIncoming->partner->name) ?></td>
                                    <td><?= h($docIncoming->doc_type->name) ?></td>
                                    <td><?= h($docIncoming->doc_status->name) ?></td>
                                    <!-- <td><?= h($docIncoming->doc_company->name) ?></td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>