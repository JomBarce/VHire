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
    $role = $_GET['role'];
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
        if($role === 'driver'){
            $selectSQL = "SELECT * FROM Driver WHERE Username='$username'";
            $query= mysqli_query($conn, $selectSQL);
            if(mysqli_num_rows($query) > 0){
                $isValid = false;
                $retVal = $retVal . " Username is already taken.";
            }
        }else if($role === 'customer'){
            $selectSQL = "SELECT * FROM Customer WHERE Username='$username'";
            $query= mysqli_query($conn, $selectSQL);
            if(mysqli_num_rows($query) > 0){
                $isValid = false;
                $retVal = $retVal . " Username is already taken.";
            }
        }
    }

    // Check if Birthday is valid
    if($isValid && $bday >= $today){
        $isValid = false;
        $retVal = "Invalid birthday.";
    }

    // Check if license is valid
    if($isValid && $role === 'driver'){
        $license = trim($_GET['license']);
        $pattern = "/^[A-Za-z]\d+$/s";
        if(strlen($license) != 11){
            $isValid = false;
            $retVal = "Invalid license number.";
        }else if(!preg_match($pattern,$license)){
            $isValid = false;
            $retVal = "Invalid license number.";
        }
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
        if($role === 'driver'){
            $select = "SELECT * FROM Driver WHERE Email ='$email'"; 
            $query= mysqli_query($conn, $select);
            if(mysqli_num_rows($query) > 0){
                $isValid = false;
                $retVal = "Email already exists.";
            }
        }else if($role === 'customer'){
            $select = "SELECT * FROM Customer WHERE Email ='$email'";
            $query= mysqli_query($conn, $select);
            if(mysqli_num_rows($query) > 0){
                $isValid = false;
                $retVal = "Email already exists.";
            }
        }
    }

    // Check if confirm password matching or not
    if($isValid && ($password != $vpassword) ){
        $isValid = false;
        $retVal = "Confirm password not matching.";
    }

    if($isValid){
        if($role === 'driver'){
            // Encrypt the password
            $password = md5($password);
            // Ecrypt the license
            // $license = md5($license);
            $insertDriver = "INSERT INTO `driver`(`LicenseNumber`,`FirstName`,`MiddleName`,`LastName`,`ContactNumber`,`Email`,`Username`,`Password`,`DateOfBirth`) VALUES ('$license','$fname','$mname','$lname','$phone','$email','$username','$password','$bday')";
            if(mysqli_query($conn,$insertDriver)){
                $status = 200;
            }
        }else if($role === 'customer'){
            // Encrypt the password
            $password = md5($password);
            $insertCust = "INSERT INTO `customer`(`FirstName`,`MiddleName`,`LastName`,`ContactNumber`,`Email`,`Username`,`Password`,`DateOfBirth`) VALUES ('$fname','$mname','$lname','$phone','$email','$username','$password','$bday')";    
            if(mysqli_query($conn,$insertCust)){
                $status = 200;
            }    
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