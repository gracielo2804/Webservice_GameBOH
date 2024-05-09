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

if (isset($_GET['test'])) {
    test($db);
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
elseif ($action == "joinLobby") {
    joinLobby($db);
}
elseif ($action == "updateWaitLobby") {
    updateWaitLobby($db);
}
elseif ($action =="quickJoinLobby"){
    quickJoinLobby($db);
}
elseif ($action =="saveStrategy"){
    saveStrategy($db);
}
elseif ($action =="getStrategy"){
    getStrategy($db);
}
elseif ($action =="createMatch"){
    createMatch($db);
}
elseif ($action =="getMapping"){
    getMapping($db);
}
elseif ($action =="getTurn"){
    getTurn($db);
}
elseif ($action =="updateMatchData"){
    updateMatchData($db);
}
elseif ($action =="insertLogMatch"){
    insertLogMatch($db);
}
elseif ($action =="getLogMatch"){
    getLogMatch($db);
}
elseif ($action =="getDataJoinMatch"){
    getDataJoinMatch($db);
}
elseif ($action =="updatePemenang"){
    updatePemenang($db);
}

function test($db){

    echo nl2br("Random:".rand(0,9)."\n\n");
    $array = array();
    $fruit = array();
    for ($i=0; $i < 3; $i++) { 
        $fruit["Fruit"] = "Apple";
        $fruit["Taste"] = "Sweet";
        array_push($array,$fruit);
    }
    var_dump($array);

    $query = "SELECT * from strategy where id = '3'";
    $result = mysqli_query($db,$query);
    $mapping1 = "";
    echo nl2br("Mapping11 : \n");

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $mapping1 = $row["mapping"];
        }
    }

    echo nl2br($mapping1."\n\n");
    
    $query2 = "SELECT * from strategy where id = '5'";
    $result2 = mysqli_query($db,$query2);
    $mapping2 = "";
    echo nl2br("Mapping 2 : \n");
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_assoc($result2)){
            $mapping2 = $row["mapping"];
        }
    }
    echo nl2br($mapping2."\n\n");

    echo nl2br("Inverted Mapping 2\n");

    // // Explode mappings into arrays of lines
    // $lines1 = explode("\n", $mapping1);
    // $lines2 = explode("\n", $mapping2);

    // // Initialize array to store merged lines
    // $mergedLines = [];

    // // Iterate through each line
    // for ($i = 0; $i < count($lines1); $i++) {
    //     // Explode each line into arrays of numbers
    //     $numbers1 = explode(";", $lines1[$i]);
    //     $numbers2 = explode(";", $lines2[$i]);
        
    //     // Initialize array to store merged numbers for this line
    //     $mergedNumbers = [];
        
    //     // Iterate through each number
    //     for ($j = 0; $j < count($numbers1); $j++) {
    //         // Get the value from each mapping
    //         $value1 = $numbers1[$j];
    //         $value2 = $numbers2[$j];
            
    //         // Determine the merged value
    //         if ($value1 !== "" && $value2 !== "") {
    //             // Both values are not empty, take the maximum
    //             $mergedValue = max($value1, $value2);
    //         } elseif ($value1 !== "") {
    //             // Value in mapping 1 is not empty
    //             $mergedValue = $value1;
    //         } elseif ($value2 !== "") {
    //             // Value in mapping 2 is not empty
    //             $mergedValue = $value2;
    //         } else {
    //             // Both values are empty
    //             $mergedValue = "";
    //         }
            
    //         // Add the merged value to the array
    //         $mergedNumbers[] = $mergedValue;
    //     }
        
    //     // Reconstruct the merged line
    //     $mergedLine = implode(";", $mergedNumbers);
        
    //     // Add the merged line to the array
    //     $mergedLines[] = $mergedLine;
    // }

    // // Concatenate the merged lines to form the final merged mapping
    // $mergedMapping = implode("\n", $mergedLines);
    // echo nl2br($mergedMapping);

    $test = "Test\n";
    $lineMapping1 = explode("\n",$mapping1,);
    $lineMapping2 = explode("\n",$mapping2);


    $invertedMapping2="";   

    for ($i=13; $i >= 8; $i--) {     
        $linecontain = $lineMapping2[$i];  
        // var_dump($linecontain);
        $substr = explode(";",$linecontain);
        // var_dump($substr);
        $inverted = array();
        for ($j=count($substr)-1; $j >=0 ; $j--) { 
            array_push($inverted,$substr[$j]);
        }  
        // var_dump($inverted);

        $result = implode(";",$inverted);
        // var_dump($result);

        //=========================================================================================================
        // $numbers = explode(";", $linecontain);

        // // Step 2: Find the indices of non-empty values
        // $nonEmptyIndices = array_keys(array_filter($numbers, function($value) { return $value !== ''; }));

        // // Step 3: Invert the array of non-empty values
        // $invertedNumbers = array_reverse(array_intersect_key($numbers, array_flip($nonEmptyIndices)));

        // // Step 4: Fill the original array with inverted values considering empty values
        // foreach ($nonEmptyIndices as $index) {
        //     $numbers[$index] = array_shift($invertedNumbers);
        // }

        // // Step 5: Join the modified array elements back into a string
        // $invertedString = implode(";", $numbers);
        //===========================================================================================================
        // Step 2: Find the indices of non-empty values
        // $nonEmptyIndices = array_keys(array_filter($numbers, function($value) { return $value !== ''; }));

        // // Step 3: Invert the array of non-empty values
        // $invertedNumbers = array_reverse(array_intersect_key($numbers, array_flip($nonEmptyIndices)));

        // // Step 4: Fill the original array with inverted values considering empty values
        // foreach ($nonEmptyIndices as $index) {
        //     $numbers[$index] = array_shift($invertedNumbers);
        // }
        // // Step 5: If the string started with an empty value, move the last value to the beginning
        // if ($linecontain[0] === ';') {
        //     array_unshift($numbers, array_pop($numbers));
        // }

        // // Step 6: If the string originally had a trailing semicolon, add it back
        // if ($linecontain[strlen($linecontain) - 1] === ';') {
        //     $numbers[] = '';
        // }

        // // Step 7: Join the modified array elements back into a string
        // $invertedString = implode(";", $numbers);


        if($i != 8 ){
            $invertedMapping2 = $invertedMapping2.$result."\n";
        }
        else{
            $invertedMapping2 = $invertedMapping2.$result;
        }
    }
    echo nl2br($invertedMapping2."\n\n");
    // $testString = "9;3;5;1;1";
    // $substr = explode(";",$testString);
    // $inverted = array();
    // for ($i=count($substr)-1; $i >=0 ; $i--) { 
    //     array_push($inverted,$substr[$i]);
    // }    
    // $result = "";

    $usedMapping1 = array();
    for ($i=6; $i <= 13; $i++) { 
        array_push($usedMapping1,$lineMapping1[$i]);        
    }
    $mapping1 = implode("\n",$usedMapping1);
    $MappingAll = $invertedMapping2."\n".$mapping1;
    echo nl2br("\n\n Mapping Merge\n".$MappingAll);

    
    
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
    // $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    // $statement->bind_param("s", $email);
    // $statement->execute();    
    // $result = $statement->get_result();
    // if ($result->num_rows > 0) {
    //     // Output data of each row
    //     while ($row = $result->fetch_assoc()) {
    //         $returnData["idplayer"] = $row["id"];
    //         $returnData["name"] = $row['name']; 
    //         $returnData["gender"] = $row['gender']; 
    //         $returnData["phone"] = $row['phone']; 
    //         $returnData["birthday"] = $row['birthday']; 
    //         $returnData["phone"] = $row["phone"];
    //         $returnData["address"] = $row["address"];
    //         $returnData["email"] = $row["email"];
    //         $returnData["status"] = "1";
    //         $returnData["msg"] = "Login Successfully";
    //         $passDB = $row['password'];                  
    //     }
        
    //     if(password_verify($password, $passDB)){
    //     //    echo "ID: ".$id. " Name: ".$name. " Gender ".$gender. " Phone ".$phone. " Birthdate ".$birthdate;
    //        echo json_encode($returnData);
    //        return;
    //     }
    //     else{
    //         $returnData["status"] = "2";
    //         echo "Wrong Password";            
    //         return;
    //     }

    // } else {
    //     $returnData["status"] = "3";
    //     echo "User Not Found";
    //     return;
    // }
    // $statement->close();
    // $db->close();
    // return;

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["idplayer"] = $row["id"];
            $returnData["name"] = $row['name']; 
            $returnData["gender"] = $row['gender']; 
            $returnData["phone"] = $row['phone']; 
            $returnData["birthday"] = $row['birthday']; 
            $returnData["phone"] = $row["phone"];
            $returnData["address"] = $row["address"];
            $returnData["email"] = $row["email"];
            $returnData["status"] = "1";
            $returnData["msg"] = "Login Successfully";
            $passDB = $row['password'];             
        }
        
        if(password_verify($password, $passDB)){
        //    echo "ID: ".$id. " Name: ".$name. " Gender ".$gender. " Phone ".$phone. " Birthdate ".$birthdate;
            echo json_encode($returnData);
            mysqli_close($db);
            return;
        }
        else{
            $returnData["status"] = "2";
            $returnData["msg"] = "Wrong Password";
            echo json_encode($returnData);
            mysqli_close($db);
            return;
        }
    } else {
        $returnData["status"] = "3";
        $returnData["msg"] = "User Not Found";
        echo json_encode($returnData);
        mysqli_close($db);
        return;
    }
    // $statement->close();
    // $db->close();
    // return;
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
    $phone = $_POST['q13_phoneNumber13'];   
    $address = $_POST['q14_address14'];
    $birthdate_DD = $_POST['q15_dateDay'];
    $birthdate_MM = $_POST['q15_dateMonth'];
    $birthdate_YY = $_POST['q15_dateYear'];
    $birthdate = $_POST['q18_birthdate'];

    // Prepare SQL statement for check existing user
    // $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    // $statement->bind_param("s", $email);
    // $statement->execute();

    

    // $statement = $db->prepare("SELECT * FROM `user` WHERE `email`=?");
    // $statement->bind_param("s", $email);
    // $statement->execute();

    // $result = $statement->get_result();
    // if ($result->num_rows > 0) {        
    //     echo '{"status":"failed","msg":"Users Exists"}';   
        
    //     return;   
    // } 
    // $statement->close();

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
    // $statement = $db->prepare ("INSERT INTO User (name, email, Password,gender,phone,address,birthday) VALUES (?,?,?,?,?,?,?)");
    // // $Birthday = $birthdate_DD."-".$birthdate_MM."-".$birthdate_YY;
    // $statement->bind_param("sssssss", $name, $email, $password,$gender,$phone,$address,$birthdate);    

    $query = "SELECT * FROM user WHERE EMAIL = '$email'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        echo '{"status":"failed","msg":"Users Exists"}'; 
        mysqli_close($db);  
        return;   
    }

    $queryCreate = "INSERT INTO user (
        email, password, name, phone, address, gender, birthday)        
        VALUES (
        '$email',
        '$password',
        '$name',
        '$phone',
        '$address',
        '$gender',
        '$birthdate')";

    $resultCreate = mysqli_query($db, $queryCreate);

    // Execute insert statement
    if($resultCreate) {
        echo '{"status":"success","msg":"User registered successfully"}';

        mysqli_close($db);
        return '{"status":"success","msg":"User registered successfully"}';
    }

    // Something went wrong and user was not registered
    echo '{"status":"failed","msg":"Unable to register user"}';
    mysqli_close($db);
    return;
}

