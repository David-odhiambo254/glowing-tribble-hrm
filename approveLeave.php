<?php 
require 'connection.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $status ="Approved";
    $sql = "UPDATE leave_app ".
    "SET stat ='$status'".
    "WHERE id = $id";
    $con -> query($sql);
}
header("location:/Human Resource Management System/index.php");
exit;
?>