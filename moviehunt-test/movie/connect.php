<?php
$servername="localhost";
$username="root";
$password="";
$databasename="register";
$conn=mysqli_connect($servername,$username,$password,$databasename);
if(!$conn){
    die("Connection failed".mysqli_connect_error());
}
?>