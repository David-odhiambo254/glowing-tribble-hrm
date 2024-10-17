<?php
 require 'connection.php';
 
 $department = $_GET["department"];
 $start = $_GET["start"];
 $end = $_GET["end"];
 if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(!isset($_GET["department"])){
        echo"Didn't get the variable";
    }
     
 }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bureti Technical Institute - HR Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #e2e2e2;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <!--<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>-->
    <!--<script src="scripting/externel.js"></script>-->
   
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripting/pdfGen.js"></script> 

</head>
<body>
    <div class="container">
        <div class="content-wrapper" id="invoice">
            <div class="logo">
                <img src="assets/bureti.png" alt="Bureti Technical Institute Logo">
            </div>
            <h1>Bureti Technical Institute - HR Report</h1>
            <?php
            $rows = mysqli_query($con,"SELECT * FROM employees ORDER BY id  DESC");
            $staffCount=count(mysqli_fetch_assoc($rows));
            ?>
            <h2>Number of Employees:  <?php echo $staffCount; ?></h2>
            
            <h2>Leave Applications:</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    $rows = mysqli_query($con,"SELECT * FROM leave_app WHERE date BETWEEN '$start' AND '$end' ORDER BY id  DESC");
                ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row["staff_name"]; ?></td>
                        <td><?php echo $row["reason"]; ?></td>
                        <td><?php echo $row["starts"]; ?></td>
                        <td><?php echo $row["ends"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <h2>Employee Information:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    $rows = mysqli_query($con,"SELECT * FROM employees WHERE department = '$department' ORDER BY id  DESC");
                    
                ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row["worker_name"]; ?></td>
                        
                        <td><?php echo $row["department"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["mobile"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table><br><br>
        </div>
    </div>

    
    <!--<button type="button" id="cmd" class="btn btn-danger pull-right" style="margin-right: 5px; margin-left: 80%;" onclick="generatePDF()"><i class="fa fa-download"></i> Generate PDF</button>-->
    <button id="btn-print" class="btn btn-success btn-lg">Print & Generate PDF</button>
    <br><br>
</body>
</html>
