<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoing $docOutgoing
 * @var string[]|\Cake\Collection\CollectionInterface $docCompanies
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $docStatuses
 * @var string[]|\Cake\Collection\CollectionInterface $docTypes
 */
$page_heading = 'Department Internal Documents';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    ['caption' => 'Internal Documents', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myDataTable');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

?>

<?= $this->element('das/doc_internal_search') ?>

<?= $this->element('das/doc_internal_list') ?>
