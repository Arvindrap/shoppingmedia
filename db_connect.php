<?php

$server_name = 'localhost';
$server_user = 'root';
$server_pass = 'Arv5n321';
$Db_name = 'ckeditor';

$con = mysqli_connect($server_name,$server_user,$server_pass,$Db_name);

if(!$con){
    echo "Failed to connect to the server";
    exit();
}
    
    
    
    
    

?>