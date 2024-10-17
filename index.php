<?php
session_start();
  
  include("connection.php");
  include("functions.php");
  $user_data = check_login($con);
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
                <li><a >
                    <i class="fas fa-wallet"><span class="material-icons">space_dashboard</span></i>
                    <span class="nav-item" data-target="department">Department</span>
                </a></li>
                <li><a >
                    <i class="fas fa-chart-bar"><span class="material-icons">groups</span></i>
                    <span class="nav-item" data-target="staff">Staff</span>
                </a></li>
                <li><a >
                    <i class="fas fa-task"><span class="material-icons">payments</span></i>
                    <span class="nav-item" data-target="salary">Salary</span>
                </a></li>
                <li><a >
                    <i class="fas fa-cog"><span class="material-icons">cruelty_free</span></i>
                    <span class="nav-item" data-target="leave">Leave</span>
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
                <h1>Hello: <?php echo $user_data['user_name']; ?> </h1> 
                <i class="fas fa-user-cog"></i>
            </div>

            <div class="main-body">                
                <div class="main-content section" id="dashboard">
                    <div class="cardbox nav-item" style="background: #0b6ed0" data-target="department">
                        <img src="assets/books.png">
                        <div class="card-detail">
                            <h2>Department</h2>
                            
                            <div class="user">
                                <p>4</p>
                                <div class="user_detail">
                                    <h4>Departments</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cardbox nav-item" style="background: #f04e4e" data-target="staff">
                        <img src="assets/leadership.png">
                        <div class="card-detail">
                            <h2>Staff</h2>
                            <div class="user">
                                <p>4</p>
                                <div class="user_detail">
                                    <h4>Hired</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <h4>Applied </h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cardbox nav-item"style="background: #34752e" data-target="salary">
                        <img src="assets/money.png">
                        <div class="card-detail">
                            <h2>Salary</h2>
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
                                <p>KSH 39640</p>
                                <div class="user_detail">
                                    <h4>paid</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/Human Resource Management System/report.php">
                    <div class="cardbox " style="background: #6280c7">
                        <img src="assets/report.png">
                        <div class="card-detail">
                            <h2 style="color: black">Reports:</h2>
                            
                            <div class="user">
                                <p></p>
                                <div class="user_detail">
                                    <h4>:</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    <a href="/Human Resource Management System/Summary_info.php">
                    <div class="cardbox " style="background: #db5b5b">
                        <img src="assets/logout.png">
                        <div class="card-detail">
                            <h2 style="color: black">Report summery</h2>
                            
                            <div class="user">
                                <p></p>
                                <div class="user_detail">
                                    <h4>View summerized report</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="section" id="department">
                    <main class="table">
                        <section class="table_header">
                            <h2>Departments</h2>
                            <a class="action shift" href="/Human Resource Management System/addDepmt.php">+</a>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        $rows = mysqli_query($con,"SELECT * FROM all_departments ORDER BY id  DESC");
                                    ?>
                                    <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td>
                                            <a class="action edit" href="/Human Resource Management System/editDepmt.php?id=<?php echo $row["id"]; ?>">Edit</a> <br>
                                            <a class="action delete" href="/Human Resource Management System/deleteDepmt.php?id=<?php echo $row["id"]; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <div class="section" id="staff">
                    <main class="table">
                        <section class="table_header">
                            <h2>Staff</h2>
                            <a class="action shift" href="/Human Resource Management System/enrolment.php">Add</a>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Department</th>
                                        <th>Task</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Joined on</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>County</th>
                                        <th>Action</th>
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
                                        <td><img src="assets/Profiles/<?php echo $row['photo']; ?>" alt="staff image"><?php echo $row["worker_name"]; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><?php echo $row["Task"]; ?></td>
                                        <td><?php echo $row["gender"]; ?></td>
                                        <td><?php echo $row["mobile"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["dob"]; ?></td>
                                        <td><?php echo $row["date"]; ?></td>
                                        <td><?php echo $row["place"]; ?></td>
                                        <td><?php echo $row["city"]; ?></td>
                                        <td><?php echo $row["County"]; ?></td> <!--County-->
                                        <td>
                                            <a class="action edit" href="/Human Resource Management System/editEmployee.php?id=<?php echo $row["id"]; ?>">Edit</a> <br>
                                            <a class="action delete" href="/Human Resource Management System/deleteEmployee.php?id=<?php echo $row["id"]; ?>">Delete</a><br>
                                            <a class="action shift" href="/Human Resource Management System/taskEmplyee.php?id=<?php echo $row["id"]; ?>">Task</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <div class="section" id="salary">
                    <main class="table">
                        <section class="table_header">
                            <h2>Salary</h2>
                            <a class="action shift" href="/Human Resource Management System/addToPayroll.php">Add to payroll</a>
                        </section>
                        <section class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Photo</th>
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
                                        $rows = mysqli_query($con,"SELECT * FROM payroll ORDER BY id  DESC");
                                        $subtotal ="";
                                    ?>
                                    <?php foreach ($rows as $row) :
                                        $subtotal = $row["allowance"] + $row["basic_salary"]; ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row["worker_name"]; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><img src="assets/payroll/<?php echo $row['photo']; ?>" alt="staff image"></td>
                                        <td><?php echo $row["basic_salary"]; ?></td>
                                        <td><?php echo $row["allowance"]; ?></td>
                                        <td><?php echo $subtotal; ?></td>
                                        <td><?php echo $row["date"]; ?></td>>
                                        <td>
                                            <a class="action edit" href="/Human Resource Management System/invoice.php?id=<?php echo $row["id"]; ?>">Invoice</a> <br>
                                            <a class="action delete" href="/Human Resource Management System/rmvPayRoll.php?id=<?php echo $row["id"]; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <div class="section" id="leave">
                    <main class="table">
                        <section class="table_header">
                            <h2>Leave History</h2>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        $rows = mysqli_query($con,"SELECT * FROM leave_app ORDER BY id  DESC");
                                    ?>
                                    <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row["staff_name"]; ?></td>
                                        
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><?php echo $row["reason"]; ?></td>
                                        <th><?php echo $row["descr"]; ?></th>
                                        <td><?php echo $row["starts"]; ?></td>
                                        <td><?php echo $row["ends"]; ?></td>
                                        <td><?php echo $row["date"]; ?></td>
                                        <td>
                                            <p class="status pending"><?php echo $row["stat"]; ?></p>
                                        </td>
                                        <td>
                                            <a class="action edit" href="/Human Resource Management System/approveLeave.php?id=<?php echo $row["id"]; ?>">Approve </a> <br>
                                            <a class="action delete" href="/Human Resource Management System/rejectLeave.php?id=<?php echo $row["id"]; ?>">Reject</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </section>
                    </main>
                </div>
                <!--The sideBar-->
                <!---->
            </div>
        </section>
    </div>
</body>
</html>
