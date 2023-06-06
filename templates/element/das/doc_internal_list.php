<?php

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
                                <th><?= __('Register Date') ?></th>
                                <th><?= __('Issued Date') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Status') ?></th>
                                <th><?= __('Department') ?></th>
                                <th><?= __('Sensitivity') ?></th>
                                <th><?= __('Subject') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docInternals as $docInternal) : ?>
                                <tr>
                                    <td><?php
                                        if (!is_null($docInternal->doc_file) && ($docInternal->doc_file != "")) {
                                            echo '<i class="zmdi zmdi-hc-fw"></i>';
                                        } else {
                                            echo '&nbsp;';
                                        }

                                        ?></td>
                                    <td><?= $this->Html->link($docInternal->reg_text, ['action' => 'edit', $docInternal->id]) ?></td>
                                    <td><?= $docInternal->reg_date ?></td>
                                    <td><?= $docInternal->issued_date ?></td>
                                    <td><?= h($docInternal->doc_internal_type->name) ?></td>
                                    <td><?= h($docInternal->doc_status->name) ?></td>
                                    <td><?= h($docInternal->department->name) ?></td>
                                    <td><?= h($docInternal->doc_sec_level->name) ?></td>
                                    <td><?= $this->Html->link($docInternal->subject, ['action' => 'view', $docInternal->id]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>