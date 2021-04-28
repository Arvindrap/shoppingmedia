<?php

session_start();

$con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die('Error in connection');

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$output="";

$chats = mysqli_query($con, "SELECT * FROM messages WHERE (FromUser = '".$fromUser."' AND ToUser = '".$toUser."') OR (FromUser = '".$toUser."' AND ToUser = '".$fromUser."') ") or die("Failed to query database".mysql_error());

while($chat = mysqli_fetch_assoc($chats))
{
    if($chat["FromUser"] == $fromUser)
    {
        $output.= "<div style='text-align:right;'>
                    <p style='background-color:blue; color:#fff; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                        ".$chat["Message"]."
                    </p>
                    </div>";
    }else{
        $output.= "<div style='text-align:left;'>
                    <p style='background-color:green; color:#fff; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                        ".$chat["Message"]."
                    </p>
                    </div>";
    }
}
echo $output;


?>