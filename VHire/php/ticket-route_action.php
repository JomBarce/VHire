<?php
  include_once 'connection.php';
  
$names=array();
 $_SESSION['history']=array();
 $_SESSION['route']=array();
 $person = $_SESSION['user']['CustomerID'];

 $select ="SELECT *  FROM reservations 
          LEFT JOIN trip ON trip.TripID = reservations.TripID
          LEFT JOIN vhire  ON trip.VehicleID = vhire.VehicleID
          LEFT JOIN route ON route.RouteID = trip.RouteID
          WHERE CustomerID =  $person 
          ORDER BY BookedDate DESC ";
 
 $query= mysqli_query($conn,$select);

if(mysqli_num_rows($query)>0){
    

    while($row = mysqli_fetch_assoc($query))
    {
        
        array_push($_SESSION['history'],$row);
       
       
        }
    } 



    $select ="SELECT * FROM terminal";
 
    $query= mysqli_query($conn,$select);
    
    if(mysqli_num_rows($query)>0){
      
    
       while($row = mysqli_fetch_assoc($query))
       {    
            $temp = array("TID"=>$row['TerminalID'], "LN"=>$row['LocationName']);
    
            array_push($names,$temp);
      }
    
    }   
   

    $select ="SELECT * , terminal.LocationName
        FROM route 
        LEFT JOIN terminal 
        ON route.DestinationTerminalID = terminal.TerminalID ";
        $query= mysqli_query($conn,$select);

        if(mysqli_num_rows($query)>0){

        while($row = mysqli_fetch_assoc($query)){
                array_push($_SESSION['route'],$row);    

            }

    } 
?>