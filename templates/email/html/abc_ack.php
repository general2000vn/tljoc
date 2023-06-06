
Dear <?= $staff_title .' ' ?> <?= $staff_name ?>,
<br /> 
<br />
<p>Your Annual Business Compliance form has been acknowledged, details as below:</p>
<table>
    <tr>
        <td width="20%">Supervisor:</td>
        <td width="80%"><strong><?= $handler_name ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Year:</td>
        <td width="80%"><strong><?= $period ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Date & Time:</td>
        <td width="80%"><?= $ack_time ?></td>
    </tr>
    <tr>
        <td width="20%">Link:</td>
        <td width="80%"><?= $this->Html->link('Click here to view', ['controller' => "AbcForms", 'action' => 'acknowledge', $form_id, '_full' => true]) ?></td>
    </tr>

</table>

