<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';
        
        if(!isset($_GET['id'])){
            header('Location:./login.php');
        }else{
            $reservation_id = $_GET['id'];
        }

        $ticket_select = "SELECT * FROM Reservations WHERE ReservationID='$reservation_id'";
        $t_query= mysqli_query($conn, $ticket_select);
        if(mysqli_num_rows($t_query)){
            $t_row = mysqli_fetch_assoc($t_query);
            $t_trip = $t_row['TripID'];
            $t_passenger = $t_row['CustomerID'];
        }else{
            header('Location:./login.php');
        }

        if($t_row['R_Status'] == 'Cancelled'){
            header('Location:./login.php');
        }

        include_once './php/head.php';
    ?>
    <body>
        <header>
            <div id="header">
                <div></div>
                <div>
                    <a href="question.php"><img id="logo" src="./images/icons/logo.png" alt="logo"></a>
                </div>
            </div>
        </header>
        <main>
            <div class="question">
                <h1>Verify the Ticket Reservation:</h1>
            </div>

            <?php
                $p_select = "SELECT CONCAT(FirstName,' ',MiddleName,' ',Lastname) AS 'FullName' FROM Customer WHERE CustomerID='$t_passenger'";
                $p_query= mysqli_query($conn, $p_select);
                if(mysqli_num_rows($p_query)){
                    $p_row = mysqli_fetch_assoc($p_query);
                }

                $select1 = "SELECT * FROM Trip tp, Route r,Terminal tl, Vhire v WHERE tp.TripID='$t_trip' AND tp.RouteID=r.RouteID AND tp.VehicleID=v.VehicleID AND r.OriginalTerminalID= tl.TerminalID";
                $select2 = "SELECT LocationName FROM Trip tp, Route r,Terminal tl WHERE tp.TripID='$t_trip' AND tp.RouteID=r.RouteID AND r.DestinationTerminalID= tl.TerminalID";
                $query1= mysqli_query($conn, $select1);
                $query2= mysqli_query($conn, $select2);
                if(mysqli_num_rows($query1)>0 && mysqli_num_rows($query2)>0){
                    $row1 = mysqli_fetch_assoc($query1);
                    $row2 = mysqli_fetch_assoc($query2);
                    $departure = $row1['EstimatedTimeDeparture'];
                    $dtime = new DateTime($departure);
                    $arrival = $row1['EstimatedTimeArrival'];
                    $atime = new DateTime($arrival);
                    
                    $date = date("Y-m-d H:i:s");
                    $dtime_1 = date($departure);
                    $time = strtotime($dtime_1);
                    $time = $time - (15 * 60);
                    $dtime_1 = date("Y-m-d H:i:s", $time);
                }else{
                    echo '<div class="divider">
                            <h1 style="color:red;">Error: Failed Confirming Booking Request</h1>
                        </div>';
                }
            ?>

            <div class="divider">
                <div class="center3">
                    <div class="table_div2">
                        <table>
                            <tr>
                                <th colspan="2"><?php echo $row1['LocationName']." - ".$row2['LocationName']; ?></th>
                            </tr>
                            <tr>
                                <td class="td_bold">Passenger ID:</td>
                                <td><?php echo $t_row['CustomerID']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Passenger Name:</td>
                                <td><?php echo $p_row['FullName']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Vehicle Plate No.</td>
                                <td><?php echo $row1['PlateNumber']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Terminal</td>
                                <td><?php echo $row1['LocationName']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Time</td>
                                <td><?php echo $dtime->format('h:i A')." - ".$atime->format('h:i A'); ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Quantity</td>
                                <td><?php echo $t_row['Quantity']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Fare Price</td>
                                <td id="fare_price"><?php echo $row1['Fare']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_bold">Total Amount</td>
                                <td id="total_fare"><?php echo $t_row['TotalFare']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <?php
                if($t_row['R_Status'] == 'Pending'){
                        echo '<div class="divider">
                            <form id="ticket_confirm" method="GET" onsubmit="confirmRes(event)">
                                <input type="hidden" name="res_id" id="res_id" value="'.$reservation_id.'"/>
                                <input type="hidden" name="res_status" id="res_status" value="Accepted"/>
                                <button type="submit" class="confirm_btn">Accept</button>
                            </form>
                            <form id="ticket_cancel" method="GET" onsubmit="cancelRes(event)">
                                <input type="hidden" name="res_id" id="res_id" value="'.$reservation_id.'"/>
                                <input type="hidden" name="res_status" id="res_status" value="Cancelled"/>
                                <button type="submit" class="cancel_btn">Cancel</button>
                            </form>
                        </div>'; 
                }else if($t_row['R_Status'] == 'Accepted'){
                    echo '<div class="divider">
                            <h1 style="color:green;">Already Confirmed Booking Request</h1>
                        </div>';
                 }
                $conn->close();
            ?> 
        </main>   
    </body>
</html>