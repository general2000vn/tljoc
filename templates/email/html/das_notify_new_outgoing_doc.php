

<p>Dear All,
<!-- // clear name list
//'<p>Dear '; foreach ($people as $person) {$person['title'] . ' ' . $person['name'] . ', ' ;} -->
</p>

<p>Please be informed that there is new Outgoing Document. Please kindly click on the subject of the document below for more detail:</p>

<table>
<tr><td>Subject:</td><td><?= $this->Html->link($doc_subject, ['controller' => "DocIncomings", 'action' => 'view', $doc_id, '_full' => true]) ?></td></tr>
<tr><td>Type:</td><td><?= $doc_type ?></td></tr>
<tr><td>Originator:</td><td><?= $doc_sender ?></td></tr>
<tr><td>Department:</td><td><?= $doc_dept ?></td></tr>
<tr><td>Recipient:</td><td>
    <?php 
        foreach ($doc_recipient as $rep) {
            echo $rep . "<br />";
        }
    ?>
</td></tr>
</table>
