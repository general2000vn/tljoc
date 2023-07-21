<?php

echo '<p>Dear All,' ;
// clear name list
//echo '<p>Dear '; foreach ($people as $person) {echo $person['title'] . ' ' . $person['name'] . ', ' ;}
echo '</p>';

echo "<p>Please be informed that there is new Outgoing Document. Please kindly click on the subject of the document below for more detail:</p>";

echo "Subject: " . $this->Html->link($doc_subject, ['controller' => "DocIncomings", 'action' => 'view', $doc_id, '_full' => true]) . "<br />";
echo "Type:    " . $doc_type . "<br />";
echo "Originator:  " . $doc_sender . "<br />";
echo "Department:  " . $doc_dept . "<br />";

?>