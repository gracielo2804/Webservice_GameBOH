<?php

//These variable values need to be changed by you before deploying
//Variables for connecting to your database.
//These variable values come from your hosting account.
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "game_boh";

$action = null;


//Connect to your database
$db = mysqli_connect($hostname, $username, $password, $dbname) OR DIE ("Unable to connect to database! Please try again later.");
echo "Connected Succesfully";



if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "login") {
    login($db);
} elseif ($action == "register") {
    register($db);
} elseif ($action == "forgot") {
    forgot($db);
}


function login($db){
    // Escape string and prevent possible SQL injection
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Prepare SQL statement
    $statement = $db->prepare("SELECT * FROM `users` WHERE `email`=?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $row = mysqli_fetch_assoc($result);

    if($result->num_rows > 0){
       $hashed_pwd = $row['pwd'];
     }

    if(password_verify($pwd, $hashed_pwd)){
        echo 'User verified successfully!';
    }

    // Close SQL Statement
    $statement->close();

    echo '{"success":false,"msg":"Email and/or Password Invalid"}';
}

function register($db){

    // echo var_dump($_POST);
    // Escape string and prevent possible SQL injection
    $email = $_POST['q12_email12'];
    $password=  password_hash($_POST['q16_password'], PASSWORD_DEFAULT);
    $conppass =  password_hash($_POST['q17_conpassword'], PASSWORD_DEFAULT);
    $name =  $_POST['q1_name'];

    // Prepare SQL statement for check existing user
    // $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    // $statement->bind_param("s", $email);
    // $statement->execute();

    $statement = "Select * from User where email = $email";   

    // Get result
    $results = $db->query($statement);

    // User already exists
    if($results && $results->num_rows > 0) {
        echo '{"success":false,"msg":"Users Exists"}';       
        return;
    }

    // Prepare SQL statement for insertion
    // $statement4 = "INSERT INTO Users (name, email, Password) VALUES ('$name', '$email', '$password')";
    $statement = $db->prepare ("INSERT INTO User (name, email, Password) VALUES (?,?,?)");
    $statement->bind_param("sss", $name, $email, $password);    

    // Execute insert statement
    if($statement->execute()) {
        echo '{"success":true,"msg":"User registered successfully"}';

        $statement->close();
        return '{"success":true,"msg":"User registered successfully"}';
    }

    // Something went wrong and user was not registered
    echo '{"success":false,"msg":"Unable to register user"}';
}

function forgot($db){
    echo '{"success":false,"msg":"Feature not yet implemented"}';
}


$db->close();

exit();
?>