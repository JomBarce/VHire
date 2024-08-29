<?php
    include_once 'connection.php';

    $retVal = "";
    $isValid = true;
    $status = 400;

    $plate = trim($_GET['plate']);
    $brand = trim($_GET['brand']);
    $model = trim($_GET['model']);
    $capacity = trim($_GET['capacity']);
    $weight = trim($_GET['weight']);
    $status = trim($_GET['status']);
    

    // Check fields are empty or not
    if($plate=='' || $brand=='' || $model=='' || $capacity=='' || $weight=='' || $status==''){
        $isValid = false;
        $retVal = "Please fill all fields.";
    }

    // Check if Plate is valid
    if($isValid){
        $pattern = "/^[A-Z]{3}[-][0-9]{4}+$/s";
        // if(strlen($plate) != 8){
        //     $isValid = false;
        //     $retVal = "Invalid plate number.";
        // }else 
        if(!preg_match($pattern,$plate)){
            $isValid = false;
            $retVal = "Invalid plate number.";
        }
    }

    // Check if the Brand is valid
    if( !preg_match('/^[a-zA-Z\s]+$/', $brand) ){
        $isValid = false;
        $retVal = "Invalid brand.";
    }

    // Check if Capacity is valid or not
    if( !preg_match('/^[0-9]+$/s', $capacity) ){
        $isValid = false;
        $retVal = "Invalid capacity.";
    }

    // Check if Weight is valid or not
    if( !preg_match('/^[0-9]+$/s', $weight) ){
        $isValid = false;
        $retVal = "Invalid weight.";
    }

    if($isValid){
            $insertVehicle = "INSERT INTO `Vhire`(`PlateNumber`,`Brand`,`Model`,`Capacity`,`Weight`,`Status`) VALUES ('$plate','$brand','$model','$capacity','$weight','$status')";    
            if(mysqli_query($conn,$insertVehicle)){
                $status = 200;
            }else{
                $retVal = "Error";
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