function forgot($db){
    
    echo '{"success":false,"msg":"Feature not yet implemented"}';
}
function createLobby($db){
    
    $idPlayer = $_POST['idPlayer'];
    $idStrategy = $_POST['idStrategy'];
    $lobbyId = 0;
    $playerName = "";
    $ceklobbyid = true;

    $query = "SELECT * FROM pvplobby WHERE idplayer1 = '$idPlayer'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result)>0) {
       
        $returnData["lobbyId"] = "";
        $returnData["idplayer"] = "";        
        while ($row = mysqli_fetch_assoc($result)) {
            $returnData["lobbyId"] = $row["id"];
            $returnData["idplayer"] = $row['idplayer1'];                  
        }
        $lobbyid = $returnData["lobbyId"];
        $queryUpdate = "UPDATE pvplobby set strategyplayer1 = $idStrategy where id = $lobbyid";    
        $resultUpdate = mysqli_query($db, $queryUpdate);    
        if($resultUpdate) {
            echo json_encode($returnData);    
            mysqli_close($db);
        }        
        return;           
    }
    else{
        do {
            $lobbyId = rand(1,9999);
            // $lobbyId = 7503;
            $query2 = "SELECT * FROM pvplobby WHERE id = '$lobbyId'";
            $result2 = mysqli_query($db, $query2);                        
            if ($result2->num_rows > 0) {
                $ceklobbyid  = false;
                // echo "Lobby ID Kembar <br>";
            }
            else{
                $ceklobbyid  = true;
            }
        } while ($ceklobbyid == false);
        
        $queryInsert = "INSERT INTO pvplobby (id, idplayer1,strategyplayer1) VALUES ('$lobbyId','$idPlayer',$idStrategy)";    
        $resultInsert = mysqli_query($db, $queryInsert);    
        if($resultInsert) {
            $returnData = array("idplayer" => $idPlayer);
            $returnData["lobbyId"] = $lobbyId; 
            echo json_encode($returnData); 
            mysqli_close($db);   
        } 
        else{
           
        }    
        return;        
    }    
    
    // $statement = $db->prepare("SELECT * FROM `pvplobby` WHERE `idplayer1`=?");
    // $statement->bind_param("s", $idPlayer);
    // $statement->execute();

    // $result = $statement->get_result();
    // if ($result->num_rows > 0) {

    //     $returnData["lobbyId"] = "";
    //     $returnData["idplayer"] = "";        
    //     while ($row = $result->fetch_assoc()) {
    //         $returnData["lobbyId"] = $row["id"];
    //         $returnData["idplayer"] = $row['idplayer1'];      
    //         echo json_encode($returnData);
    //         return;     
    //     }
    // }
    // else{
    //     do {
    //         $lobbyId = rand(1,9999);
    //         // $lobbyId = 7503;
    //         $statement = $db->prepare("SELECT * FROM `pvplobby` WHERE `id`=?");
    //         $statement->bind_param("s", $lobbyId);
    //         $statement->execute();
    //         $result = $statement->get_result();
    //         if ($result->num_rows > 0) {
    //             $ceklobbyid  = false;
    //             // echo "Lobby ID Kembar <br>";
    //         }
    //         else{
    //             $ceklobbyid  = true;
    //         }
    //     } while ($ceklobbyid == false);
        
    //     $statement = $db->prepare ("INSERT INTO pvplobby (id, idplayer1) VALUES (?,?)");
    //     $statement->bind_param("ss", $lobbyId, $idPlayer);     
    //     if($statement->execute()) {
    //         // echo 'Lobby Created!';
    
    //         $statement->close();       
    //         $returnData = array("idplayer" => $idPlayer);
    //         $returnData["lobbyId"] = $lobbyId; 
    //         echo json_encode($returnData);
    //     }
    //     else{    
    //         // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
    //         echo $statement->error;
    //     }
    // }   
}   

