<?php
    require 'connection.php';
    $department ="";
   

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $department = $_POST["name"];
       
        $query = "INSERT INTO all_departments (department) VALUES('$department')";
        //mysqli_query($con, $query);
        $con->query($query);
        echo
        "<script> 
            alert('Successfully added');
            document.location.href = '/Human Resource Management System/index.php';
        </script> ";
        
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
        <div class="tittle">Adding department</div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Department name</span>
                    <input type="text" name="name" placeholder="Enter name" value="<?php echo $department ?>" required>
                </div>
                
                
            </div>
            
            <div class="button">
                <input type="submit" value="Add Department">
            </div>
        </form>
    </div>
</body>
</html>