<?php

session_start();

//$con = mysqli_connect('freedb.tech', 'freedbtech_arvindra', 'Arv5n321');

//mysqli_select_db($con, 'freedbtech_remote');


$con = mysqli_connect('localhost', 'root', 'Arv5n321');

mysqli_select_db($con, 'userregistration');

$namee = '';
$comment = '';

$comment_length = strlen($comment);

if($comment_length > 100) {
    header("location: home.php?error=1");
}else {
    $post_id = $_POST['postid'];
    $namee = $_SESSION['username'];
    $comment = $_POST['commentbox'];
    $query = "INSERT INTO comment(post_id,name,comment) VALUES('$post_id','$namee','$comment')";
    $result = mysqli_query($con, $query);
    if ($result) {
    header("location:home.php?success=submitted");
    } else {
        header("location:home.php?error=couldnotsubmit");
    }
}



?>