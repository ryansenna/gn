<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
        <title>Login - Auto Complete</title>
    </head>
    <body>
        <div class="jumbotron text-center alert alert-info">
            <h1>Name here</h1>
        </div>
        <div class="container center_div" id="form">
            <form action ="login_handler.php" method="post">
                <div class="form-group" id="emailBox">
                    <label for="email">Email Address:</label>
                    <input type="email" name="lEmail"class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group"id="passBox">
                    <label for="pwd">Password:</label>
                    <input type="password" name="lPass" class="form-control" id="pwd" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-primary" type="submit"> <span class="glyphicon glyphicon-log-in"></span> Login</button>
                    <a href="register.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-pencil"></span> Register</a>
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
