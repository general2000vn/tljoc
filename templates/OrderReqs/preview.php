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
use Cake\I18n\Number;

$page_heading = 'ORDER REQUISITION';

$this->set('page_heading', $page_heading);

$this->start('head_css');

$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();
?>


<div class="table-top fw-bold">
  <table class="w-100">
    <tr>
      <th colspan="2">Requisition No.</td>
      <th colspan="2">Status</td>
      <th colspan="2">Department</td>
      <th colspan="2">Originator</td>
      <th colspan="2">Submit Date</td>
      <th colspan="2">Procurement Mode</td>
    </tr>
    
    <tr>
      <td colspan="2"><?= $orderReq->req_num ?></td>
      <td colspan="2"><?= $orderReq->or_status_name ?></td>
      <td colspan="2"><?= $orderReq->department->name ?></td>
      <td colspan="2"><?= $orderReq->originator->name ?></td>
      <td colspan="2"><?= $orderReq->has('submit_date') ? $orderReq->submit_date->format('Y-m-d') : '' ?></td>
      <td colspan="2"><?= $orderReq->cp_method->name ?></td>
    </tr>


    <!-- <tr>
      
      
    </tr>

    <tr>
      
      
    </tr> -->

    <tr>
      <th colspan="2">Requisition Description</td>
      <td colspan="10" class="subject"><?= $orderReq->name ?></td>
    </tr>


    <tr>  
      <th colspan="3">Company</td>
      <th colspan="3">Contract No.</td>
      <th colspan="3">Due Date</td>
      <th colspan="3">Delivery Place</td>
      
      
    </tr>

    <tr>
      <td colspan="3"><?= $orderReq->doc_company->name ?></td>
      <td colspan="3"><?= $orderReq->contract_num ?></td>
      <td colspan="3"><?= $orderReq->has('required_date') ? $orderReq->required_date->format('Y-m-d') : '' ?></td>
      <td colspan="3"><?= $orderReq->deli_address->name ?></td>
    </tr>


    <tr>
      <th colspan="3">Budget Code</td>
      <th colspan="3">Currency</td>
      <th colspan="3">Exchange Rate</td>
      <th colspan="3">Cost Estimation</td>  
    </tr>

    <tr>
      <td colspan="3"><?= $orderReq->budget_code ?></td>
      <td colspan="3"><?= $orderReq->currency->name ?></td>
      <td colspan="3" ><?= Number::format($orderReq->exch_rate, ['pattern' => '#,###']) ?></td>
      <td colspan="3" ><?= Number::format($orderReq->est_total, ['pattern' => '#,###.0']) ?></td>
    </tr>
    
  </table>
</div>

<div class="table-bottom d-flex flex-row">
  <table class=" w-100">
    <tr>
      <th colspan="1">No.</th>
      <th colspan="2">Part Number</th>
      <th colspan="5">Full description of Work or Material</th>
      <th colspan="2">Q'ty</th>
      <th colspan="2">Estimated Item Cost</th>
    </tr>

    
    <?php $i = 1; foreach ($orderReq->or_items as $item) : ?>
    <tr>
      <td colspan="1"><?= $i ?></td>
      <td colspan="2"><?= $item->code ?></td>
      <td colspan="5"><?= $item->name ?></td>
      <td colspan="2"><?= Number::format($item->quantity, ['pattern' => '#,###'])  ?></td>
      <td colspan="2"><?= Number::format($item->price, ['pattern' => '#,###.0']) ?></td>
    </tr>
    <?php $i++; endforeach; ?>
    
    <?php for ($j = $i; $j < 5; $j++) : ?>
    <tr>
      <td colspan="1" class="fw-bold">&nbsp;</td>
      <td colspan="2" class="fw-bold">&nbsp;</td>
      <td colspan="5" class="fw-bold">&nbsp;</td>
      <td colspan="2" class="fw-bold">&nbsp;</td>
      <td colspan="2" class="fw-bold">&nbsp;</td>
    </tr>
    <?php $i++; endfor; ?>

  </table>
</div>


