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
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST["name"];
        $department = $_POST["department"];
        $b_salary = $_POST["b_salary"];
        $mobile = $_POST["mobile"];
        $email = $_POST["email"];
        $allowance = $_POST["allowance"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        
        //=========Image processing=============
        if($_FILES["image"]["error"] ===4){
            echo
            "<script> alert('Image doesn't exist'); </script>";
        }
        else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtention = explode('.', $fileName);
            $imageExtention = strtolower(end($imageExtention));
            if(!in_array($imageExtention, $validImageExtension)){
                echo
                "<script> alert('Invalid image Extention'); </script>";
            }
            elseif($fileSize > 1000000){
                echo
                "<script> alert('Image size too large'); </script>";
            }
            else{
                $rows = mysqli_query($con,"SELECT * FROM employees WHERE worker_name	 = '$name' LIMIT 1");
                //error_reporting(E_ERROR | E_PARSE);

                if($rows && mysqli_num_rows($rows) > 0){
                    $user_data = mysqli_fetch_assoc($rows);
                    if ($user_data['department'] == $department) {
                        $newImageName = uniqid();
                        $newImageName .= '.' . $imageExtention;

                        move_uploaded_file($tmpName, 'assets/payroll/'. $newImageName);
                        $query = "INSERT INTO payroll (worker_name,department,photo,mobile,email,place,city,basic_salary,allowance) VALUES('$name','$department','$newImageName','$mobile','$email','$address','$city','$b_salary','$allowance')";
                        //mysqli_query($con, $query);
                        $con->query($query);
                        echo
                        "<script> 
                            alert('Successfully added');
                            document.location.href = '/Human Resource Management System/index.php';
                        </script> ";
                        exit;
                    }else{
                        echo
                        "<script> 
                            alert('Wrong department');
                        </script> ";
                    }
                    
                }else{
                    echo
                    "<script> 
                        alert('There is no such employee in our database. Please enroll the emplyee first');
                    </script> ";
                }
            }
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
        <div class="tittle">Adding to payroll</div>
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
                    <span class="details">Mobile</span>
                    <input type="tel" pattern="[0-9]{10}" name="mobile" placeholder="07*****" value="<?php echo $mobile ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Official email" value="<?php echo $email ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Address:</span>
                    <input type="text" name="address" placeholder="eg: 3538 Tom street" value="<?php echo $address ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">City</span>
                    <input type="text" name="city" placeholder="closest city" value="<?php echo $city ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Basic salary(KSH)</span>
                    <input type="number" min="10000" max="100000" name="b_salary" placeholder="" value="<?php echo $b_salary ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Allowance(KSH)</span>
                    <input type="number" min="2000" max="15000" name="allowance" placeholder="" value="<?php echo $allowance ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Photo</span>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="<?php echo $name ?>" required>
                </div>
            </div>
            <br>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>