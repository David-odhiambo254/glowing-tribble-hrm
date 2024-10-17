<?php
    require 'connection.php';
    $task ="";
    
    $id = $_GET["id"];
    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if(!isset($_GET["id"])){
            header("location: /Human Resource Management System/index.php");
            exit;
        }
        
        /**read row of selected client from database */
        $sql = "SELECT * FROM employees WHERE id = $id";
        $result = $con -> query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("location:/Human Resource Management System/index.php");
            exit;
        }
        

        $task = $row["Task"];
        

    }
    else{
        // POST method: Update client data
        $task = $_POST["task"];

        $sql = "UPDATE employees ".
        "SET Task ='$task'".
        "WHERE id = $id";

        $result = $con -> query($sql);

        if(!$result){
            echo"Error". $con->error;
            die;
        }
        echo
            "<script> 
                alert('Assigned successfully ');
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
        <div class="tittle">What task would you like to give ?</div>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Task</span>
                    <input type="text" name="task" placeholder="" value="<?php echo $task; ?>" >
                </div>
               
            </div>
            
            <div class="button">
                <input type="submit" value="Assign">
            </div>
        </form>
    </div>
</body>
</html>
