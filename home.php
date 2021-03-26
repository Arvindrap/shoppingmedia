<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>


<html>
<head>
<title> Home Page </title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        >
    <script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"> </script>
    

</head>
<body>
<?php
    
    $con = mysqli_connect('freedb.tech', 'freedbtech_arvindra', 'Arv5n321', 'freedbtech_remote') or die('Error in connection');
   // $con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die('Error in connection');
    $data = '';
    
    if(isset($_POST['search']))
    {
        $str = $_POST['search'];
        $str = preg_replace("#[^0-9a-z]#i", "", $str);
        $query = "select name from usertable where name LIKE '%$str%'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        if($count>0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $data = $data."<div>".$row['name']."</div>";
            }
        }
        
    }
    

?>   
    
    
    <div class="container">
    
    <a class="float-right" href="logout.php"> LOG OUT </a>
        
    <h1> Welcome <?php echo $_SESSION['username']; ?> </h1>
        
        <form action="home.php" method="post">
            <input type="text" name="search" placeholder="Search for Users"/>
            <input type="submit" value="search"/>
        </form>
        <?php echo $data; ?>
        
    
    </div>
    <main role="main">
        <div class="container">
            <div class="mx-auto">
                <?php 
                if (isset($_SESSION['username'])) {
                
                    echo'
                <h1 style="text-decoration:underline">Post an announcement</h1>
                <form method="post" action="announcement.php" enctype="multipart/form-data">
                    <input type="text" name="announcementTitle" placeholder="Enter Subject"><br>
                    <textarea name="announcementBox" rows="5" cols="40" placeholder="Enter Announcement"></textarea><br>
                    <input type="file" name="image" accept="image/jpeg">
                    <button name="announcement">Submit</button>
                </form>';
                    
                }
                $query = "SELECT * FROM announcement ORDER BY id DESC";
                $result = mysqli_query($con,$query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="row" style="color:black;background-color:white;border-radius:5px;padding:10px;margin-top:10px;margin-bottom:10px">';
                    echo '<div class="column" style="width:100%;border:5px">';
                    if (isset($_SESSION['username'])) {
                        
                        echo '<form method="post" action="announcement.php">';
                        echo "Posted by " .$row["name"]. " click X to delete:";
                        echo '<input type="hidden" name="postID" value="'.$row['id'].'">';
                        echo '<button name="delete" style="float:right">X</button>';
                        echo '</form>';
                    
                    }
                    echo $row['announcementTitle'].'<br>';
                    echo $row['announcement'].'<br>';
                    echo '<img width="60%" src="data:image;base64,'.$row['image'].'"alt="Image" style="padding-top:10px">';
                    echo '</div></div>';
                }
                
                ?>
            </div>
        </div>
        
        <div id="main">
        <h1 style="background-color: #6495ed;color: white;"><?php echo $_SESSION['username']; ?>'s messages</h1>
            <div class="jumbotron" style="padding-top:15px;padding-bottom:30px;margin-bottom:0px;background-color: white;color:black">
            <div class="output"> 
                <?php $sql = "SELECT * FROM message ";
                $result = $con->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "" .$row["name"]. " " .":: " .$row["msg"]." --" .$row["date"]. "<br>";
                        echo "<br>";
                    }
                }else {
                    echo "0 messages";
                }
                $con->close();
                ?>
                
                
                
            </div>
            </div>
        
        <form method="post" action="send.php">
        <textarea name="msg" placeholder="Type to send message..."></textarea><br>
        <input type="submit" value="Send">
            
        
        </form>
        </div>
        
        
    
    


</body>
    
</html>
