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
// echo "Connected Succesfully";



if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == "login") {
    login($db);
} elseif ($action == "register") {
    register($db);
} elseif ($action == "forgot") {
    forgot($db);
}elseif ($action == "createLobby") {
    createLobby($db);
}
elseif ($action == "closeLobby") {
    closeLobby($db);
}



function login($db){
    $email = $_POST['email'];
    $password= $_POST['password'];
    $name ="";
    $id = "";
    $gender = "";
    $phone = "";
    $birthdate = "";
    $returnData = array();

    // Prepare SQL statement
    $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    $statement->bind_param("s", $email);
    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $returnData["idplayer"] = $row["id"];
            $returnData["name"] = $row['name']; 
            $returnData["gender"] = $row['gender']; 
            $returnData["phone"] = $row['phone']; 
            $returnData["birthday"] = $row['birthday']; 
            $returnData["phone"] = $row["phone"];
            $returnData["status"] = "1";
            $returnData["msg"] = "Login Successfully";
            $passDB = $row['password'];                  
        }
        
        if(password_verify($password, $passDB)){
        //    echo "ID: ".$id. " Name: ".$name. " Gender ".$gender. " Phone ".$phone. " Birthdate ".$birthdate;
           echo json_encode($returnData);
           return;
        }
        else{
            $returnData["status"] = "2";
            echo "Wrong Password";            
            return;
        }

    } else {
        $returnData["status"] = "3";
        echo "User Not Found";
        return;
    }
    $statement->close();
    $db->close();
    return;
    // $row = mysqli_fetch_assoc($result);

    // if($result->num_rows > 0){
    //    $hashed_pwd = $row['pwd'];
    //  }

    // if(password_verify($pwd, $hashed_pwd)){
    //     echo 'User verified successfully!';
    // }

    // // Close SQL Statement
    // $statement->close();

    // echo '{"success":false,"msg":"Email and/or Password Invalid"}';
}

function register($db){

    // echo var_dump($_POST);
    $email = $_POST['q12_email12'];
    $password=  password_hash($_POST['q16_password'], PASSWORD_DEFAULT);
    $conppass =  password_hash($_POST['q17_conpassword'], PASSWORD_DEFAULT);
    $name =  $_POST['q1_name'];
    $gender = $_POST['q6_male'];
    $phone = $_POST['q12_email12'];   
    $address = $_POST['q14_address14'];
    $birthdate_DD = $_POST['q15_dateDay'];
    $birthdate_MM = $_POST['q15_dateMonth'];
    $birthdate_YY = $_POST['q15_dateYear'];
    $birthdate = $_POST['q18_birthdate'];

    // Prepare SQL statement for check existing user
    // $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    // $statement->bind_param("s", $email);
    // $statement->execute();


    $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    $statement->bind_param("s", $email);
    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0) {        
        echo '{"status":"failed","msg":"Users Exists"}';   
        return;   
    } 
    $statement->close();

    // $statement = "Select * from User where email = $email";   

    // // Get result
    // $results = $db->query($statement);

    // // User already exists
    // if($results->num_rows > 0) {
    //     echo '{"success":false,"msg":"Users Exists"}';       
    //     return;
    // }

    // Prepare SQL statement for insertion
    // $statement4 = "INSERT INTO Users (name, email, Password) VALUES ('$name', '$email', '$password')";
    $statement = $db->prepare ("INSERT INTO User (name, email, Password,gender,phone,address,birthday) VALUES (?,?,?,?,?,?,?)");
    // $Birthday = $birthdate_DD."-".$birthdate_MM."-".$birthdate_YY;
    $statement->bind_param("sssssss", $name, $email, $password,$gender,$phone,$address,$birthdate);    

    // Execute insert statement
    if($statement->execute()) {
        echo '{"status":"success","msg":"User registered successfully"}';

        $statement->close();
        return '{"status":"success","msg":"User registered successfully"}';
    }

    // Something went wrong and user was not registered
    echo '{"status":"failed","msg":"Unable to register user"}';
}

function forgot($db){
    
    echo '{"success":false,"msg":"Feature not yet implemented"}';
}
function createLobby($db){
    
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = 0;
    $playerName = "";
    $ceklobbyid = true;
    // echo $idPlayer." - ". $lobbyId;
    do {
        $lobbyId = rand(1,9999);
        // $lobbyId = 7503;
        $statement = $db->prepare("SELECT * FROM `pvplobby` WHERE `id`=?");
        $statement->bind_param("s", $lobbyId);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $ceklobbyid  = false;
            // echo "Lobby ID Kembar <br>";
        }
        else{
            $ceklobbyid  = true;
        }
    } while ($ceklobbyid == false);
    
    $statement = $db->prepare ("INSERT INTO pvplobby (id, idplayer1) VALUES (?,?)");
    $statement->bind_param("ss", $lobbyId, $idPlayer);     
    if($statement->execute()) {
        // echo 'Lobby Created!';

        $statement->close();       
        $returnData = array("idplayer" => $idPlayer);
        $returnData["lobbyId"] = $lobbyId; 
        echo json_encode($returnData);
    }
    else{    
        // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
        echo $statement->error;
    }
}   

function closeLobby($db){
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = $_POST['idLobby'];
    $statement = $db->prepare ("delete from `pvplobby` where `id`= ? AND `idplayer1` = ? ");
    $statement->bind_param("ss", $lobbyId, $idPlayer);     
    if($statement->execute()) {
        // echo 'Lobby Created!';
        $statement->close();       
        echo "success";
        return;
    }
    else{    
        // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
        echo $statement->error;
    }
}

exit();
?>