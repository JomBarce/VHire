<?php
    include_once 'connection.php';
    $retVal = "";
    $isValid = true;
    $status = 400;
    $data = [];

    $cancel = $_GET['data'];
    
    $update ="UPDATE reservations
            SET R_Status = 'Cancelled'
            WHERE reservations.ReservationID = $cancel";

    if(mysqli_query($conn,$update)){
        $status = 200;
    }else{
        $retVal = "ERROR: please try again.";
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