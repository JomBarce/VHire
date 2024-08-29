<?php
    function createTrip($routeID, $vehicleID, $driverID, $departure, $arrival){ 
        $conn = mysqli_connect("localhost","root","","Vhire_Booking");
        $departure = str_replace("T", " ", $departure);
        $arrival = str_replace("T", " ", $arrival);
        
        $res = mysqli_query($conn, "SELECT Capacity FROM vhire where VehicleID =".$vehicleID);
        $vehicle = mysqli_fetch_assoc($res);
        $capacity = $vehicle['Capacity'];
        $select = "INSERT INTO trip (RouteID, VehicleID, DriverID, AvailableSeats, EstimatedTimeDeparture, EstimatedTimeArrival)
                    VALUES ($routeID, $vehicleID, $driverID, $capacity, '$departure', '$arrival')";
        $res2 = mysqli_query($conn, $select) or die(mysqli_error($conn));
        
        if($res2){
            mysqli_query($conn,"UPDATE vhire SET Status = 'In-Use' WHERE VehicleID = ".$vehicleID);
        }
        return $res2;
    }
?>
<!-- VehicleID, RouteID, DriverID, AvailableSeats, EstimatedTimeDeparture, EstimatedTimeArrival, Status -->