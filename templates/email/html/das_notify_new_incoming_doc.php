<?php

echo '<p>Dear All,' ;
//foreach ($people as $person) {echo $person['title'] . ' ' . $person['name'] . ', ' ;}
echo '</p>';

echo "<p>Please be informed that your department has new Incoming Document. Please kindly click on the subject of the document below for more detail:</p>";

echo "Subject: " . $this->Html->link($doc_subject, ['controller' => "DocIncomings", 'action' => 'view', $doc_id, '_full' => true]) . "<br />";
echo "Type:    " . $doc_type . "<br />";
echo "Sender:  " . $doc_sender . "<br />";

?>