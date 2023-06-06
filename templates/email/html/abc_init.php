
Dear Mr./Ms. <?= $username ?>
<br /> 
<br />
<p>This is a reminder to submit your annual Business Ethics Compliance form, details as below:</p>
<table>
    <tr>
        <td width="20%">Year:</td>
        <td width="80%"><strong><?= $this->Html->link($period , ['controller' => "AbcForms", 'action' => 'fill', $form_id, '_full' => true]) ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Deadline:</td>
        <td width="80%"><?= $deadline ? $deadline : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Link:</td>
        <td width="80%"><?= $this->Html->link('Click here to read Business Ethics Guideline and access online form', ['controller' => "AbcForms", 'action' => 'fill', $form_id, '_full' => true]) ?></td>
    </tr>

</table>

<p>Once submitted, your Business Ethics Compliance form will be automatically sent to your supervisor for acknowledgement.</p>
<p>Feel free to contact Minh Chau (HR) if you have questions regarding this matter.</p>

