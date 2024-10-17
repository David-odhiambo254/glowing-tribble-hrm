<?php
session_start();
  
  include("connection.php");
  include("functions.php");
  $user_data = check_login2($con);
  $user_name = $user_data['worker_name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css"></link>
    <link rel="stylesheet" href="styles/table.css"></link>
    <script defer src="scripting/sections.js"></script> 
    <!--Icons(Google fonts)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
</head>
<body>
  <span class="material-icons">account_circle</span><!--logo-->
    <div class="container">
        <nav><!--navigationBar-->
            <ul>
                <li><a  class="logo">
                    <a><img src="assets/bureti.png"></a>
                    <span class="nav-item" >Navigation:</span>
                </a></li>
                <li><a >
                    <i class="fas fa-user"><span class="material-icons">speed</span></i>
                    <span class="nav-item" data-target="dashboard">Dashboard</span>
                </a></li>
                <li><a href="#">
                    <i class="fas fa-task"><span class="material-icons">payments</span></i>
                    <span class="nav-item" data-target="salary">Salary</span>
                </a></li>
                <li><a href="#">
                    <i class="fas fa-cog"><span class="material-icons">cruelty_free</span></i>
                    <span class="nav-item" data-target="leave">Leave</span>
                </a></li>
                <li><a href="#">
                    <i class="fas fa-cog"><span class="material-icons">fact_check</span></i>
                    <span class="nav-item" data-target="taskList">Task list</span>
                </a></li>
                <li><a href="/Human Resource Management System/logout.php">
                    <i class="fas fa-cog"><span class="material-icons">logout</span></i>
                    <span class="nav-item" data-target="leave">Signout</span>
                </a></li>
            </ul>
        </nav><!--navigationBar_End-->
        <!--MAIN SECTION-->
        <section class="main">
            <div class="main-top">
                <h1>Hello: <?php echo $user_data['worker_name']; ?> </h1> 
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="main-body">                
                <div class="main-content section" id="dashboard">
                    <div class="cardbox nav-item" style="background: #ff4800e5" data-target="leave">
                        <img src="assets/log-out.png">
                        <div class="card-detail">
                            <h2>Leave</h2>
                            <span class="views">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="likes">
                                <i class="fab fa-gratipay"></i>
                            </span> 
                            <span class="comment">
                                <i class="fas fa-comment"></i>
                            </span>
                            <div class="user">
                                <p>0</p>
                                <div class="user_detail">
                                    <h4>Leave requests </h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section" id="salary">
                    <main class="table">
                        <section class="table_header">
                            <h2>Salary</h2>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Basic salary</th>
                                        <th>Allowance</th>
                                        <th>Total Amount</th>
                                        <th>Payed on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        
                                        $result = mysqli_query($con,"SELECT * FROM payroll WHERE worker_name = '$user_name'");
                                        
                                        if (mysqli_num_rows($result) > 0) {
                                            // Fetch the user's data as an associative array
                                            $row = mysqli_fetch_assoc($result);

                                            echo "<tr>";
                                            echo "<td>1</td>";
                                            echo "<td>".$row['worker_name']."</td>";
                                            echo "<td>".$row['department']."</td>";
                                            echo "<td>".$row['basic_salary']."</td>";
                                            echo "<td>".$row['allowance']."</td>";
                                            echo "<td>".$row['total_amt']."</td>";
                                            echo "<td>".$row['date']."</td>";
                                           
                                            echo "<td><a class='action edit' href='/Human Resource Management System/invoice.php?id=".$row['id']."'>Invoice</a></td>";
                                            
                                            echo "</tr>";
                                        } else{
                                            echo "<p>"."Oops! You you are probably not in the payroll"."</p>";
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <div class="section" id="leave">
                    <main class="table">
                        <section class="table_header">
                            <h2>Leave History</h2>
                            <a class="action shift" href="/Human Resource Management System/applyLeave.php">Apply</a>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Staff</th>
                                       
                                        <th>Department</th>
                                        <th>Reason</th>
                                        <th>Description</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Applied On</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        
                                        $result = mysqli_query($con,"SELECT * FROM leave_app WHERE staff_name = '$user_name'");
                                        
                                        if (mysqli_num_rows($result) > 0) {
                                            // Fetch the user's data as an associative array
                                            $row = mysqli_fetch_assoc($result);

                                            echo "<tr>";
                                            echo "<td>1</td>";
                                            echo "<td>".$row['staff_name']."</td>";
                                            echo "<td>".$row['department']."</td>";
                                            echo "<td>".$row['reason']."</td>";
                                            echo "<td>".$row['descr']."</td>";
                                            echo "<td>".$row['starts']."</td>";
                                            echo "<td>".$row['ends']."</td>";
                                            echo "<td>".$row['date']."</td>";
                                           
                                            echo "<td><p class='status pending'>".$row["stat"]."</p></td>";
                                            
                                            echo "</tr>";
                                        } else{
                                            echo "<p>"."You have not applied for leave yet"."</p>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <div class="section" id="taskList">
                    <main class="table">
                        <section class="table_header">
                            <h2>Task List</h2>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Staff</th>
                                        <th>Department</th>
                                        <th>Task</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        $rows = mysqli_query($con,"SELECT * FROM employees ORDER BY id  DESC");
                                    ?>
                                    <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row["worker_name"]; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><?php echo $row["Task"]; ?></td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                
            </div>
        </section>
    </div>
</body>
</html>
