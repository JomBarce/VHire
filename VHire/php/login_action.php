<?php
    include_once 'connection.php';

    $retVal = "";
    $isValid = true;
    $status = 400;
    $data = "";

    $name = trim($_GET['user_name']);
    $pass = trim($_GET['pword']);
    $role = $_GET['role'];

    // Check fields are empty or not
    if($name == '' || $pass == ''){
        $isValid = false;
        $retVal = "Please fill all fields.";
    }

    if($isValid){
        $pass = md5($pass);
    }

    if($role == 'admin'){
        // If role is admin
        $select ="SELECT * FROM admin WHERE username = '$name' AND password='$pass'";
        $query=mysqli_query($conn,$select);
        if(mysqli_num_rows($query) > 0){
            $person = mysqli_fetch_assoc($query);
            if($person['Username']== $name && $person['Password']==$pass){
                $_SESSION['user']=$person;
                $_SESSION['user']['role']="admin";
                $data = "admin";
                $status = 200;
            }
        }else{
            $retVal = "User not found.";
        }
    }else if( $role == 'driver'){
        // If role is driver
        $select ="SELECT * FROM driver WHERE username = '$name' AND password='$pass' ";
        $query=mysqli_query($conn,$select);
        if(mysqli_num_rows($query) > 0){
            $person = mysqli_fetch_assoc($query);
            if($person['Username']==$name && $person['Password']==$pass){
                $_SESSION['user']=$person;
                $_SESSION['user']['role']="driver";
                $data = "driver";
                $status = 200;
            }
        }else{
            $retVal = "User not found.";
        }
    }else if($role == 'passenger'){
        // If role is passenger
        $select="SELECT * FROM customer WHERE username = '$name' AND password='$pass'";
        $query=mysqli_query($conn,$select);
        if(mysqli_num_rows($query) > 0){
            $person = mysqli_fetch_assoc($query);
            if($person['Username']==$name && $person['Password']==$pass){
                $_SESSION['user']=$person;
                $_SESSION['user']['role']="passenger";
                $data = "passenger";
                $status = 200;
            }
        }else{
            $retVal = "User not found.";
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