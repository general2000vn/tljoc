
Dear Mr./Ms. <?= $handler_name ?>,
<br /> 
<br />
<p>Your staff has submitted their Annual Business Compliance form for your acknowledgement:</p>
<table>
    <tr>
        <td width="20%">Staff:</td>
        <td width="80%"><strong><?= $staff_name ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Year:</td>
        <td width="80%"><strong><?= $period ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Deadline:</td>
        <td width="80%"><?= $deadline ? $deadline : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Link:</td>
        <td width="80%"><?= $this->Html->link('Click here to view the online form', ['controller' => "AbcForms", 'action' => 'acknowledge', $form_id, '_full' => true]) ?></td>
    </tr>

</table>

