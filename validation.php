<?php

session_start();


//$con = mysqli_connect('localhost', 'root', 'Arv5n321');

//mysqli_select_db($con, 'userregistration');

$con = mysqli_connect('remotemysql.com', 'of2PGRtFAA', 'D9VDbWFaZ6');

mysqli_select_db($con, 'of2PGRtFAA');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = " select * from usertable where name = '$name' && password = '$pass'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['username'] = $name;
    header('location:home.php');
}else{
    header('location:login.php');
}
    
?>