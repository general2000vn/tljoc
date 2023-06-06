<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt[]|\Cake\Collection\CollectionInterface $hrPts
 */

$page_heading = 'Pre-Termination';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [

    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->element('scripts_datatable');
$this->end();



?>
