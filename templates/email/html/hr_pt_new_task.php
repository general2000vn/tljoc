<?php

echo '<p>Dear all,</p>';

echo "<p>We are pleased to inform you that " . $title . " <strong>" . $name . "</strong> will end working at HLHVJOCs from <strong>" . $last_date . "</strong> (Official last date: <strong>" . $o_last_date . "</strong>)</p>";

echo "Position: " . $position . "<br />";
echo "Department: " . $department . "<br />";
echo "Employment Type: " . $emp_type . "<br />";

echo "<p>Please complete your task related to Pre-Termination procedures in the " . $this->Html->link("Link", ['controller' => "HrPts", 'action' => 'process', $id, '_full' => true]) . "</p>";

?>