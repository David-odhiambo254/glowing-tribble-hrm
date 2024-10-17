
<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Something was posted
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
    // Read from database
    $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
    $sql = "SELECT * FROM employees WHERE worker_name = '$user_name' LIMIT 1";

    // Checking for user in admin table
    $result = $con->query($query);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      if ($user_data['pasword'] === $password) {
        $_SESSION['user_id'] = $user_data['user_id'];

        // Redirect user to dashboard page
        header("Location: index.php");
        die;
      }
    } else {
      // Checking for user in normal/employee table
      $feedback = $con->query($sql);

      if ($feedback && mysqli_num_rows($feedback) > 0) {
        $user_data = mysqli_fetch_assoc($feedback);
        if ($user_data['pasword'] === $password) {
          $_SESSION['user_id'] = $user_data['id'];

          // Redirect user to dashboard page
          header("Location: userpage.php");
          die;
        } else {
          echo "Wrong username or password!";
        }
      } else {
        echo "Wrong username or password!";
      }
    }
  } else {
    echo "Wrong username or password!";
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
            <div style="font-size: 20px; margin: 10px;color:mwhite; ">Login</div>
            <input id ="text"type="text" name= "user_name"><br><br>
            <input id ="text"type="password" name= "password"><br><br>

            <input id ="button"type="submit" name= "login"><br><br>
            <a href='signup.php'>Click to Signup</a><br><br>
        </form>
    </div>
</body>
</html>