function closeLobby($db){
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = $_POST['idLobby'];
    $querydelete = "DELETE FROM pvplobby where id = '$lobbyId' and idplayer1 = '$idPlayer'";
    $result = mysqli_query($db,$querydelete);
    if ($result){
        echo "success";        
    }    
    else{
        echo mysqli_error($db);        
    }
    return;

    // $statement = $db->prepare ("delete from `pvplobby` where `id`= ? AND `idplayer1` = ? ");
    // $statement->bind_param("ss", $lobbyId, $idPlayer);     
    // if($statement->execute()) {
    //     // echo 'Lobby Created!';
    //     $statement->close();       
    //     echo "success";
    //     return;
    // }
    // else{    
    //     // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
    //     echo $statement->error;
    // }
}

function joinLobby($db){
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = $_POST['idLobby'];
    $idStrategy = $_POST['idStrategy'];
    $idStrategyPlayer1 = "";

    $query = "SELECT * FROM pvplobby where id= '$lobbyId'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $returnData["idlobby"] = $row["id"];
            $returnData["idplayer1"] = $row['idplayer1'];
            $idStrategyPlayer1 = $row['strategyplayer1'];
            $returnData["status"] = "2";//Join Lobby Sendiri yang dibuat sebelumnya
        }
        if ($returnData["idplayer1"] == $idPlayer){
            $queryUpdate = "UPDATE pvplobby set strategyplayer1 = '$idStrategy' where id = '$lobbyId'";    
            $resultCreate = mysqli_query($db, $queryUpdate);    
            if($resultCreate) {
                echo json_encode($returnData);    
                mysqli_close($db);
                
            }        
            return;            
        }
        else{
            $player1ID = $returnData['idplayer1'];
            $query2 = "SELECT * from `user` where id= $player1ID";
            $result2 = mysqli_query($db, $query2);               
            if (mysqli_num_rows($result2)>0) {     
                $returnData["nameplayer1"]= "";
                while ($row = mysqli_fetch_assoc($result2)) {
                    $returnData["idplayer1"] = $row["id"];
                    $returnData["nameplayer1"] = $row['name'];  
                    // echo "Cek Isi Data : ". $row['name']. " - ". $row["id"];                 
                }
                $query3 = "SELECT * from `strategy` where id= $idStrategyPlayer1";
                $result3 = mysqli_query($db, $query3);    
                if (mysqli_num_rows($result3)>0) { 
                    while ($row = mysqli_fetch_assoc($result3)) {
                        $returnData["strategyplayer1"] = $row['id'];  
                        $returnData["strategynameplayer1"] = $row['strategyname'];  
                    }
                }    

                $queryupdate = "UPDATE pvplobby set idplayer2 = '$idPlayer', strategyplayer2 = '$idStrategy' where id= '$lobbyId'";
                $resultUpdate = mysqli_query($db, $queryupdate);    
                if($resultUpdate) {
                    $returnData["msg"] = "Success Join Lobby";
                    $returnData["status"] = "1";//Success Join Lobby
                    echo json_encode($returnData);    
                    mysqli_close($db);
                    return;
                }   
                else{
                    echo mysqli_error($db);
                    return;
                }                    
            }
            else{
                $returnData["msg"] = "Opponent Player ID Not Found";
                $returnData["status"] = "-2";//Player ID lawan tidak ditemukan
                echo json_encode($returnData);
                return;
            }
        }
    }
    else{    
        // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
        $returnData["msg"] = "Lobby ID not found";
        $returnData["status"] = "-1";//Lobby ID yang diinput tidak ditemukan
        echo json_encode($returnData);
        return;
    }
    // $statement = $db->prepare ("select * from `pvplobby` where `id`= ?");
    // $statement->bind_param("s", $lobbyId);   
    // $statement->execute();

    // $result = $statement->get_result();
    // if ($result->num_rows > 0) {
    //     // Output data of each row
    //     while ($row = $result->fetch_assoc()) {
    //         $returnData["idlobby"] = $row["id"];
    //         $returnData["idplayer1"] = $row['idplayer1'];
    //         $returnData["status"] = "2";//Join Lobby Sendiri yang dibuat sebelumnya
    //     }
    //     if ($returnData["idplayer1"] == $idPlayer){
    //         echo json_encode($returnData);
    //         return;
    //     }
    //     else{
    //         $statement = $db->prepare ("select * from `user` where `id`= ?");
    //         $statement->bind_param("s", $returnData['idplayer1']);   
    //         $statement->execute();
            
    //         $result2 = $statement->get_result();
    //         if ($result2->num_rows > 0) {     
    //             $returnData["nameplayer1"]= "";
    //             while ($row = $result2->fetch_assoc()) {
    //                 $returnData["idplayer1"] = $row["id"];
    //                 $returnData["nameplayer1"] = $row['name'];  
    //                 // echo "Cek Isi Data : ". $row['name']. " - ". $row["id"];                 
    //             }
    //             $statement = $db->prepare ("update `pvplobby` set `idPlayer2` = ? where `id`= ?");                
    //             $statement->bind_param("ss", $idPlayer,$returnData["idlobby"]); 
    //             if($statement->execute()) {                    
    //                 $returnData["msg"] = "Success Join Lobby";
    //                 $returnData["status"] = "1";//Success Join Lobby
    //                 echo json_encode($returnData);
    //                 return;
    //             }
    //         }
    //         else{
    //             $returnData["msg"] = "Opponent Player ID Not Found";
    //             $returnData["status"] = "-2";//Player ID lawan tidak ditemukan
    //             echo json_encode($returnData);
    //             return;
    //         }
    //     }
    // }
       
    // else{    
    //     // echo "Test 3- ".$idPlayer." - ". $lobbyId;  
    //     $returnData["msg"] = "Lobby ID not found";
    //     $returnData["status"] = "-1";//Lobby ID yang diinput tidak ditemukan
    //     echo json_encode($returnData);
    //     return;
    // }
}

