<?php

echo "<p>User <strong>" . $reporter . "</strong> has added new app comment / bug report:  "
. $this->Html->link($brief, ['controller' => 'AppComments', 'action' => 'process', $comment_id, '_full' => true]) ."</p>";


?>