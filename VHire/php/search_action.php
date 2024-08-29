<?php 
    include_once './connection.php';
    $retVal = "";
    $isValid = true;
    $status = 400;
    $data = [];

    $origin = $_GET['origin'];
    $destination = $_GET['destination'];
    $time = $_GET['time'];
    
    // Check fields are empty or not.
    if(strcmp($origin, 'none') == 0 || strcmp($destination, 'none') == 0  || strcmp($time, 'none') == 0 ){
        $isValid = false;
        $retVal = "Please fill all fields.";
    }else if($origin == $destination){
    // Check if origin and destination is the same.
        $isValid = false;
        $retVal = "Origin Terminal and Destination Terminal should not be the same.";
    }

    if($isValid){
        // Save Origin Values in Session.
        $select = "SELECT * FROM Terminal WHERE TerminalID ='$origin'"; 
        $query= mysqli_query($conn, $select);
        if(mysqli_num_rows($query) > 0){
            $o_values = mysqli_fetch_assoc($query);
        }
        $_SESSION['origin'] = $o_values;

        // Save Destination Values in Session.
        $select = "SELECT * FROM Terminal WHERE TerminalID ='$destination'"; 
        $query= mysqli_query($conn, $select);
        if(mysqli_num_rows($query) > 0){
            $d_values = mysqli_fetch_assoc($query);
        }
        $_SESSION['destination'] = $d_values;

        // Save Time in Session;
        $_SESSION['time'] = $time;
        $status = 200;
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