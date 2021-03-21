<?php 

if(isset($_POST['submit_data'])){
    
    require_once('config/db_connect.php');
    $title = mysqli_real_escape_string($con, $_POST['Article_title']);
    $content = mysqli_real_escape_string($con, $_POST['Article_content']);
    
    if(!empty($title) || !empty($content)){
        
        $sql = "INSERT INTO item(Article_title,Article_content) VALUES('$title','$content');";
        $execute = mysqli_query($con,$sql);
        
        if(!$execute){
            echo "Published Successfully";
            exit();
        }else{
            echo "Published Successfully";
            exit();
        }
        
    }else{
        header('Location: home.php?emptyFields');
        exit();
    }
    
    
}else{
    header('Location: home.php?invalidRequest');
    exit();
}




?>

