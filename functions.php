<?php
function check_login($con){
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        
    }
    //redirecting to login page
    header("location: login.php");
    die;
}
function check_login2($con){
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from employees where id = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        
    }
    //redirecting to login page
    header("location: login.php");
    die;
}
function random_num($length)
{
    $text = "";
    if($length < 5 )
    {
        $length = 5 ;
    }
    $len = rand(4,$length);
    for($i=0; $i < $len; $i++)
    {
        $text .= rand(0,9);
    }
    return $text;
}

function deleteExpiredLeave($con){
    
    // Get the current date
    $currentDate = date("Y-m-d");

    // Retrieve leave entries with expiry dates in the past
    $sql = "SELECT * FROM leave_app WHERE ends < '$currentDate'";
    $result = mysqli_query($con, $sql);

    // Delete the expired leave entries
    while ($row = mysqli_fetch_assoc($result)) {
        $leaveId = $row['id'];
        $deleteSql = "DELETE FROM leave_app WHERE id = $leaveId";
        mysqli_query($con, $deleteSql);
    }

    // Close the database connection
    mysqli_close($con);
}