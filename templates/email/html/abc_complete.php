
Dear Sir/Madam <?= $creator_name ?>
<br /> 
<br />
<p>Your Annual Business Compliance campaign is completed:</p>
<table>
    <tr>
        <td width="20%">Year:</td>
        <td width="80%"><strong><?= $this->Html->link($period , ['controller' => "AbcCampaigns", 'action' => 'viewStat', $campaign_id, '_full' => true]) ?></strong></td>
    </tr>
    <tr>
        <td width="20%">Deadline:</td>
        <td width="80%"><?= $deadline ? $deadline : '' ?></td>
    </tr>
    <tr>
        <td width="20%">Link:</td>
        <td width="80%"><?= $this->Html->link('Click here to fill online form', ['controller' => "AbcCampaigns", 'action' => 'viewStat', $campaign_id, '_full' => true]) ?></td>
    </tr>

</table>

