<?php
session_start();
include("links.php");

$con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die('Error in connection');

$users = mysqli_query($con, "SELECT * FROM usertable WHERE id = '".$_SESSION["id"]."' ") or die("Failed to query database".mysql_error());
$user = mysqli_fetch_assoc($users);

?>
<!DOCTYPE html>
<html>
<head>
    <title> User Chatbox</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        >
</head>
<body>
    
    
    <div class="container">
        <?php echo "<a class='float-right' href='home.php'> BACK TO HOME </a>" ; ?>
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h1><p><?php echo $user["name"] ?>'s messages </p></h1>
                    <input type="text" id="fromUser" value=<?php echo $user["id"]; ?> hidden />
                    
                    <a><p> Send a message to:</p></a>
                    <ul>
                        <?php
                            $msgs = mysqli_query($con, "SELECT * FROM usertable") or die("Failed to query database".mysql_error());
                            while($msg = mysqli_fetch_assoc($msgs))
                            {
                                echo '<li><a href="?toUser='.$msg["id"].'">'.$msg["name"].'</a></li>';
                            }
                        ?>
                    </ul>
                
                </div>
                <div class="col-md-4">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>
                                    <?php
                                    if(isset($_GET["toUser"]))
                                    {
                                        
                                        $userName = mysqli_query($con, "SELECT * FROM usertable WHERE id = '".$_GET["toUser"]."' ") or die("Failed to query database".mysql_error());
                                        $uName = mysqli_fetch_assoc($userName);
                                        echo '<input type="text" value ='.$_GET["toUser"].' id="toUser" hidden/>';
                                        echo $uName["name"];
                                        
                                    }else{
                                        $userName = mysqli_query($con, "SELECT * FROM usertable") or die("Failed to query database".mysql_error());
                                        $uName = mysqli_fetch_assoc($userName);
                                        $_SESSION["toUser"] = $uName["id"];
                                        echo '<input type="text" value ='.$_SESSION["toUser"].' id="toUser" hidden/>';
                                        echo $uName["name"];
                                    }
                                    ?>
                                
                                </h4>
                            </div>
                            <div class="modal-body" id="msgBody" style="height:400px; overflow-y: scroll; overflow-x: hidden;">
                                <?php
                                    if(isset($_GET["toUser"]))
                                    {
                                        $chats = mysqli_query($con, "SELECT * FROM messages WHERE (FromUser = '".$_SESSION["id"]."' AND ToUser = '".$_GET["toUser"]."') OR (FromUser = '".$_GET["toUser"]."' AND ToUser = '".$_SESSION["id"]."')") or die("Failed to query database".mysql_error());
                                    }else{
                                        $chats = mysqli_query($con, "SELECT * FROM messages WHERE (FromUser = '".$_SESSION["id"]."' AND ToUser = '".$_SESSION["toUser"]."') OR (FromUser = '".$_SESSION["toUser"]."' AND ToUser = '".$_SESSION["id"]."')") or die("Failed to query database".mysql_error());
                                        
                                        
                                        while($chat = mysqli_fetch_assoc($chats))
                                        {
                                            if($chat["FromUser"] == $_SESSION["id"])
                                            {
                                                echo "<div style='text-align:right;'>
                                                        <p style='background-color:blue; color:#fff; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                            ".$chat["Message"]."
                                                        </p>
                                                        </div>";
                                            }else{
                                                echo "<div style='text-align:left;'>
                                                        <p style='background-color:green; color:#fff; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                            ".$chat["Message"]."
                                                        </p>
                                                        </div>";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <textarea id="message" class="form-control" style="height:70px;"></textarea>
                                <button id="send" class="btn btn-primary" style="height:70%;">send</button>
                            </div>
                        
                        </div>
                    
                    </div>
                
                </div>
                <div class="col-md-4">
                
                </div>
            
            
            </div>
        
        
        </div>
        </div>
    
</body>
    
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#send").on("click",function(){
            $.ajax({
                url:"message.php",
                method:"POST",
                data:{
                    fromUser: $("#fromUser").val(),
                    toUser: $("#toUser").val(),
                    message: $("#message").val()
                },
                dateType:"text",
                success:function(data)
                {
                    $("#message").val("");
                }
            });
        });
        
        setInterval(function(){
            $.ajax({
                url:"realtimeChat.php",
                method:"POST",
                data:{
                    fromUser:$("#fromUser").val(),
                    toUser:$("#toUser").val()
                },
                dataType:"text",
                success:function(data)
                {
                    $("#msgBody").html(data);
                }
            });
        }, 700);
    });
    
    
</script>



</html>