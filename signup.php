<?php
session_start();
  include("connection.php");
  include("functions.php");
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //save to database:
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,pasword) values ('$user_id', '$user_name', '$password')";

        //mysqli_query($con, $query);
        $con->query($query);

        // redirect user to login page
        header("Location: login.php");
        die;
    }else
    {
        echo "Please enter a valid input" ;
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
        }
        #button{
            padding: 10px;
            width: 100px;
            color:white;
            background-color: lightblue;
            border:none;
        }
        #box{
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
    <div id="box">
        <form method= "post">
            <div style="font-size: 20px; margin: 10px;color:mwhite; ">Signup</div>
            <input id ="text"type="text" name= "user_name"><br><br>
            <input id ="text"type="password" name= "password"><br><br>

            <input id ="button"type="submit" name= "signup"><br><br>
            <a href='login.php'>Click to login</a><br><br>
        </form>
    </div>
</body>
</html>