function updateWaitLobby($db){
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = $_POST['idLobby'];

    $idplayer2temp ="";
    $strategyplayer2temp="";
    $query = "SELECT * from `pvplobby` where `id`= '$lobbyId' and `idplayer1` = '$idPlayer'";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)>0){
        $cekuser=false;
        while ($row = mysqli_fetch_assoc($result)){            
            if($row["idplayer2"]!=null ){
                $idplayer2temp = $row["idplayer2"];
                $strategyplayer2temp = $row["strategyplayer2"];
                $cekuser = true;
            }           
        }
        if($cekuser){
            $returnData["idplayer2"]= "";
            $returnData["nameplayer2"]= "";
            $returnData["idstrategyplayer2"]="";
            $returnData["namestrategyplayer2"]="";
            $query2 = "SELECT * FROM user where id = '$idplayer2temp'";
            $result2 = mysqli_query($db,$query2);
            if(mysqli_num_rows($result2)>0){
                while ($row = mysqli_fetch_assoc($result2)){
                    $returnData["idplayer2"]= $row["id"];
                    $returnData["nameplayer2"]= $row["name"];
                } 
            }
            $query2 = "SELECT * FROM strategy where id = '$strategyplayer2temp'";
            $result2 = mysqli_query($db,$query2);
            if(mysqli_num_rows($result2)>0){
                while ($row = mysqli_fetch_assoc($result2)){
                    $returnData["idstrategyplayer2"]= $row["id"];
                    $returnData["namestrategyplayer2"]= $row["strategyname"];
                } 
            }
            $returnData["msg"] = "Opponent Found";
            $returnData["status"] = "1";//Lobby sudah ada lawan
            echo json_encode($returnData);
            return;           
            
        }
        else{
            $returnData["msg"] = "No Opponent";
            $returnData["status"] = "0";//Masih belum ada musuh/lawan/player2 di Lobby
            echo json_encode($returnData);
            return;
        }
    }
    else{
        $returnData["msg"] = "Lobby not found";
        $returnData["status"] = "-1";//Lobby tidak ditemukan
        echo json_encode($returnData);
        return;
    }

    // $idplayer2temp ="";
    // $strategyplayer2temp="";

    // $statement = $db->prepare ("select * from `pvplobby` where `id`= ? and `idplayer1` = ?");
    // $statement->bind_param("ss", $lobbyId,$idPlayer);   
    // $statement->execute();
    // $idplayer2temp ="";
    // $strategyplayer2temp="";

    // $result = $statement->get_result();
    // if ($result->num_rows > 0) {
    //     $cekuser = false;
    //     while ($row = $result->fetch_assoc()) {
    //         if(!isset($row["idplayer2"]) || $row["idplayer2"]!=null || $row["idplayer2"]!=""){
    //             $idplayer2temp = $row["idplayer2"];
    //             $cekuser = true;
    //         }
    //     }
    //     if($cekuser){
    //         $statement2 = $db->prepare ("select * from `user` where `id`= ?");
    //         $statement2->bind_param("s",  $idplayer2temp);   
    //         $statement2->execute();
    //         $returnData["idplayer2"]= "";
    //         $returnData["nameplayer2"]= "";
    //         $result2 = $statement2->get_result();
    //         if ($result2->num_rows > 0) {     
    //             while ($row = $result2->fetch_assoc()) {                   
    //                 $returnData["idplayer2"]= $row["id"];
    //                 $returnData["nameplayer2"]= $row["name"];
    //             }
    //             $returnData["msg"] = "Opponent Found";
    //             $returnData["status"] = "1";//Lobby sudah ada lawan
    //             echo json_encode($returnData);
    //             return;
    //         }
            
    //     }
    //     else{
    //         $returnData["msg"] = "No Opponent";
    //         $returnData["status"] = "0";//Masih belum ada musuh/lawan/player2 di Lobby
    //         echo json_encode($returnData);
    //         return;
    //     }
    // }
    // else{
    //     $returnData["msg"] = "Lobby not found";
    //     $returnData["status"] = "-1";//Lobby tidak ditemukan
    //     echo json_encode($returnData);
    //     return;
    // }

}

