<?php
    include_once 'connection.php';

    $retVal = "";
    $isValid = true;
    $status = 400;

    $trip_id = trim($_GET['trip_id']);
    $trip_status = trim($_GET['trip_status']);

    if($trip_status == "Accepted"){
        $retVal = "Trip has been started.";
    }else{
        $retVal = "Trip has been stopped.";
    }    
    
    if($isValid){
        date_default_timezone_set('Asia/Manila');
        $today = date("Y-m-d h:i:s A");
        $updateTrip = "UPDATE Trip SET Status='$trip_status' WHERE tripID='$trip_id'";
        if(mysqli_query($conn,$updateTrip)){
            $status = 200;
        }else{
            $retVal = "ERROR";
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