<html> 
<head>
        <title> User Log in and Registration </title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        >
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    
<div class="container">
    <div class="login-box">
    <div class="row">
    <div class="col-md-6 login-left">
        <h2> Log in </h2>
        <form action="validation.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control" required>
            
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            
            </div>
            <button type="submit" class="btn btn-primary"> Log in </button>
        </form>
        
    </div>
        <div class="col-md-6 login-right">
        <h2> Register New Users </h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control" required>
            
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            
            </div>
            <div class="g-recaptcha" data-sitekey="6Lcd9rAaAAAAAKWyzwCjSci3T6n-rvNDU6uKNUNl"></div>
            <br>
            <button type="submit" class="btn btn-primary"> Register </button>
        </form>
        
    </div>
        
    </div>
    
    </div>
    
    
</div>
    
    
    
    
    
    
    
</body>
    
    
</html>
    