function saveStrategy($db){
    $idPlayer = $_POST['idPlayer'];
    $strategyname = $_POST['strategyName'];
    $mapping = $_POST['mapping'];
    $queryCreate = "INSERT INTO strategy        
        VALUES (
        '',
        '$idPlayer',
        '$strategyname',
        '$mapping')";

    $resultCreate = mysqli_query($db, $queryCreate);

    // Execute insert statement
    if($resultCreate) {
        echo '{"status":"1","msg":"Strategy Saved successfully"}';
        mysqli_close($db);
        return;
    }

    // Something went wrong and user was not registered
    echo '{"status":"-1","msg":"Unable to save strategy "}';
    mysqli_close($db);
    return;

}
function getStrategy($db){
    $idPlayer = $_POST['idplayer'];
    $query = "SELECT * FROM strategy WHERE idplayer = '$idPlayer'";
    $index = 0;
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["strategy"][$index]["idstrategy"] = $row["id"];
            $returnData["strategy"][$index]["idplayer"] = $row["idplayer"];
            $returnData["strategy"][$index]["strategyname"] = $row["strategyname"];
            $returnData["strategy"][$index]["mapping"] = $row["mapping"];
            $index++; 
        }        
        $returnData["status"] = "1";//
        $returnData["msg"] = "Strategy Found";
    }
    else{
        $returnData["status"] = "-1";//
        $returnData["msg"] = "No Strategy Found";        
    }
    echo json_encode($returnData);
    return ;
}

