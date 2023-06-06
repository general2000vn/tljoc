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
                                <th><?= __('Issued Date') ?></th>
                                <th><?= __('Subject') ?></th>
                                <th><?= __('Department') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Status') ?></th>
                                <!-- <th><?= __('Category') ?></th> -->
                                <th><?= __('Sensitivity') ?></th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docOutgoings as $docOutgoing) : ?>
                                <tr>
                                    <td><?php
                                        if (!is_null($docOutgoing->doc_file) && ($docOutgoing->doc_file != "")) {
                                            echo '<i class="zmdi zmdi-hc-fw"></i>';
                                        } else {
                                            echo '&nbsp;';
                                        }

                                        ?></td>
                                    <td><?= $this->Html->link($docOutgoing->reg_text, ['action' => 'edit', $docOutgoing->id]) ?>
                                    
                                    <td><?= $docOutgoing->issued_date ?></td>
                                    <td><?= $this->Html->link($docOutgoing->subject, ['action' => 'view', $docOutgoing->id]) ?></td>
                                    <td><?= h($docOutgoing->department->name) ?></td>
                                    <td><?= h($docOutgoing->doc_type->name) ?></td>
                                    <td><?= h($docOutgoing->doc_status->name) ?></td>
                                    <!-- <td><?= h($docOutgoing->doc_category->name) ?></td> -->
                                    <td><?= h($docOutgoing->doc_sec_level->name) ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>