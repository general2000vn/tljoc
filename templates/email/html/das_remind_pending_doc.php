<br />
<br />
<p>Department <strong><?= $department ?></strong> currently has incompleted documents as below:</p>

<?php if (count($docOuts) > 0) : ?>
    <p> <strong>Outgoing Documents</strong>:</p>
    <table border="1">
        <thead>
            <th>Register Date</th>
            <th>Document Number</th>
            <th>Inputter</th>
            <th>Originator</th>
            <th>Subject</th>
            <th>Status</th>
            <th>File</th>
        </thead>
        <tbody>
            <?php foreach ($docOuts as $doc) : ?>
                <tr>
                    <td><?= $doc['reg_date'] ?></td>
                    <td><?= $this->Html->link($doc['reg_text'], ['controller' => 'DocOutgoings', 'action' => 'view', $doc['id'], '_full' => true]) ?></td>
                    <td><?= $doc['inputter'] ?></td>
                    <td><?= $doc['originator'] ?></td>
                    <td><?= $doc['subject'] ?></td>
                    <td><?= $doc['status'] ?></td>
                    <td><?= $doc['upload'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>



<?php if (count($docInts) > 0) : ?>
    <p> <strong>Internal Documents</strong>:</p>
    <table border="1">
        <thead>
            <th>Register Date</th>
            <th>Document Number</th>
            <th>Inputter</th>
            <th>Originator</th>
            <th>Subject</th>
            <th>Status</th>
            <th>File</th>
        </thead>
        <tbody>
            <?php foreach ($docInts as $doc) : ?>
                <tr>
                    <td><?= $doc['reg_date'] ?></td>
                    <td><?= $this->Html->link($doc['reg_text'], ['controller' => 'DocInternals', 'action' => 'view', $doc['id'], '_full' => true]) ?></td>
                    <td><?= $doc['inputter'] ?></td>
                    <td><?= $doc['originator'] ?></td>
                    <td><?= $doc['subject'] ?></td>
                    <td><?= $doc['status'] ?></td>
                    <td><?= $doc['upload'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<p>Please kindly review your documents, upload related file and change status to either <strong>Distributed</strong> or <strong>Cancelled</strong>.</p>

<p>This reminder will be sent to you once a week, reminding any pending documents which has been registered more than 2 weeks.</p>