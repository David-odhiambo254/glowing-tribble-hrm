<?php
    require 'connection.php';
    $name ="";
    $department ="";
    $gender ="";
    $mobile ="";
    $email ="";
    $dob ="";
    $address ="";
    $city ="";
    $password ="";
    $county ="";
    
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
            header("location:/Human Resource Management Systemr/index.php");
            exit;
        }
        

        $name = $row["worker_name"];
        $department = $row["department"];
        $gender = $row["gender"];
        $mobile = $row["mobile"];
        $email = $row["email"];
        $dob = $row["dob"];
        $address = $row["place"];
        $city = $row["city"];
        $county = $row["County"];
        $password = $row["password"];
        

    }
    else{
        // POST method: Update client data
        $name = $_POST["name"];
        $department = $_POST["department"];
        $gender = $_POST["gender"];
        $mobile = $_POST["mobile"];
        $email = $_POST["email"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $county = $_POST["county"];
        $password = $_POST["password"];

        $sql = "UPDATE employees ".
        "SET worker_name ='$name',department = '$department' ,gender='$gender',mobile='$mobile',email='$email',dob='$dob',place='$address',city='$city',County='$county',password='$password'".
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
        <div class="tittle">Editing</div>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full name</span>
                    <input type="text" name="name" placeholder="Enter name" value="<?php echo $name; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" placeholder="Department name" value="<?php echo $department; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Mobile</span>
                    <input type="tel" pattern="[0-9]{10}" name="mobile" placeholder="07****" value="<?php echo $mobile; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Official email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">D.O.B</span>
                    <input type="date" name="dob" placeholder="yy/mm/dd" value="<?php echo $dob; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Address:</span>
                    <input type="text" name="address" placeholder="eg: 3538 Tom street" value="<?php echo $address; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">City</span>
                    <input type="text" name="city" placeholder="closest city" value="<?php echo $city; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">County</span>
                    <input type="text" name="county" placeholder="County of residence" value="<?php echo $county; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="******" value="<?php echo $name; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Photo</span>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="<?php echo $name; ?>" >
                </div>
            </div>
            <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="male">
                <input type="radio" name="gender" id="dot-2" value="female">
                <input type="radio" name="gender" id="dot-3" value="other">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Rather not say</span>
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Change">
            </div>
        </form>
    </div>
</body>
</html>
