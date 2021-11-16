<?php
    // session_start();
    require_once('./../../config.php');
    require_once("processrequest.php");
    $requestingPage = stripslashes($_GET['_mode']);
    $processRequest = new processRequest;
    
    switch ($requestingPage) {
        case "user-register":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $processRequest->test_input($_POST['fname']);
                $lname = $processRequest->test_input($_POST['lname']); 
                $username = $processRequest->test_input($_POST['username']);
                $password = $processRequest->test_input($_POST['password']);
                $type = $processRequest->test_input($_POST['type']);

                $response = ['status' => 0, 'message' => "* Phone is required"];
                
                // Validation start
                if (empty($fname)) {
                    $response = ['status' => 0, 'message' => '* First name is required'];
                }elseif (empty($lname)) {
                    $response = ['status' => 0, 'message' => '* Last name is required'];
                }elseif (empty($username)) {
                    $response = ['status' => 0, 'message' => '* Username is required'];
                }else{

                }
            }
            
        break;
    }
    echo json_encode($response);
?>