function createMatch($db){
    $idPlayer = $_POST['idPlayer'];
    $lobbyId = $_POST['idLobby'];
    $returnData = array();
    

    $query = "SELECT * from pvplobby where id = $lobbyId";
    $result = mysqli_query($db,$query);
    
    if(mysqli_num_rows($result)>0){
        // echo "Cek1\n";
        $dataLobby = array();
        while($row= mysqli_fetch_assoc($result)){
            $dataLobby["idplayer1"] = $row["idplayer1"];
            $dataLobby["strategyplayer1"] = $row["strategyplayer1"];
            $dataLobby["idplayer2"] = $row["idplayer2"];
            $dataLobby["strategyplayer2"] = $row["strategyplayer2"];
        }
        $idplayer1 = $dataLobby["idplayer1"];
        $strategyplayer1 = $dataLobby["strategyplayer1"];
        $idplayer2 = $dataLobby["idplayer2"];
        $strategyplayer2 = $dataLobby["strategyplayer2"];
        
        $query2 = "SELECT * from strategy where id = '$strategyplayer1'";
        $result2 = mysqli_query($db,$query2);
        $mapping1 = "";        
        $mapping2 = "";        
        // echo "Cek2\n";
        if(mysqli_num_rows($result2)>0){
            while($row = mysqli_fetch_assoc($result2)){
                $mapping1 = $row["mapping"];
            }
        }
        // echo "Cek3\n";
        $query2 = "SELECT * from strategy where id = '$strategyplayer2'";
        $result2 = mysqli_query($db,$query2);
        if(mysqli_num_rows($result2)>0){
            while($row = mysqli_fetch_assoc($result2)){
                $mapping2 = $row["mapping"];
            }
        }
        // echo "Cek4\n";
        $lineMapping1 = explode("\n",$mapping1,);
        $lineMapping2 = explode("\n",$mapping2);
        
        $invertedMapping2="";   

        for ($i=13; $i >= 8; $i--) {     
            $linecontain = $lineMapping2[$i];  
            $substr = explode(";",$linecontain);
            $inverted = array();
            for ($j=count($substr)-1; $j >=0 ; $j--) { 
                array_push($inverted,$substr[$j]);
            }  
            $result = implode(";",$inverted);           

            if($i != 8 ){
                $invertedMapping2 = $invertedMapping2.$result."\n";
            }
            else{
                $invertedMapping2 = $invertedMapping2.$result;
            }
        }      
        $usedMapping1 = array();
        for ($i=6; $i <= 13; $i++) { 
            array_push($usedMapping1,$lineMapping1[$i]);        
        }
        $mapping1 = implode("\n",$usedMapping1);
        $MappingAll = $invertedMapping2."\n".$mapping1;

        //Add Cielo Mapping Kepemilikan
        $MappingAllCopy = $MappingAll;
        $exlplodeMappingAll =  explode("\n",$MappingAllCopy);
        $AllKepemilikan = "";
        for ($i=0; $i <= 13; $i++) { 
            $kepemilikkan = array();
            $line = $exlplodeMappingAll[$i];
            $substr = explode(";",$line);
            $result = "";
            for ($j=0; $j < count($substr); $j++) { 
                if($i < 6) //Player2
                {            
                    if ($substr[$j] != "" || !isset($substr[$j])) {
                        array_push($kepemilikkan,$idplayer2);
                    }
                    else{
                        array_push($kepemilikkan,"");
                    }
                }
                else if($i> 7)//Player1
                {
                    if ($substr[$j] != "" || !isset($substr[$j])) {
                        array_push($kepemilikkan,$idplayer1);
                    }
                    else{
                        array_push($kepemilikkan,"");
                    }
                }
                else{               
                    array_push($kepemilikkan,"");
                }            
            }
            
            $result = implode(";",$kepemilikkan);
            if($i != 13){
                $AllKepemilikan = $AllKepemilikan.$result."\n";
            }
            else{
                $AllKepemilikan = $AllKepemilikan.$result;
            }
        }
        //End Add Cielo Mapping Kepemilikan
        // echo "Cek5\n";
        $date = date('Y-m-d H:i:s');
        $queryInsert = "INSERT into pvpmatch values (
            '',
            '$date',
            $idplayer1,
            $strategyplayer1,            
            $idplayer2,
            $strategyplayer2,
            '$MappingAll',         
            '$AllKepemilikan',
            $idplayer1,
            '1',
            '0',
            null       
        )";
        $resultInsert = mysqli_query($db,$queryInsert);
        if($resultInsert){
            // echo "Cek6\n";
            $returnData["idmatch"] = mysqli_insert_id($db);            
            $returnData["idplayer1"] = $idplayer1;
            $returnData["strategyplayer1"] = $strategyplayer1;
            $returnData["idplayer2"] = $idplayer2;
            $returnData["strategyplayer2"] = $strategyplayer2;
            $returnData["mapping"] = $MappingAll;
            $returnData["mappingkepemilkan"] = $AllKepemilikan;
            $returnData["status"] = "1";
            $returnData["msg"] = "Match Created";
            
            $querydelete = "DELETE FROM pvplobby where id = $lobbyId";
            $resultDelete = mysqli_query($db,$querydelete);
            if($resultDelete){
                // echo "Cek7\n";
                echo json_encode($returnData);
                return;
            }

            
        }
        else {
            echo mysqli_error($db)."\n";
            echo $queryInsert;
        }

    }

}

