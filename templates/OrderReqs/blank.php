<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderReq $orderReq
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 * @var string[]|\Cake\Collection\CollectionInterface $currencies
 * @var string[]|\Cake\Collection\CollectionInterface $originators
 * @var string[]|\Cake\Collection\CollectionInterface $deliAddresses
 * @var string[]|\Cake\Collection\CollectionInterface $singleSources
 * @var string[]|\Cake\Collection\CollectionInterface $groupLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $deptLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $finLeaders
 * @var string[]|\Cake\Collection\CollectionInterface $orStatuses
 */

use App\Model\Table\OrUploadsTable;

$page_heading = 'Order Requisition';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
//echo $this->Html->script(['../themes/sash/assets/plugins/fileuploads/js/fileupload', '../themes/sash/assets/plugins/fileuploads/js/file-upload']);

echo $this->Html->script('myOREdit');

$this->end();


?>

