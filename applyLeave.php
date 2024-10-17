<?php
    include("functions.php");
    require 'connection.php';
    $name ="";
    $department ="";
    $reason ="";
    $description ="";
    $start ="";
    $end ="";
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST["name"];
        $department = $_POST["department"];
        $reason = $_POST["reason"];
        $description = $_POST["description"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $status = "Pending";
        
        $currentDate = date("Y-m-d");
        
        $check = mysqli_query($con,"SELECT * FROM employees WHERE worker_name	 = '$name' LIMIT 1");   
        if($check && mysqli_num_rows($check) > 0){
            $emp_data = mysqli_fetch_assoc($check);
            if($emp_data['department'] === $department){
                
                if($start > $currentDate && $end > $currentDate){
                    $query = "INSERT INTO leave_app (staff_name,department,reason,descr,starts,ends,stat) VALUES('$name','$department','$reason','$description','$start','$end','$status')";
                    
                    $con->query($query);
                    deleteExpiredLeave($con);
                    echo
                    "<script> 
                        alert('Successfully added');
                        document.location.href = '/Human Resource Management System/userpage.php';
                    </script> ";
                }else{
                    echo
                    "<script> 
                        alert('Sorry! No past dates allowed here');
                    </script> ";
                }
            }else{
                echo
                "<script> 
                    alert('You have entered wrong department');
                </script> ";
            }
            
        }else{
            echo
            "<script> 
                alert('No such name in our records');
            </script> ";
        }

       
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form page</title>
    <link rel="stylesheet" href="styles/form.css"></link>
</head>
<body>
    <div class="container">
        <div class="tittle">Leave application form</div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full name</span>
                    <input type="text" name="name" placeholder="Enter name" value="<?php echo $name ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" placeholder="Department name" value="<?php echo $department ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Reason</span>
                    <input type="text" name="reason" placeholder="" value="<?php echo $reason ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Description</span>
                    <input type="text" name="description" placeholder="Less than 100 words" value="<?php echo $description ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">From:</span>
                    <input type="date" name="start" placeholder="yy/mm/dd" value="<?php echo $start ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">To:</span>
                    <input type="date" name="end" placeholder="yy/mm/dd" value="<?php echo $end ?>" required>
                </div>
            </div>
            
            <div class="button">
                <input type="submit" value="Apply">
            </div>
        </form>
    </div>
</body>
</html>