<?php
echo "<p>Dear all,</p>";

echo "<p>This is just friendly reminding!</p>";

echo "You have pending task(s) related to below Pre-Termination:<br />";
echo "Name: <strong>" .$hrPt->staff->name . "</strong><br />";
echo "Position: " . $hrPt->position . "<br />";
echo "Department: " . $hrPt->department . "<br />";
echo "Employment Type: " . $hrPt->emp_type . "<br />";
echo "Last working date: " . $hrPt->last_date. "<br />";
echo "Official last date: " . $hrPt->o_last_date. " <br />";

echo "<p>Please kindly add some note/remark for pending tasks.</p>";

echo "<p>For more detail: " . $this->Html->link("Click on this Link", ['controller' => "HrPts", 'action' => 'process', $hrPt->id, '_full' => true]) . "</p>";

?>