function quickJoinLobby($db){
    $idPlayer = $_POST['idPlayer'];  
    $idStrategy = $_POST['idStrategy'];
    $returnData = array();
    
    $query = "SELECT * FROM pvplobby WHERE idplayer1 = '$idPlayer'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result)>0) {//Join Lobby Sendiri
       
        $returnData["idlobby"] = "";
        $returnData["idplayer"] = "";        
        while ($row = mysqli_fetch_assoc($result)) {
            $returnData["idlobby"] = $row["id"];
            $returnData["idplayer1"] = $row['idplayer1'];                  
        }
        $lobbyid = $returnData["idlobby"];
        $queryUpdate = "UPDATE pvplobby set strategyplayer1 = $idStrategy where id = $lobbyid";    
        $resultUpdate = mysqli_query($db, $queryUpdate);    
        if($resultUpdate) {
            $returnData["msg"] = "Join Own Lobby";
            $returnData["status"] = "2";
            echo json_encode($returnData);    
            mysqli_close($db);
        }        
        return;           
    }

    $query = "SELECT * from pvplobby where idplayer2 is null";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)>0){ //Jika Ada lobby yang player2 kosong
        $availableLobby = array();
        $dataLobby = array();
        $lobbycount = 0;

        while($row = mysqli_fetch_assoc($result)){
           $dataLobby["id"] =$row["id"];
           $dataLobby["idplayer1"] =$row["idplayer1"];
           $dataLobby["strategyplayer1"] =$row["strategyplayer1"];
          
           array_push($availableLobby,$dataLobby);
           $lobbycount++;
        }
        $selectedindex = rand(0,$lobbycount-1);

        $queryupdate = "UPDATE pvplobby set idplayer2 = '$idPlayer', strategyplayer2 = '$idStrategy' where id= '".$availableLobby[$selectedindex]["id"]."' ";
        $resultUpdate = mysqli_query($db, $queryupdate);    
        
        $query = "SELECT a.name, b.strategyname FROM user a, strategy b WHERE b.id = '".$availableLobby[$selectedindex]["strategyplayer1"]."' ";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $returnData["nameplayer1"] = $row["name"];
                $returnData["strategynameplayer1"] =$row["strategyname"];           
            }
        }
        $returnData["idlobby"] = $availableLobby[$selectedindex]["id"];
        $returnData["idplayer1"] = $availableLobby[$selectedindex]["idplayer1"];
        $returnData["strategyplayer1"] = $availableLobby[$selectedindex]["strategyplayer1"];

        if($resultUpdate) {
            $returnData["msg"] = "Success Join Lobby";
            $returnData["status"] = "1";//Success Join Lobby
            echo json_encode($returnData);    
            mysqli_close($db);
            return;
        }   
    }
    else{//Jika Ada lobby tidak ditemukan
        do {
            $lobbyId = rand(1,9999);
            // $lobbyId = 7503;
            $query2 = "SELECT * FROM pvplobby WHERE id = '$lobbyId'";
            $result2 = mysqli_query($db, $query2);                        
            if ($result2->num_rows > 0) {
                $ceklobbyid  = false;
                // echo "Lobby ID Kembar <br>";
            }
            else{
                $ceklobbyid  = true;
            }
        } while ($ceklobbyid == false);
        
        $queryInsert = "INSERT INTO pvplobby (id, idplayer1,strategyplayer1) VALUES ('$lobbyId','$idPlayer',$idStrategy)";    
        $resultInsert = mysqli_query($db, $queryInsert);    
        if($resultInsert) {
            $returnData = array("idplayer" => $idPlayer);
            $returnData["idlobby"] = $lobbyId; 
            $returnData["msg"] = "Success Create Lobby";
            $returnData["status"] = "3";//Create Lobby
            echo json_encode($returnData); 
            mysqli_close($db);   
        } 
    }
}

function getMapping($db){
    //$email = $_POST['email'];
    //$password= $_POST['password'];
    $idmatch = $_POST['id'];
    $returnData = array();
    $query = "SELECT * FROM pvpmatch WHERE id = $idmatch";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["id"] = $row["id"];
            $returnData["time"] = $row['time']; 
            $returnData["idplayer1"] = $row['idplayer1']; 
            $returnData["strategyplayer1"] = $row['strategyplayer1']; 
            $returnData["idplayer2"] = $row['idplayer2']; 
            $returnData["strategyplayer2"] = $row["strategyplayer2"];
            $returnData["mapping"] = $row["mapping"];       
            $returnData["mappingkepemilikan"] = $row["mappingkepemilikan"];  
        }
        echo json_encode($returnData);
        mysqli_close($db);
        return;
    } 
}

