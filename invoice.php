<?php 
  require 'connection.php';
  $name ="";
  $department ="";
  $b_salary ="";
  $mobile ="";
  $email ="";
  $allowance = "";
  $address ="";
  $city ="";
  $date ="";

  $id = $_GET["id"];
  if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(!isset($_GET["id"])){
      header("location: /Human Resource Management System/index.php");
      exit;
    }
    

    /**read row of selected client from database */
    $sql = "SELECT * FROM payroll WHERE id = $id";
    $result = $con -> query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/Human Resource Management System/index.php");
        exit;
    }
    

    $name = $row["worker_name"];
    $department = $row["department"];
    $b_salary = $row["basic_salary"];
    $mobile = $row["mobile"];
    $email = $row["email"];
    $allowance = $row["allowance"];
    $address = $row["place"];
    $city = $row["city"];
    $date = $row["date"];

    $subtotal = $allowance + $b_salary;

  }
    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Employee Invoice</title>
  <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripting/pdfGen.js"></script> 
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .content-wrapper {
      min-height: 482px;
      padding: 20px;
    }
    .content-header h1 {
      text-align: center;
    }
    .content-header ol.breadcrumb {
      margin-bottom: 20px;
      background-color: #f9f9f9;
      padding: 10px;
    }
    .invoice {
      margin-top: 20px;
    }
    .invoice .page-header {
      margin-top: 0;
    }
    .invoice .invoice-info {
      margin-bottom: 20px;
    }
    .invoice .invoice-col {
      float: left;
      width: 33.3333%;
    }
    .invoice table.table {
      width: 100%;
      border-collapse: collapse;
    }
    .invoice table.table th, .invoice table.table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    .invoice table.table th {
      background-color: #f2f2f2;
    }
    .invoice table.table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .invoice .lead {
      font-size: 16px;
      font-weight: bold;
    }
    .invoice .table-responsive {
      margin-top: 20px;
    }
    .invoice .table-responsive table.table {
      margin-bottom: 0;
    }
    .invoice .no-print {
      margin-top: 20px;
    }
    .invoice .no-print .btn {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="content-wrapper" id="invoice">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#00<?php echo $id; ?></small>
      </h1>
      
    </section>
    <br><br>

    <!-- Main content -->
    <section class="invoice" id="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Employee Invoice
            <!--<small class="pull-right" style="margin-left: 40%;"><?php echo $date; ?></small> -->
          </h2>
        </div>
      </div>
      <hr><br>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <p><strong>From</strong></p>
          <address>
            Bureti TTI<br>
            Sotik<br>
            Tiritamoita <br>
            Website: www.buretitechnical.ac.ke<br>
            Email: registrar@buretitechnical.ac.ke
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <p><strong>To</strong></p>
          <address>
          <?php echo $name; ?><br>
          <?php echo $city; ?><br>
          <?php echo $address; ?><br>
            Phone: <?php echo $mobile; ?><br>
            Email: <?php echo $email; ?>
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <p><strong>Invoice #00<?php echo $id; ?></strong></p>
          <p><strong>Paid On:</strong> <?php echo $date; ?></p>
        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Basic Salary</th>
                <th>Allowance</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>KSH <?php echo $b_salary; ?></td>
                <td>KSH <?php echo $allowance; ?></td>
                <td>KSH <?php echo $subtotal; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="assets/visa.png" alt="Visa">
          <img src="assets/mastercard.png" alt="Mastercard">
          
          <img src="assets/paypal.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Dear <?php echo $name; ?>, Our Company has just processed your payments. Your payment has been deposited electronically in your account on 27-05-2021
          </p>
        </div>
        <div class="col-xs-6">
          <p class="lead">Salary Info</p>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>KSH <?php echo $subtotal; ?></td>
                </tr>
                <tr>
                  <th>Tax (0%)</th>
                  <td>KSH 0</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>KSH <?php echo $subtotal; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- this row should not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="Human Resource Management System/index.php" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Back</a>
          
          <button type="button" id="btn-print" class="btn btn-danger pull-right" style="margin-right: 5px; margin-left: 80%;" ><i class="fa fa-download"></i>Print & Generate PDF</button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    
    <div class="clearfix"></div>
  </div>
  <br>
</body>
</html>
