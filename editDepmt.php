<?php
    require 'connection.php';
    
    $department ="";
    
    
    $id = $_GET["id"];
    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if(!isset($_GET["id"])){
            header("location: /Inventory Server/index.php");
            exit;
        }
        

        /**read row of selected client from database */
        $sql = "SELECT * FROM all_departments WHERE id = $id";
        $result = $con -> query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("location:/Human Resource Management System/index.php");
            exit;
        }
        

        
        $department = $row["department"];
        

    }
    else{
        // POST method: Update client data
        
        $department = $_POST["department"];
       

        $sql = "UPDATE all_departments ".
        "SET department = '$department'".
        "WHERE id = $id";

        $result = $con -> query($sql);

        if(!$result){
            echo"Error". $con->error;
            die;
        }
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
        <div class="tittle">Change department</div>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="user-details">
                
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" placeholder="Department name" value="<?php echo $department; ?>" required>
                </div>
                
            <div class="button">
                <input type="submit" value="Save changes">
            </div>
        </form>
    </div>
</body>
</html>
