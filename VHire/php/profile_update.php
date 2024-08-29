<?php
    include_once 'connection.php';

    $retVal = "";
    $isValid = true;
    $status = 400;
    $data = "";

    $fname = trim($_GET['first_name']);
    $mname = trim($_GET['middle_name']);
    $lname = trim($_GET['last_name']);
    $username = trim($_GET['username']);
    $phone = trim($_GET['contact_number']);
    $bday = trim($_GET['user_bday']);
    $email = trim($_GET['user_email']);
    $role = $_SESSION['user']['role'];
    $today = date("Y-m-d");

    if(isset($_SESSION['user'])){
        if ($_SESSION['user']['role']=='passenger'){
            $userid = $_SESSION['user']['CustomerID'];
        }else if ($_SESSION['user']['role']=='driver'){
            $userid = $_SESSION['user']['DriverID'];
        }
    }

    // Check fields are empty or not
    if($fname=='' || $mname=='' || $lname=='' || $username=='' || $bday=='' || $email=='' || $phone==''){
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
            $selectSQL = "SELECT DriverID FROM Driver WHERE Username='$username'";
            $query= mysqli_query($conn, $selectSQL);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($row['DriverID'] != $userid){
                    $isValid = false;
                    $retVal = $retVal . " Username is already taken.";
                }
            }
        }else if($role === 'passenger'){
            $selectSQL = "SELECT CustomerID FROM Customer WHERE Username='$username'";
            $query= mysqli_query($conn, $selectSQL);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($row['CustomerID'] != $userid){
                    $isValid = false;
                    $retVal = $retVal . " Username is already taken.";
                }
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
            $select = "SELECT DriverID FROM Driver WHERE Email ='$email'"; 
            $query= mysqli_query($conn, $select);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($row['DriverID'] !== $userid){
                    $isValid = false;
                    $retVal = "Email already exists.";
                }
            }
        }else if($role === 'passenger'){
            $select = "SELECT CustomerID FROM Customer WHERE Email ='$email'";
            $query= mysqli_query($conn, $select);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($row['CustomerID'] !== $userid){
                    $isValid = false;
                    $retVal = "Email already exists.";
                }
            }
        }
    }

    if($isValid){
        if($role === 'driver'){
            $updateDriver = "UPDATE Driver SET LicenseNumber='$license',FirstName='$fname',MiddleName='$mname',LastName='$lname',ContactNumber='$phone',Email='$email',Username='$username',DateOfBirth='$bday' WHERE DriverID='$userid'";
            if(mysqli_query($conn,$updateDriver)){
                $status = 200;
                $data = "driver";
            }
        }else if($role === 'passenger'){
            $updateCust = "UPDATE Customer SET FirstName='$fname',MiddleName='$mname',LastName='$lname',ContactNumber='$phone',Email='$email',Username='$username',DateOfBirth='$bday' WHERE CustomerID='$userid'";  
            if(mysqli_query($conn,$updateCust)){
                $status = 200;
                $data = "passenger";
            }
        }
    }   

    $myObj = array(
        'status' => $status,
        'data' => $data,
        'message' => $retVal  
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;

    $conn->close();
?>