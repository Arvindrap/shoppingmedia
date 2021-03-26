<?php 

session_start();


$con = mysqli_connect("remotemysql.com", "of2PGRtFAA", "D9VDbWFaZ6", "of2PGRtFAA");
if(!con){
    die("connection failed".mysqli_connect_error());
}

//$con = mysqli_connect("localhost", "root", "Arv5n321", "userregistration");
//if(!con){
  //  die("connection failed".mysqli_connect_error());
//}

$msg = $_POST['msg'];
$name = $_SESSION['username'];

$sql = "insert into message(msg, name) values('$msg', '$name')";
$result=$con->query($sql);

header('location:home.php');








?>