function getTurn($db){
    //$email = $_POST['email'];
    //$password= $_POST['password'];
    $idmatch = $_POST['id'];
    $returnData = array();
    $query = "SELECT playerturn, turnstreak, statusmatch, pemenang FROM pvpmatch WHERE id = $idmatch";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["playerturn"] = $row["playerturn"];    
            $returnData["turnstreak"] = $row["turnstreak"];      
            $returnData["statusmatch"] = $row["statusmatch"];      
            $returnData["pemenang"] = $row["pemenang"];      
        }
        echo json_encode($returnData);
        mysqli_close($db);
        return;
    } 
}

function updateMatchData($db){
    $mapping = $_POST['mapping'];
    $mappingkepemilikan = $_POST['mappingkepemilikan'];
    $turn = $_POST['playerturn'];
    $playerturn = intval($turn);
    $idmatch = $_POST['id'];
    $turnstreak = $_POST['turnstreak'];
    $statusmatch = $_POST['statusmatch'];
    $pemenang = $_POST['pemenang'];
    //$idmatch = 2;
    $queryupdate = "";
    if ($statusmatch == 1 && $pemenang !== null && $pemenang !== "") {
        $queryupdate = "UPDATE pvpmatch set mapping = '$mapping', mappingkepemilikan = '$mappingkepemilikan', playerturn = $playerturn, turnstreak = $turnstreak, statusmatch = $statusmatch,
        pemenang = $pemenang  where id= $idmatch";
    } else {
        $queryupdate = "UPDATE pvpmatch set mapping = '$mapping', mappingkepemilikan = '$mappingkepemilikan', playerturn = $playerturn, turnstreak = $turnstreak where id= $idmatch";
    }
    $resultUpdate = mysqli_query($db, $queryupdate);    
    if($resultUpdate) {
        $returnData["msg"] = "Success Join Lobby";
        $returnData["status"] = "1";//Success Join Lobby
        echo json_encode($returnData);    
        mysqli_close($db);
        return;
    }   
    else{
        echo mysqli_error($db);
        return;
    }           
}

function insertLogMatch($db){
    $idMatch = $_POST['idMatch'];
    $barisAsal = $_POST['barisAsal'];
    $kolomAsal = $_POST['kolomAsal'];
    $barisTujuan = $_POST['barisTujuan'];
    $kolomTujuan = $_POST['kolomTujuan'];
    $idPlayer = $_POST['idPlayer'];
    $queryCreate = "INSERT INTO logmatch        
        VALUES (
        '',
        '$idMatch',
        '$barisAsal',
        '$kolomAsal',
        '$barisTujuan',
        '$kolomTujuan',
        '$idPlayer')";

    $resultCreate = mysqli_query($db, $queryCreate);

    // Execute insert statement
    if($resultCreate) {
        echo '{"status":"1","msg":"Log successfully saved"}';
        mysqli_close($db);
        return;
    }

    // Something went wrong and user was not registered
    echo '{"status":"-1","msg":"Unable to save Log "}';
    mysqli_close($db);
    return;

}

function getLogMatch($db){
    $idMatch = $_POST['idMatch'];
    $returnData = array();
    $query = "SELECT * FROM logmatch WHERE idMatch = $idMatch ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["barisAsal"] = $row["barisAsal"];       
            $returnData["kolomAsal"] = $row["kolomAsal"];       
            $returnData["barisTujuan"] = $row["barisTujuan"];       
            $returnData["kolomTujuan"] = $row["kolomTujuan"];       
            $returnData["idPlayer"] = $row["idPlayer"];   
            $returnData["status"] = "1";           
        }
        echo json_encode($returnData);
        mysqli_close($db);
        return;
    } 
    else{
        $returnData["status"] = "-1";        
        echo json_encode($returnData); 
        mysqli_close($db);   
        return;
    }  
    
}

function getDataJoinMatch($db){
    $idPlayer = $_POST['idPlayer'];  
    $idStrategy = $_POST['idStrategy'];
    $returnData = array();
    $query = "SELECT * FROM pvpmatch where idplayer2 = '$idPlayer' and strategyplayer2 = '$idStrategy' and statusmatch = '0' limit 1";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $returnData["idmatch"] = $row["id"];            
            $returnData["idplayer1"] = $row["idplayer1"];
            $returnData["strategyplayer1"] = $row["strategyplayer1"];
            $returnData["idplayer2"] = $row["idplayer2"];
            $returnData["strategyplayer2"] = $row["strategyplayer2"];
            $returnData["mapping"] = $row["mapping"];
            $returnData["mappingkepemilkan"] = $row["mappingkepemilikan"];
            $returnData["status"] = "1";
            $returnData["msg"] = "Match Created";
        }

        echo json_encode($returnData); 
        mysqli_close($db);   
        return;
    }  
    else{
        $returnData["status"] = "-1";
        $returnData["msg"] = "Match Not Found";
        echo json_encode($returnData); 
        mysqli_close($db);   
        return;
    }  
}

function updatePemenang($db){
    $idmatch = $_POST['id'];
    $statusmatch = $_POST['statusmatch'];
    $pemenang = $_POST['pemenang'];
    $queryupdate = "UPDATE pvpmatch set statusmatch = $statusmatch, pemenang = $pemenang where id= $idmatch";
    $resultUpdate = mysqli_query($db, $queryupdate);    
    if($resultUpdate) {
        $returnData["msg"] = "Success Join Lobby";
        $returnData["status"] = "1";//Success Join Lobby
        echo json_encode($returnData);    
        mysqli_close($db);
        return;
    }   
    else{
        echo mysqli_error($db);
        return;
    }           
}


exit();
?>