<div>
  <table class="table-bottom d-flex flex-row w-100">
    <tr>
      <th colspan="2" class="w-20">Note</th>
      <td colspan="7" class="w-50"><?php echo $orderReq->other; ?></td>
      <th colspan="3" class="w-30">Line Department Approval</th>
    </tr>
    <tr>
      <th colspan="2">Intended Use</th>
      <td colspan="7"><?php echo $orderReq->intended_use; ?></td>
      <td colspan="3" rowspan="2">
        <?php
          
          if (!is_null($orderReq->group_leader)) {
            echo 'Group Leader: '; echo '<strong>' . $orderReq->group_leader->name . '</strong>'; echo '<br />';
            

            if (!is_null($orderReq->group_approve_time)) {
              echo 'Date & Time: '; echo $orderReq->group_approve_time->format('Y-m-d   h:m:s'); echo '<br />';
            }

            echo '<br />';
          }

          
          if (!is_null($orderReq->dept_leader)) {
            echo 'Line Manager: '; echo '<strong>' . $orderReq->dept_leader->name . '</strong>'; echo '<br />';
            

            if (!is_null($orderReq->dept_approve_time)) {
              echo 'Date & Time: '; echo $orderReq->dept_approve_time->format('Y-m-d   h:m:s'); echo '<br />';
            }

            echo '<br />';
          }
        ?>
      </td>
    </tr>
    <tr>
      <th colspan="2">Justification</th>
      <td colspan="7"><?php echo $orderReq->justification; ?></td></td>
    </tr>
    </table>


    <table class="table-bottom d-flex flex-row w-100">
    <tr>
      <th colspan="4">Vendor List</th>
      <th colspan="4">Representative</th>
      <th colspan="4">Contact</th>
    </tr>
    <?php $i = 1; foreach ($orderReq->or_suppliers as $supplier) : ?>
    <tr>
      <td colspan="4" class="fw-bold"> <?= $supplier->name ?></td>
      <td colspan="4" class="fw-bold"><?= $supplier->rep ?></td>
      <td colspan="4" class="fw-bold"><?= $supplier->contact ?></td>
    </tr>
    <?php $i++; endforeach; ?>


    <?php for ($j = $i; $j < 5; $j++) : ?>
    <tr>
      <td colspan="4" class="fw-bold">&nbsp;</td>
      <td colspan="4" class="fw-bold">&nbsp;</td>
      <td colspan="4" class="fw-bold">&nbsp;</td>
    </tr>
    <?php $i++; endfor; ?>


  </table>
</div>

<style>
  .subject {
    background-color: pink;
    text-align: left !important;
  }

  .w-20 {
    width: 20% !important;
  }

  .w-30 {
    width: 30% !important;
  }
  
  .w-33 {
    width: 33.33% !important;
  }

  .w-50 {
    width: 50% !important;
  }

  .w-80 {
    width: 80% !important;
  }

  .w-100 {
    width: 100% !important;
  }

  .mx-auto {
    margin: 0 auto !important;
  }

  .fw-bold {
    font-weight: bold !important;
  }

  .text-center {
    text-align: center !important;
  }

  .row {
    display: flex;
    flex-direction: row;
  }

  .p-0 {
    padding: 0 !important;
  }

  .p-1 {
    padding: 0.5rem !important;
  }

  .mb-0 {
    margin-bottom: 0 !important;
  }

  .my-3 {
    margin: 1.5rem 0 !important;
  }

  h2 {
    font-size: 30px;
    font-weight: bold;
    margin-top: 0;
    margin-bottom: 10px;
  }

  h4 {
    font-size: 23px;
    font-weight: bold;
    margin-top: 0;
    margin-bottom: 10px;
  }

  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 12px;
  }

  th,
  td {
    padding: 5px;
    text-align: left;
  }


  .form-2 {
    max-width: 1440px;
  }

  .form-2 .table-top th {
    text-align: center;
    background-color: rgb(31, 216, 230);
  }

  .form-2 .table-top td {
    text-align: center;

  }

  .form-2 .table-bottom th {
    text-align: center;
    background-color: rgb(31, 216, 230);
  }

  .form-2 .table-bottom-2 th {
    background-color: rgb(31, 216, 230);
  }

  .form-2 .table-bottom-2 .header-blue {
    background-color: rgb(31, 216, 230);
  }

  .form-2 .table-bottom td p,
  .form-2 .table-bottom-2 td p {
    margin-bottom: 4px;
  }

  .form-2 td {
    /* height: 30px; */
    min-height: 15px;
  }

  .form-2 .table-bottom-2 td {
    /* min-width: 90px; */
    min-width: 40px;
  }

  .text-special {
    text-align: center;
    background-color: rgb(31, 216, 230);
    margin: 0 !important;
    padding: 5px 0;
  }

  .text-blue {
    color: rgb(53, 77, 232);
  }

  .header th {
    background-color: rgb(31, 216, 230);
    text-align: center;
  }

  .header-2 {
    background-color: #ccc;
    font-weight: bold;
  }

  ul {
    margin-left: 25px;
  }

  ul li {
    list-style: decimal;
  }

  body {
    width: 794px;
    margin:0 auto;
  }
</style>