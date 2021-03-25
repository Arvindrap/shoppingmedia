<?php
session_start();
$con = mysqli_connect('remotemysql.com', 'Q3q5AjEgPW', 'QUMyBKHa6a', 'Q3q5AjEgPW') or die(mysqli_error($con));
//$con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die(mysqli_error($con));

if (isset($_POST['announcement'])) {
    $image = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $image = base64_encode(file_get_contents(addslashes($image)));
    date_default_timezone_set("America/New_York");
    $title = $_POST['announcementTitle']." (<b>".date("m/d/Y")." ".date("h:i:sa")."</b>)";
    $paragraph = $_POST['announcementBox'];
if (empty($paragraph)||empty($title)) {
    header('location:home.php?error=fillintheblanks');

}else{
    $nam = $_SESSION['username'];
    $query = "insert into announcement(name,announcementTitle,announcement,image) values('$nam','$title','$paragraph','$image')";
    $result = mysqli_query($con, $query);
    if ($result) {
    header("location:home.php?success=submitted");
    } else {
        header("location:home.php?error=couldnotsubmit");
    }
}
}else if (isset($_POST['delete'])){
    $query = "delete from announcement where id='".$_POST['postID']."';";
    $result = mysqli_query($con,$query);
    if ($result) {
        header('location:home.php?success=deleted');
    } else {
        header('location:home.php?error=couldnotdelete');
    }
}
    else {
    header('location:home.php');
}