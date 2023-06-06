<?php

echo "<p>e-Office Admin has processed your app comment/bug report. <br>New result: <strong>" . $result . "</strong>. New status: <strong>". $status . "</strong>.</p>";
echo "<p>Click link for more detail: ". $this->Html->link($brief, ['controller' => 'AppComments', 'action' => 'view', $comment_id, '_full' => true]) ."</p>";

?>