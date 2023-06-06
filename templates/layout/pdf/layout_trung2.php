<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_heading ?></title>
</head>

<body width="794">
  <!-- Page Header -->
  <div class="form-2 w-100 mx-25 py-15">
    <div class="row my-3">
      <div class="w-20 text-center">
        <?= $this->Html->image('branding/HLHV-Logo-small.jpg', ['fullBase' => true]); ?>
      </div>

      <div class="w-80 text-center">
        <h2><?= $page_heading ?></h2>
      </div>


    </div>

    <!-- End Page Header -->



    <!-- Page Contain -->
    <div>
      <?= $this->fetch('content'); ?>
    </div>
    <!-- End Page Contain -->




    <!-- Page Footer -->
    <div>

    </div>
    <!-- End Page Footer -->

  </div>

  <!-- Inline Style -->
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
  <!-- End Inline Style -->

</body>

</html>