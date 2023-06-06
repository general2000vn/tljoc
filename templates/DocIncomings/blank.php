<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocIncoming $docIncoming
 * @var string[]|\Cake\Collection\CollectionInterface $docCompanies
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $docStatuses
 * @var string[]|\Cake\Collection\CollectionInterface $docTypes
 */
?>
<?php

use Cake\I18n\FrozenDate;
use PhpParser\Node\Stmt\For_;

$page_heading = 'Documents Administration System';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'DAS', 'class' => 'active'],
    //['caption' => 'Incoming Documents', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();


?>
