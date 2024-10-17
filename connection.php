<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "inventory_system_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect");
}

