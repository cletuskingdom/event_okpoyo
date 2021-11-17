<?php
    // require_once('DBconnection.php');
    require_once("processrequest.php");

    $requestingPage = stripslashes($_GET['_mode']);
    $processRequest = new processRequest;
    
    switch ($requestingPage) {
        case "user-register":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $firstname = $processRequest->test_input($_POST['fname']);
                $lastname = $processRequest->test_input($_POST['lname']); 
                $username = $processRequest->test_input($_POST['username']);
                $passw = $processRequest->test_input($_POST['pass']);
                $password = md5($passw);
                $atype = $processRequest->test_input($_POST['type']);
                $avatar = "nothing";
                
                // Validation start
                if (empty($firstname)) {
                    $response = ['status' => 0, 'message' => '* First name is required'];
                }elseif (empty($lastname)) {
                    $response = ['status' => 0, 'message' => '* Last name is required'];
                }elseif (empty($username)) {
                    $response = ['status' => 0, 'message' => '* Username is required'];
                }else{
                    $servername = "localhost";
                    $DBusername = "root";
                    $DBpassword = "ubuntu";
                    $dbname = "event";

                    // insert registration data to db
                    try {
                        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $DBusername, $DBpassword);

                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "INSERT INTO users (firstname, lastname, username, password, avatar, type)
                        VALUES ('$firstname', '$lastname', '$username', '$password', '$avatar',' $atype')";
                        // use exec() because no results are returned
                        $conn->exec($sql);
                        
                        $response = ['status' => 1, 'message' => 'User account created.'];
                    } catch(PDOException $e) {
                        $response = ['status' => 0, 'message' => $e->getMessage()];
                    }
                    $conn = null;
                }
            }
            
        break;
    }
    echo json_encode($response);
?>