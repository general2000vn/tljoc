<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt[]|\Cake\Collection\CollectionInterface $hrPts
 */

 $page_heading = 'My Pre-Termination Tasks';

 $this->set('page_heading', $page_heading);

 $this->set('breadcrumbs', [
     ['caption' => 'HR', 'class' => 'active'],
     ['caption' => 'Pre-Termination', 'class' => 'active'],
     ['caption' => $page_heading, 'class' => 'active'],
 ]);
 
 $this->start('head_css');
 //echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
 $this->end();
 
 $this->start('head_scripts');
 
 $this->end();
 
 $this->start('bottom_scripts');
 echo $this->element('sash/datatable/bottom_scripts');
 echo $this->Html->script('Sash/myAbcCampaignDataTable');
 $this->end();
 
 $this->loadHelper('Form', [
     'templates' => 'sash_form_templates',
 ]);

?>


<div class="row row-sm">
    <div class="col-lg-12">
        

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pre-Terminations list</h3>
            </div>
            <div class="card-body">

                <?= $this->element('pt_task_list') ?>

            </div>
        </div>
    </div>
</div>