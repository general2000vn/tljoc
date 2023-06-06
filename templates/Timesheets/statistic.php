<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timesheet[]|\Cake\Collection\CollectionInterface $timesheets
 */
?>

<?php
$page_heading = 'Today WFH Record Statistic';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', []);
/*    ['caption' => 'Reports', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);
*/

$this->start('head_css');
    echo $this->Html->css('../assets/plugins/charts-c3/plugin');
$this->end();

$this->start('bottom_scripts');
    echo $this->Html->script('../assets/bundles/c3.bundle');
    echo $this->Html->script('timesheets_stat');
$this->end();

?>

<script>
    var myColumns;
</script>
<div class="row clearfix">
    <?php foreach ($groups as $group) : ?>
    <div class="col-md-4">
        <div class="card">
            <div class="header">
                <h2><strong><?= $group->name ?></strong></h2>
                <script>
                    var myPie<?= $group->id ?> = [['data1', <?= $group->leave ?>],['data2', <?= $group->checked ?>],['data3', <?= $group->active - $group->checked ?>],];
                   
                </script>
            </div>
            <div class="body text-center">
                <div id="myPie<?= $group->id ?>" class="myPieChart c3_chart d_distribution"></div>
                
                <?= $this->Html->link('View Detail', ['controller' => 'Timesheets', 'action' => 'deptDaily', $group->id], ['class' => 'btn btn-primary mt-4 mb-4']) ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>