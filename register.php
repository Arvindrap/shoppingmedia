<?php

session_start();



//$con = mysqli_connect('localhost', 'root', 'Arv5n321');

//mysqli_select_db($con, 'userregistration');

$con = mysqli_connect('freedb.tech', 'freedbtech_arvindra', 'Arv5n321');

mysqli_select_db($con, 'freedbtech_remote');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = " select * from usertable where name = '$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    echo" The username is already taken";
}else{
    $reg= " insert into usertable(name , password) values ('$name' , '$pass')";
    mysqli_query($con, $reg);
    echo" Registration Successful";
    header('location:login.php');
}
    
?>
