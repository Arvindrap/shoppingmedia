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
    

</head>
<body>
<?php
    
    $con = mysqli_connect('remotemysql.com', 'Q3q5AjEgPW', 'QUMyBKHa6a', 'Q3q5AjEgPW') or die('Error in connection');
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
            <input type="text" name="search"/>
            <input type="submit" value="search"/>
        </form>
        <?php echo $data; ?>
    
    </div>
    


</body>
    
</html>