<?php

session_start();



$con = mysqli_connect('localhost', 'root', 'Arv5n321');

mysqli_select_db($con, 'userregistration');

//$con = mysqli_connect('freedb.tech', 'freedbtech_arvindra', 'Arv5n321');

//mysqli_select_db($con, 'freedbtech_remote');

$secret = '6Lcd9rAaAAAAABxViDxp0gz_YnM4vUhC18T-jOoc';
$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' .$secret. '&response=' . $_POST['g-recaptcha-response']);
$responseData = json_decode($verifyResponse);


$name = $_POST['user'];
$pass = $_POST['password'];

$s = " select * from usertable where name = '$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($responseData->success) {
    if($num == 1){
        echo '<link rel="stylesheet" type="text/css" href="style.css">
              <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              >';
        echo "<div class='container'>";
        echo "<a class='float-middle' href='back.php'> GO BACK <p></a>" ;
        echo "<a style='text-align: center;'><p>The username is already taken</a>";
        echo "</div>";
    }else{
        $reg= " insert into usertable(name , password) values ('$name' , '$pass')";
        mysqli_query($con, $reg);
        echo" Registration Successful";
        header('location:login.php');
    }
}else{
    echo '<link rel="stylesheet" type="text/css" href="style.css">
              <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              >';
    echo "<div class='container'>";
    echo "<a class='float-middle' href='back.php'> GO BACK <p></a>" ;
    echo" <a style='text-align: center;'><p>You must verify if you are a robot</a>";
    echo "</div>";
}
    
?>