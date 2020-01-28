<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'phplogin');

// register user
if (isset($_POST['register-submit'])) {
    // recive all input values fromthe from
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['pwd']);
    $password_2 = mysqli_real_escape_string($db, $_POST['pwd2']);

    // if empty display error
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($password_2)) { array_push($errors, "You must confirm password"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match!");
     }
}

// Check that username or email does not exixts in db
$user_check_query = "SELECT * FROM accounts WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { //if user exists
    if ($user['username'] === $username) {
        array_push($errors, "Username alredy exists");
    }

    if ($user['email'] === $email) {
        array_push($errors, "Email alredy exists");
    }
}

// Register users if there is no errors
if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_DEFAULT); // encrypts the password before storing it in db

    $query = "INSERT INTO accounts (username, password, email)
                VALUES('$username', '$password', '$email')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in!";
    header('location: home.php');
}
