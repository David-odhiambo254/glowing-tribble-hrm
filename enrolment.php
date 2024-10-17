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
    $county ="";
    $password ="";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
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

        $currentDate = date("Y-m-d");
        
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
                
                
                $rows = mysqli_query($con,"SELECT department FROM all_departments WHERE department	 = '$department' LIMIT 1");
                //$dept = mysqli_fetch_assoc($rows);
                if($rows && mysqli_num_rows($rows) > 0){
                    
                    if($dob < $currentDate){
                        $newImageName = uniqid();
                        $newImageName .= '.' . $imageExtention;
                        move_uploaded_file($tmpName, 'assets/Profiles/'. $newImageName);
                        $query = "INSERT INTO employees (worker_name,photo,department,gender,mobile,email,dob,place,city,County,pasword) VALUES('$name','$newImageName','$department','$gender','$mobile','$email','$dob','$address','$city','$county','$password')";
                        //mysqli_query($con, $query);
                        $con->query($query);
                        echo
                        "<script> 
                            alert('Successfully added');
                            document.location.href = '/Human Resource Management System/index.php';
                        </script> ";
                    }else{
                        echo
                        "<script> 
                            alert('Employee can not be born in the future');
                        </script> ";
                    }
                }else{
                    echo
                    "<script> 
                        alert('Department given does not exist Please add it to the department section first');
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
        <div class="tittle">Registration</div>
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
                    <span class="details">D.O.B</span>
                    <input type="date" name="dob" placeholder="yy/mm/dd" value="<?php echo $dob ?>" required>
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
                    <span class="details">County</span>
                    <input type="text" name="county" placeholder="county of stay" value="<?php echo $county ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="******" value="<?php echo $name ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Photo</span>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="<?php echo $name ?>" required>
                </div>
            </div>
            <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="male" required>
                <input type="radio" name="gender" id="dot-2" value="female" required>
                <input type="radio" name="gender" id="dot-3" value="other" required>
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
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>