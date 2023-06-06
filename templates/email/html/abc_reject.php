
Dear Sir/Madam <?= $staff_name ?>,
<br /> 
<br />
<p>Your Annual Business Compliance form has been rejected by your supervisor, details as below:</p>
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
        <td width="80%"><?= $reject_time ?></td>
    </tr>
    <tr>
        <td width="20%">Link:</td>
        <td width="80%"><?= $this->Html->link('Click here to view', ['controller' => "AbcForms", 'action' => 'view', $form_id, '_full' => true]) ?></td>
    </tr>

</table>

<p>Please review, revise, and re-submit your Business Ethics Compliance form.</p>

<p>Feel free to contact Minh Chau (HR) if you have questions regarding this matter.</p>
