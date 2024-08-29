<?php
    include_once 'connection.php';

    $retVal = "";
    $isValid = true;
    $status = 400;

    $fname = trim($_GET['f_name']);
    $mname = trim($_GET['m_name']);
    $lname = trim($_GET['l_name']);
    $username = trim($_GET['user_name']);
    $bday = trim($_GET['bday']);
    $email = trim($_GET['email']);
    $phone = trim($_GET['phone']);
    $password = trim($_GET['password']);
    $vpassword = trim($_GET['confirm_pword']);
    $today = date("Y-m-d"); 

    // Check fields are empty or not
    if($fname=='' || $mname=='' || $lname=='' || $username=='' || $bday=='' || $email=='' || $phone=='' || $password=='' || $vpassword==''){
        $isValid = false;
        $retVal = "Please fill all fields.";
    }

    // Check if the Name is valid
    if( !preg_match('/^[a-zA-Z\s]+$/', $fname) || !preg_match('/^[a-zA-Z\s]+$/', $mname) || !preg_match('/^[a-zA-Z\s]+$/', $lname)){
        $isValid = false;
        $retVal = $retVal . "Invalid Name.";
    }

    // Check if Username is taken
    if($isValid){
        $selectSQL = "SELECT * FROM `Admin` WHERE Username='$username'";
        $query= mysqli_query($conn, $selectSQL);
        if(mysqli_num_rows($query) > 0){
            $isValid = false;
            $retVal = $retVal . " Username is already taken.";
        }
    }

    // Check if Birthday is valid
    if($isValid && $bday >= $today){
        $isValid = false;
        $retVal = "Invalid birthday.";
    }

    // Check if email is valid or not
    if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $retVal = "Invalid email.";
    }

    // Check if phone is valid or not
    if($isValid){
        $pattern = "/^[0-9]+$/s";
        if(strlen($phone) != 11){
            $isValid = false;
            $retVal = "Invalid phone number.";
        }else if(!preg_match($pattern,$phone)){
            $isValid = false;
            $retVal = "Invalid phone number.";
        }
    }

    // Check if email already exists
    if($isValid){
        $selectSQL = "SELECT * FROM `Admin` WHERE Email ='$email'"; 
        $query= mysqli_query($conn, $selectSQL);
        if(mysqli_num_rows($query) > 0){
            $isValid = false;
            $retVal = "Email already exists.";
        }
    }

    // Check if confirm password matching or not
    if($isValid && ($password != $vpassword) ){
        $isValid = false;
        $retVal = "Confirm password not matching.";
    }

    if($isValid){;
            $insertCust = "INSERT INTO `Admin`(`FirstName`,`MiddleName`,`LastName`,`ContactNumber`,`Email`,`Username`,`Password`,`DateOfBirth`) VALUES ('$fname','$mname','$lname','$phone','$email','$username','$password','$bday')";    
            if(mysqli_query($conn,$insertCust)){
                $status = 200;
            }    
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal  
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;

    $conn->close();
?>