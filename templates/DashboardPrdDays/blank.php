<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay $dashboardPrdDay
 * @var \Cake\Collection\CollectionInterface|string[] $oilFields
 */
$page_heading = 'PRD Statistics';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [

    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();


?>

