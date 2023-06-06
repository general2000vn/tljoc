<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HseStat $hseStat
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

$page_heading = 'HSE';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'HSE', 'class' => "active"],
    
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

