<?php
    function create_reservation($custID,$tripID,$quantity,$booked,$fare){
        $conn = mysqli_connect("localhost","root","","Vhire_Booking");

        $res = mysqli_query($conn, "INSERT INTO reservations(CustomerID,TripID,Quantity,BookedDate,TotalFare) 
                            VALUES ($custID,$tripID,$quantity,'$booked',$fare)");

        return $res;
    }

    function get_reservationID($custID,$tripID,$booked){
        $conn = mysqli_connect("localhost","root","","Vhire_Booking");

        $res = mysqli_query($conn, "SELECT ReservationID FROM reservations WHERE CustomerID =".$custID." 
                            AND TripID =".$tripID." AND BookedDate = '".$booked."'");

        return $res;      
    }

    function delete_reservation($resID){
        $conn = mysqli_connect("localhost","root","","Vhire_Booking");

        mysqli_query($conn, "DELETE FROM reservations WHERE ReservationID =".$resID);    
    }
?>