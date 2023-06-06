<p>Dear
    <?php
    foreach ($to_person as $reciever) {
        echo $reciever->title . ' ' . $reciever->name  . ',';
    }
    ?>
</p>

<p>There is new Order Requisition assigned to you:</p>
<table>
    <tr>
        <td width="20%">Description:</td>
        <td width="80%"><strong><?= $this->Html->link($or_name, ['controller' => "OrderReqs", 'action' => 'view', $id, '_full' => true]) ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Submitted Date:</td>
        <td width="80%"><?= $submit_date ? $submit_date : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Required Date:</td>
        <td width="80%"><?= $required_date ? $required_date : '' ?></td>
    </tr>
    <tr>
        <td width="20%">OR number:</td>
        <td width="80%"><?= $req_num ? $req_num : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Originator:</td>
        <td width="80%"><?= $originator_name ? $originator_name : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Department:</td>
        <td width="80%"><?= $department_name ? $department_name : '' ?></td>
    </tr>
</table>

<p>Please kindly click on <?= $this->Html->link('this link', ['controller' => "OrderReqs", 'action' => 'view', $id, '_full' => true]) ?> for more detail !</p>