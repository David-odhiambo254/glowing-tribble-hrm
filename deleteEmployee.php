<?php 
require 'connection.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "DELETE FROM employees WHERE id = $id";
    $con -> query($sql);
}
header("location:/Human Resource Management System/index.php");
exit;
?>