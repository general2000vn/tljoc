<?php
echo '<p>Dear ' . $hrPt->creator->title . ' ' . $hrPt->creator->name . '</p>';

echo "<p>Please be informed that the Pre-Termination for " . $hrPt->staff->title . " <strong>" . $hrPt->staff->name . "</strong> has been completed !</p>";

echo "Position: " . $position . "<br />";
echo "Department: " . $department . "<br />";
echo "Employment Type: " . $emp_type . "<br />";
echo "Last day: " . $last_date . "<br />";
echo "Official Last day: " . $o_last_date . "<br />";

echo "<p>For more detail, click on " . $this->Html->link("this Link", ['controller' => "HrPts", 'action' => 'process', $hrPt->id, '_full' => true]) . "</p>";

?>