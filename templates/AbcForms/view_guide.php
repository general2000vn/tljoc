<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AbcCampaign $abcCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $abcStatuses
 * @var \Cake\Collection\CollectionInterface|AbcCategory[] $abcCategories
 */

use App\Model\Entity\AbcStatus;
use App\Model\Table\AbcStatusesTable;

$page_heading = 'Guideline';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('HR', ['controller' => 'AbcCampaigns', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Annual Business Compliance', ['controller' => 'AbcCampaigns', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    echo $this->Html->css('../themes/sash/assets/css/my-abc-guide');
    
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    //echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
    //echo $this->Html->script(['../themes/sash/assets/plugins/fileuploads/js/fileupload', '../themes/sash/assets/plugins/fileuploads/js/file-upload']);

    //echo $this->Html->script('myORAdd');

$this->end();
$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>





<div class="row">
    <div class="col-md-12">
        <?= $this->Form->create($abcCampaign) ?>
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Form Info.</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('staff', ['label' => 'Staff', 'value' => $abcForm->user->name, 'disabled' ,  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('cperiod', ['label' => 'Year', 'value' => $abcCampaign->period, 'disabled' ,  'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('deadline', ['label' => 'Deadline', 'value' => $abcCampaign->deadline, 'disabled' ,'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('abc_form_status_id', ['label' => 'Status', 'disabled', 'options' => $abcFormStatuses, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>

        
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Our Principles</h3>
            </div>
            <div class="card-body abc_guide">
            <ul class="level-1">
                <li>We are committed to conducting our business in an honest and ethical manner. We expect that our contractors, suppliers, agents and employees will conduct themselves in the same manner.</li>
                <li>We will be honest and fair in our relationships with others. We value our relationships with our business partners, host government and local communities in Vietnam.</li>
                <li>We will apply detailed procurement and contract award procedures, consistent with our contractual obligations and the Laws of Vietnam to ensure that the Company gets best value and suppliers and contractors are treated fairly.</li>
                <li>We strive to provide a workplace where all employees are treated with respect and can fulfill their potential in a safe and healthy environment. Our expectations of staff and the Policies, Programmes and Benefits available to them are detailed in our Employee Policy and Procedures.</li>
            </ul> 
            </div>
        </div>


        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Our Expectations</h3>
            </div>
            <div class="card-body abc_guide">
            <ul class="level-1">
                <li>We expect our employees to strive to conform to the spirit and intent, as well as the technical requirements, of all contracts that we enter into and all laws, regulations and rules that govern us.</li>
                <li>We recognize that in the course of business, conflicts of interest can arise which put personal interest in conflict with the interests of the company. These include gifts or entertainment from suppliers, employment by another company, ownership of a significant part of another company or business, close or family relationships with outside suppliers. Some of these may be entirely innocent but all should be disclosed to the company, subject to guidelines below for gifts or entertainment.</li>
                <li>We require that confidential Information, which includes proprietary, technical, business, financial, joint venture, supplier and employee information should not be disclosed other than in the necessary course of business.</li>
                <li>We are committed to the prevention of bribery, both by our employees and by those performing services for or on our behalf. Employees must not offer, promise or give a financial or other advantage, in order to create, induce or reward improper behaviour. Similarly no financial or other inducement should be offered to a public official to secure a business advantage for the company.</li>
                <li>We require that hospitality, entertainment and gifts are not offered or accepted above a level that could compromise or appear to compromise the ability of our employees to make objective and fair business decisions. An acceptable level is judged against the following criteria:</li>
                    <ul class="level-2">
                        <li>the benefit is of token value</li>
                        <li>the benefit can be easily reciprocated</li>
                        <li>the exchange creates no obligation</li>
                        <li>it occurs infrequently</li>
                    </ul>
                </li>
                <li>Business lunches, the exchange of modest items between business associates, presentation of small tokens of appreciation at public functions or inexpensive memento are therefore acceptable.</li>
                <li>On an annual basis we expect our employees to complete a Business Ethics Compliance questionnaire, as attached, certifying their compliance with our Ethics Policy. Where non- compliance has occurred, the circumstances must be disclosed.</li>
            
            </ul> 
            </div>
        </div>

       

        

        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Html->link(__('I confirm that I have read the Guideline and wish to Continue'), ['action' => 'fill', $abcForm->id ], ['class' => 'btn btn-large btn-info']) ?>
                        <?= $this->Html->link(__('Cancel'), ['action' => 'my'], ['class' => 'btn btn-large btn-danger']) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
