<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='admin'){
                ob_start();
                header('Location:./admin_index.php');
                ob_end_flush();
                die();
            }else if ($_SESSION['user']['role']=='passenger'){
                ob_start();
                header('Location:./index.php');
                ob_end_flush();
                die();
            }
        }else{
            ob_start();
            header('Location:./login.php');
            ob_end_flush();
            die();
        }
        
        date_default_timezone_set("Hongkong");

        // Retrieve All Trips for current date
        $currentDate = new Datetime();
        $trips = mysqli_query($conn, "select * from trip where driverid = ".$_SESSION['user']['DriverID'].
                        " AND date(estimatedtimedeparture) >= '".$currentDate->format('Y-m-d')."' AND status != 'Arrived' ");
    
        // Terminal Names into Local Array
        $terminal = mysqli_query($conn, "SELECT * FROM terminal");
        $terminalName = array();
        for($x = 1; $row = mysqli_fetch_assoc($terminal); $x++){
            $terminalName[$x] = $row['LocationName'];
        } 

        // Refresh Every 10 seconds
        if(mysqli_num_rows($trips) > 0){
            // Fetch current trip row
            $trip = mysqli_fetch_assoc($trips);
            
            // Retrieve route data
            $res2 = mysqli_query($conn, "SELECT * FROM route where routeid =".$trip['RouteID']);
            $route = mysqli_fetch_assoc($res2);

            // Retrieve all passengers on that Trip
            $res3 = mysqli_query($conn, "SELECT * FROM reservations where tripid =".$trip['TripID']);

            // Passengers count
            $res4 = mysqli_query($conn, "SELECT COUNT(ReservationID) AS COUNT FROM reservations where tripid =".$trip['TripID']);
            $passengers = mysqli_fetch_assoc($res4); 
            $totalFare= 0;
            $availableSeats = $trip['AvailableSeats']-$passengers['COUNT'];

            if ($trip['Status'] == "Upcoming" && $availableSeats != 0){
                $url1=$_SERVER['REQUEST_URI'];
                header("Refresh: 10; URL=$url1");
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
                    <a href="driver_index.php"><img id="logo" src="./images/icons/logo.png" alt="logo"></a>
                </div>
            </div>
        </header>
        <main>

            <div class="divider">
                
                <div id="left">
                    <?php include_once './php/driver_menu.php'; ?>
                </div>
        
            <?php 
                    if( mysqli_num_rows($trips) > 0){     
                        $conn->close();    
            ?>
                <div id="right">
                    <div class="center6">
                        <div class="table_div3">
                            <table>
                                <tr>
                                    <th colspan="6"><h2>TRIP <?php echo $trip['TripID']?> | ORIGIN - DESTINATION
                                    (<?php echo $terminalName[$route['OriginalTerminalID']]." - ". $terminalName[$route['DestinationTerminalID']] ?>)</h2></td>
                                </tr>
                                <tr>
                                    <td>Route ID: <?php echo $trip['RouteID']; ?></td>
                                    <td>Available Seats: <?php echo $availableSeats; ?></td>
                                    <td>Maximum Capacity: 14</td>
                                    <td>Fare: <?php echo $route['Fare']; ?></td>
                                    <td >
                                        <?php if($trip['Status'] == "Upcoming"){
                                            echo "<form class='form_div2' id='trip_start' method='GET' onsubmit='startTrip(event)'>
                                                    <input type='hidden' name='trip_id' id='trip_id' value='".$trip['TripID']."'/>
                                                    <input type='hidden' name='trip_status' id='trip_status' value='Ongoing'/>
                                                    <button class='button1' type='submit'>StartRide</button>
                                                    <button class='button_disabled' disabled>Stop</button>
                                                </form>";
                                        } else {
                                            echo "<form class='form_div2' id='trip_stop' method='GET' onsubmit='stopTrip(event)'>
                                                    <input type='hidden' name='trip_id' id='trip_id' value='".$trip['TripID']."'/>
                                                    <input type='hidden' name='trip_status' id='trip_status' value='Arrived'/>
                                                    <button class='button_disabled' disabled>StartRide</button>
                                                    <button class='button1' type='submit'>Stop</button>
                                                </form>";
                                        }?>
                                    </td>
                                </tr>
                            </table>
                        </div>   
                        <div class = "divScroll">
                            <table>
                                <tr>
                                    <th>OrderID</th>
                                    <th>TripID</th>
                                    <th>CustomerID</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Amount Due</th>
                                    <th></th>
                                </tr>

                        <?php   //Loop through all customers
                                while($reserve = mysqli_fetch_assoc($res3)){ 
                                    $totalFare += $reserve['TotalFare'];
                                    $tripDate = new Datetime($reserve['BookedDate'])
                                    ?>
                                <tr>    
                                    <td class="t_other"><?php echo $reserve['ReservationID']; ?></td>
                                    <td class="td_others"><?php echo $reserve['TripID']; ?></td>
                                    <td class="td_others"><?php echo $reserve['CustomerID']; ?></td>
                                    <td class="td_others"><?php echo $reserve['Quantity']; ?></td>
                                    <td class="td_other"><?php echo $tripDate->format('M d, Y'); ?></td>
                                    <td class="td_other">Php <?php echo $reserve['TotalFare']; ?></td>
                                </tr>
                        <?php } ?>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>Total Fare Amount</th>
                                    <th>Php <?php echo $totalFare?></th>
                                </tr>
                            </table>
                        
                        </div>
                    </div>
                </div>      
               
            <?php 
            // IF NO TRIPS WERE AVAILABLE 
            } else { 
                echo 
                    "<div id='right' style='margin-top: 75px;'>
                        <div id='center6'>
                        <div>
                        <a href='create_trip.php'><img id='loginlogo' src='./images/icons/logo2.png' alt='logo'></a>
                        </div>
                        <h1 style='color:red; margin: 70px 0 30px 0;'>
                            No trips available for ".$currentDate->format('Y-m-d')."
                        </h1>
                        <h2 style='color:black'> 
                            <a style='color:blue;text-decoration:underline' href='./create_trip.php'>Click here</a>  
                            to create trip 
                        </h2>
                    </div></div>";  
                }                             
            ?>
            </div>
        </main>   
    </body>
</html>