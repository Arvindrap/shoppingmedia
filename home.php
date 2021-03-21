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
    
    <div class="container">
    
    <a class="float-right" href="logout.php"> LOG OUT </a>
        
    <h1> Welcome <?php echo $_SESSION['username']; ?> </h1>
        
        <form action="process.php" method="POST">
            
        <div class="input-field">
            <label for="title"> Enter Subject </label>
            <input type="text" name="Article_title" id="title">
        </div>
            
        <textarea name="Article_content" id="Article_editor"></textarea>   
        
        <input type="submit" class="publish-btn" name="submit_data" value="publish">
        
        </form>
    
    </div>
    
<script src="ckeditor/ckeditor.js"></script>
<script>
    
    CKEDITOR.replace('Article_editor');
    
</script>

</body>
    
</html>