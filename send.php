<?php 

session_start();


$con = mysqli_connect("freedb.tech", "freedbtech_arvindra", "Arv5n321", "freedbtech_remote");
if(!con){
    die("connection failed".mysqli_connect_error());
}



$msg = $_POST['msg'];
$name = $_SESSION['username'];

$sql = "insert into message(msg, name) values('$msg', '$name')";
$result=$con->query($sql);

header('location:home.php');








?>
