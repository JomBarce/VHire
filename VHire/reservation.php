<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='admin'){
                header('Location:./admin_index.php');
            }else if ($_SESSION['user']['role']=='driver'){
                header('Location:./driver_index.php');
            }
        }else{
            header('Location:./login.php');
        }

        if(!isset($_GET['id'])){
            header('Location:./result.php');
        }else{
            $trip_id = $_GET['id'];
        }

        include_once './php/reservation_action.php';
        $error = "";
        if(isset($_POST['reserve'])){
            //initialize variables
            $totalFare =  $_POST['fare'] *  $_POST['quantity'];
            $date = new DateTime();
            $currentDate = $date->format('Y-m-d H:i:s');

            //call create_reservation function and get reservation id
            $result = create_reservation($_POST['customerID'],$_POST['tripID'],$_POST['quantity'],$currentDate,$totalFare);
            $result2 = get_reservationID($_POST['customerID'],$_POST['tripID'],$currentDate);
            $reservation = mysqli_fetch_assoc($result2);
            
            //email message
            $message = "Please confirm booking request by clicking on this link. http://localhost/Vhire/confirmation.php?id=".$reservation['ReservationID'];
        
            if($result2){
                //sending email
                if(mail($_SESSION['user']['Email'],"Confirm Booking Request",$message,"From:phpmailtesting8@gmail.com")){
                    $error = "<h1 style='color:green'>Email sent successfully to ".$_SESSION['user']['Email']."</h1>";
                }else{
                    $error = "<h1 style='color:red'>Sorry, failed while sending mail</h1>";
                    delete_reservation($reservation['ReservationID']);
                }
            }else{
                $error = "Error creating reservation request";
                delete_reservation($reservation['ReservationID']);
            }
        }
        include_once './php/head.php';
    ?>
    <body>
        <header>
            <div id="header">
                <div class="hamburgerMenu">
                    <img id="menu" src="./images/icons/menu.png" alt="menu" onclick="menuButton()">
                </div>
                <div>
                    <a href="index.php"><img id="logo" src="./images/icons/logo.png" alt="logo"></a>
                </div>
            </div>
        </header>
        <main>
            <div class="divider">
                <div id="left">
                    <?php include_once './php/menu.php'; ?>
                </div>
                <div id="right">

                    <?php
                        $select1 = "SELECT * FROM Trip tp, Route r,Terminal tl, Vhire v WHERE tp.TripID='$trip_id' AND tp.RouteID=r.RouteID AND tp.VehicleID=v.VehicleID AND r.OriginalTerminalID= tl.TerminalID";
                        $select2 = "SELECT LocationName FROM Trip tp, Route r,Terminal tl WHERE tp.TripID='$trip_id' AND tp.RouteID=r.RouteID AND r.DestinationTerminalID= tl.TerminalID";
                        $query1= mysqli_query($conn, $select1);
                        $query2= mysqli_query($conn, $select2);
                        if(mysqli_num_rows($query1)>0 && mysqli_num_rows($query2)>0){
                            $row1 = mysqli_fetch_assoc($query1);
                            $row2 = mysqli_fetch_assoc($query2);
                            $departure = $row1['EstimatedTimeDeparture'];
                            $dtime = new DateTime($departure);
                            $arrival = $row1['EstimatedTimeArrival'];
                            $atime = new DateTime($arrival);
                        }

                        $conn->close();
                    ?>

                    <div class="center3">
                        <div class="table_div2">
                            <!-- This will show the Booking of ticket of the chosen route where users can reserve tickets up to the number of available seats  -->
                            <?php echo $error;?>
                            <table>
                                <form method="POST">
                                <tr>
                                    <th colspan="2"><?php echo $row1['LocationName']." - ".$row2['LocationName']; ?></th>
                                    <input type="hidden" name="tripID" value="<?php echo $trip_id;?>">
                                    <input type="hidden" name="customerID" value="<?php echo $_SESSION['user']['CustomerID'];?>">
                                    <input type="hidden" name="fare" value="<?php echo $row1['Fare'];?>">
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
                                    <td><input type="number" id="t_quantity" name="quantity" value="1" min="1" max="<?php echo $row1['AvailableSeats']; ?>" oninput="calcFare()"></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Fare Price</td>
                                    <td id="fare_price"><?php echo $row1['Fare']; ?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Total Amount</td>
                                    <td id="total_fare"><?php echo $row1['Fare']; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a href="#" class="button_blue"><button type="submit" name="reserve">Buy Ticket</button></a></td>
                                </tr>
                                
                            </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>   
    </body>
</html>