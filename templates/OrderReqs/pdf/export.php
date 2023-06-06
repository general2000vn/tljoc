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
      <th>DEPT.</th>
      <th>REQ. NO:</th>
      <th>PO TYPE:</th>
      <th>REQUIRED DATE / DUE DELIVERY</th>
      <th>VENDOR CODE:</th>
      <th>CONTRACT NO.:</th>
      <th>BUDGET REF.:</th>
      <th>CURRENCY:</th>
      <th>IN-CHARGE:</th>
    </tr>
    <tr>
      <td>ADM</td>
      <td>HL-ADM-23-R001</td>
      <td>PO</td>
      <td>8 weeks</td>
      <td></td>
      <td></td>
      <td>FA-01</td>
      <td>VND</td>
      <td>THAnh</td>
    </tr>
  </table>
</div>

<div class="table-bottom d-flex flex-row">
  <table class=" w-100">
    <tr>
      <th>No.</th>
      <th>Budget Code</th>
      <th>FULL DESCRIPTION OF WORK OR MATERIALS WITH PART NUMBERS</th>
      <th>Q'ty</th>
      <th>Estimated Cost</th>
    </tr>
    <tr>
      <td class="text-center">1</td>
      <td>HL - FA-01</td>
      <td>
        <h4> Plotter HP DesignJet T1708 44inch</h4>
        <p> Available in 1118 mm (44")</p>
        <p>
          Up to 26 sec/page on A1, 116 A1 prints per hour⁴ 6 inks (C, M, Y, G, pK, mK)
        </p>
        <p>
          One roll 128 GB virtual memory⁶
        </p>
      </td>
      <td class="text-center">1</td>
      <td></td>
    </tr>
    <tr>
      <td class="text-center">2</td>
      <td>HL - FA-01</td>
      <td>
        <h4>Plotter HP DesignJet T1708 44inch</h4>
        <p>Available in 1118 mm (44")</p>
        <p>
          Up to 26 sec/page on A1, 116 A1 prints per hour⁴ 6 inks (C, M, Y, G, pK, mK)
        </p>
        <p>
          One roll 128 GB virtual memory⁶
        </p>
      </td>
      <td class="text-center">1</td>
      <td></td>
    </tr>
    <tr>
      <td class="text-center"></td>
      <td></td>
      <td>
        <h4></h4>
        <p></p>
        <p></p>
        <p></p>
      </td>
      <td class="text-center"></td>
      <td></td>
    </tr>
    <tr>
      <td class="text-center"></td>
      <td></td>
      <td>
        <h4></h4>
        <p></p>
        <p></p>
        <p></p>
      </td>
      <td class="text-center"></td>
      <td></td>
    </tr>
    <tr>
      <td class="text-center"></td>
      <td></td>
      <td>
        <h4></h4>
        <p></p>
        <p></p>
        <p></p>
      </td>
      <td class="text-center"></td>
      <td></td>
    </tr>
    <tr class="fw-bold">
      <td></td>
      <td></td>
      <td>Est. Total Price:</td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>


<div>
  <table class="table-bottom-2 w-100">
    <tr>
      <th>Note</th>
      <td colspan="3">abcdef</td>
    </tr>
    <tr>
      <th>INTENDED USE</th>
      <td colspan="3">
        <p>Replace end-of-life Plotter for SUB,</p>
        <p>Replace failed and end-of-life A3 Printer for PRD + PRJ + DRI</p>
      </td>
    </tr>
    <tr>
      <th>JUSTIFICATION:</th>
      <td colspan="3">
        <p>HP T1100 plotter in SUB area is 15 years old and end-of-life</p>
        <p>HP LJ 5550 A3 color printer in 20HV is 14 years old, failed and end-of-life</p>
      </td>
    </tr>
    <tr>
      <th>Vendor List</th>
      <th>Representative</th>
      <th>Contact</th>
      <th>Delivery</th>

    </tr>
    <tr>
      <td class="fw-bold"></td>
      <td class="fw-bold">VanPhatDat</td>
      <td class="fw-bold">CMC</td>
      <td class="fw-bold" rowspan="2"></td>
    </tr>
    <tr>
      <td class="fw-bold"></td>
      <td class="fw-bold">InfoNet</td>
      <td class="fw-bold">HPT</td>
    </tr>

    <tr>
      <td class="fw-bold"></td>
      <td class="fw-bold">Lạc Việt</td>
      <td class="fw-bold">FPT</td>
      <td rowspan="4">
        <p class="text-special fw-bold">LINE DEPARTMENT APPROVAL:</p>
        <p>LINE DEPARTMENT APPROVAL:</p>
        <p>LINE DEPARTMENT APPROVAL:</p>
      </td>
    </tr>
    <tr>
      <td class="fw-bold"></td>
      <td class="fw-bold">Qi</td>
      <td class="fw-bold">NPT</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>

  </table>
</div>

<style>
  .w-20 {
    width: 20% !important;
  }

  .w-33 {
    width: 33.33% !important;
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
    height: 30px;
  }

  .form-2 .table-bottom-2 td {
    min-width: 90px;
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
</style>