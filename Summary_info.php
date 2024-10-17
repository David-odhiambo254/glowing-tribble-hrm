<?php
    include("functions.php");
    require 'connection.php';
  
    $department ="";
    
    $start ="";
    $end ="";
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $department = $_POST["department"];
        
        $start = $_POST["start"];
        $end = $_POST["end"];
        
        $currentDate = date("Y-m-d");

        header("location: report_sum.php?department=$department&start=$start&end=$end");
        
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
        <div class="tittle">How would you like it summerized?</div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="user-details">
                
                <div class="input-box">
                    <span class="details">From:</span>
                    <input type="date" name="start" placeholder="yy/mm/dd" value="<?php echo $start ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">To:</span>
                    <input type="date" name="end" placeholder="yy/mm/dd" value="<?php echo $end ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" placeholder="Department name" value="<?php echo $department ?>" required>
                </div>
                
            </div>
            
            <div class="button">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>