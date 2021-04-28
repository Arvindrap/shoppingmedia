<?php
session_start();

$con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die('Error in connection');

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$message = $_POST["message"];

$output="";

$sql = "INSERT INTO messages (FromUser, ToUser, Message) VALUES ('$fromUser','$toUser','$message')";

if($con->query($sql))
{
    $output.="";
}else{
    $output.="Error. Please try again.";
}

echo $output;


?>