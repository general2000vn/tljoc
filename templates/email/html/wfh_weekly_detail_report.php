<p>Below is WFH Records report from  <?= $from_date . ' to ' . $to_date ?>

<ul>
<li>Check-in data unit is (/staff/day).</li>
<li>Health data is latest data on report date.</li>
</ul>
</p>

<table border="1">
    <thead>
        <th>Department</th>
        <th>Total Staff</th>
        <th>On Leave</th>
        <th>Not Check-in</th>
        <th>WFH</th>
        <th>Office</th>
        <th>Off-shore</th>
        <th>Good Health</th>
        <th>Has Symtom</th>
        <th>Fx Isolated</th>
        <th>F0 Suspected</th>
        <th>F0 Confirmed</th>
        <th>Not Vaccinated</th>
        <th>1 Shot</th>
        <th>2 Shots</th>
    </thead>
    <tbody>
        <?php foreach($data as $item): ?>
            <tr>
                <td align="right"><?= $item['name'] ?></td>
                <td align="right"><?= $item['total'] ?></td>
                <td align="right"><?= $item['leave'] ?></td>
                <td align="right"><?= $item['miss'] ?></td>
                <td align="right"><?= $item['WFH'] ?></td>
                <td align="right"><?= $item['Office'] ?></td>
                <td align="right"><?= $item['Off-Shore'] ?></td>
                <td align="right"><?= $item['good'] ?></td>
                <td align="right"><?= $item['symtom'] ?></td>
                <td align="right"><?= $item['Fx'] ?></td>
                <td align="right"><?= $item['suspected'] ?></td>
                <td align="right"><?= $item['F0'] ?></td>
                <td align="right"><?= $item['NotYet'] ?></td>
                <td align="right"><?= $item['1shot'] ?></td>
                <td align="right"><?= $item['2shot'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<br>
<p>Below is Detail list of staff who did not check in from:  <?= $from_date . ' to: ' . $to_date ?>
<table border="1">
    <thead>
        <th>Department</th>
        <th>Staff</th>
        <th>Data</th>
    </thead>
    <tbody>
        <?php foreach($data as $item): ?>
            <?php foreach($item['detail'] as $user): ?>
                <?php foreach($user->timesheets as $timesheet): ?>
                <tr>
                    <td align="right"><?= $item['name'] ?></td>
                    <td align="right"><?= $user->name ?></td>
                    <td align="right"><?= $timesheet->start_date ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>