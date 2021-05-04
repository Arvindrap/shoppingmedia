<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>


<html>
<head>
<title> Home Page </title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        >

</head>
    
    
    
<body>
    

    
<?php
    
    //$con = mysqli_connect('freedb.tech', 'freedbtech_arvindra', 'Arv5n321', 'freedbtech_remote') or die('Error in connection');
    $con = mysqli_connect('localhost', 'root', 'Arv5n321', 'userregistration') or die('Error in connection');
    $data = '';
    
    if(isset($_POST['search']))
    {
        $str = $_POST['search'];
        $str = preg_replace("#[^0-9a-z]#i", "", $str);
        $query = "SELECT name FROM usertable WHERE name LIKE '%$str%'";
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
    <a class='float-middle' href='chatbox.php'> CHAT MESSAGES </a>
        
    <h1 style="text-decoration:underline; text-align: center;"> Welcome <?php echo $_SESSION['username']; ?>! </h1>
    </div>
    
    <div class="weather-container" style="background: rgba(211, 211, 211, 0.5); text-align: center;">
        <img class="icon">
        <p class="weather" style="font-size: 22px; margin: 0;"></p>
        <p class="temp" style="font-size: 60px; margin: 0; font-weight: bold;"></p>
    
    
    </div>
    <div class="container">
        
        <h1>Other Users</h1>
        <form action="home.php" method="post">
            <input type="text" name="search" placeholder="Search for Users"/>
            <input type="submit" value="search"/>
        </form>
        <a><?php echo $data; ?></a>
        
    
    </div>
    <main role="main">
        <div class="container">
            <div class="mx-auto">
                <?php 
                if (isset($_SESSION['username'])) {
                    echo'
                <h1>Post a sale</h1>
                <form method="post" action="announcement.php" enctype="multipart/form-data">
                    <input name="userid" type="hidden" value='.$_SESSION['id'].'>
                    <input type="text" name="announcementTitle" placeholder="Enter Subject"><br>
                    <textarea name="announcementBox" rows="5" cols="40" style="background-color: #fff;" placeholder="Enter Sale"></textarea><br>
                    <input type="file" name="image" accept="image/jpeg">
                    <button name="announcement" style="width: 100px; box-sizing: border-box; border: 4px solid #6495ed; border-radius: 4px;">Submit</button>
                </form>';
                    
                }
                $query = "SELECT * FROM announcement ORDER BY id DESC";
                $result = mysqli_query($con,$query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="row" style="color:black;background-color:rgba(211, 211, 211, 0.5);border-radius:5px;padding:10px;margin-top:10px;margin-bottom:30px">';
                    echo '<div class="column" style="width:100%;border:5px">';
                    if (isset($_SESSION['username'])) {
                        
                        echo '<form method="post" action="announcement.php">';
                        echo "<b>Posted by " .$row["name"]. "</b><p>";
                        echo "<b>Contact:</b> " .$row["email"]. " or <a href='chatbox.php?toUser=".$row["userid"]."'> CHAT </a><p>";
                        echo '<input type="hidden" name="postID" value="'.$row['id'].'">';
                        if ($row['userid'] == $_SESSION['id']) 
                        {
                            echo '<button name="delete" style="float:right">Delete Post</button>';
                        }
                        echo '</form>';
                    
                    }
                    echo $row['announcementTitle'].'<p><br>';
                    echo $row['announcement'].'<br>';
                    echo '<img width="40%" src="data:image;base64,'.$row['image'].'"alt="Image" style="padding-top:10px">';
                    echo "<p><b>Comments:</b><p>";
                    echo'
                    <form method="post" action="comment.php">
                        <input name="postid" type="hidden" value='.$row['id'].'>
                        <textarea name="commentbox" rows="2" cols="50" placeholder="Leave a Comment"></textarea><br>
                    
                        <button name="comment" style="width: 100px; box-sizing: border-box; border: 4px solid #6495ed; border-radius: 4px;">Submit</button>
                    </form>';
                    $find_comment = "SELECT * FROM comment WHERE post_id = ".$row["id"]." ORDER BY id DESC";
                    $res = mysqli_query($con,$find_comment);
                    while ($roww = mysqli_fetch_array($res)) {
                        echo '<form method="post" action="comment.php">';
                        echo '<input type="hidden" name="id" value="'.$roww['post_id'].'">';
                        $comment_name = $roww['name'];
                        $comment = $roww['comment'];
                        echo "<p><b>$comment_name</b>: $comment<p>";
                    }
                    if(isset($_GET['error'])) {
                        echo "<p>100 Character Limit";
                    }
                    echo '</div></div>';
                
                    }
                
                ?>
            </div>
        </div>
        
    
        
        
    </main>
        
        
    
    


</body>
<script type="text/javascript">

var city = "Jersey City"
    

$.getJSON("http://api.openweathermap.org/data/2.5/weather?q=" + city + "&units=imperial&appid=5716fbbfa32b3facf6d8c59e57e2a7e8", function(data){
    
    console.log(data);
    
    var icon = "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
    var temp = Math.floor(data.main.temp);
    var weather = data.weather[0].main;
    
    $('.icon').attr('src', icon);
    $('.weather').append(weather);
    $('.temp').append(temp);
    
});

</script>


    
</html>