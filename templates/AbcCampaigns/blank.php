<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

$page_heading = 'Human Resources related functions';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

