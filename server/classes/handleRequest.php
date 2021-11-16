<?php
    require_once('./../../config.php');
    // session_start();
    $requestingPage = stripslashes($_GET['_mode']);
    
    switch ($requestingPage) {
        case "user-register":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $processRequest->test_input($_POST['fname']);
                $lname = $processRequest->test_input($_POST['lname']); 
                $username = $processRequest->test_input($_POST['username']);
                $password = $processRequest->test_input($_POST['password']);
                $type = $processRequest->test_input($_POST['type']);

                $response = ['status' => 0, 'message' => "* Phone is required"];

                // $access = $_POST['access'];
                // $gender =$_POST['gender'];	

                // if (empty($name) or (!preg_match("/^[a-zA-Z ]*$/",$name))) {
                //     $response = array('status'=>0,'input'=>"name",'message'=>"*Fullname is required and must contain only alphabets");
                // }elseif (empty($email)) {
                //     $response = array('status'=>0,'input'=>"name",'message'=>"*Email is required");
                // }elseif (empty($phone)) {
                //     $response = array('status'=>0,'input'=>"name",'message'=>"*Phone is required");
                // }else{

                // }
            }
            
        break;
    }
    echo json_encode($response);
?>