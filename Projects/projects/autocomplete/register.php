<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
        <title>Register - Auto complete</title>
    </head>
    <body>
        <div class="jumbotron text-center alert alert-info">
            <h1>Name here</h1>
        </div>
        <div class="container" id="form">
            <form action ="register_handler.php" method="post">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="rfName" class="form-control" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="rlName" class="form-control" placeholder="Enter your last name">
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="remailAddress" class="form-control" placeholder="Enter your email address">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="rpass" class="form-control" id= "passField"placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="pwdagain">Enter your password again:</label>
                    <input type="password" name="rpassAgain" class="form-control" id="passConf" placeholder="Enter your password again">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-primary" type="submit" id="submitBtn"> <span class="glyphicon glyphicon-flash"></span> Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
session_start();
session_regenerate_id();
session_destroy();
$_SESSION = [];
?>