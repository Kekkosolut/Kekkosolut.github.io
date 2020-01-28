 <?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <title>Register</title>
    </head>
    <body>
        <form class="Register" action="register.php" method="post">
            <?php //include('errors.php'); ?>
            Email: <br>
            <input type="text" name="email" placeholder="Email"><br>
            Username: <br>
            <input type="text" name="username" placeholder="Username"><br>
            Password: <br>
            <input type="password" name="pwd" placeholder="Password">
            <br>
            Confirm password: <br>
            <input type="password" name="pwd2" placeholder="Confirm password">
            <br>
            <button type="submit" name="register-submit">Sign Up</button>
            <br>
            Alredy have an account? <a href="index.html">Login</a>

        </form>
    </body>
</html>
