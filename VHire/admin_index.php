<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='driver'){
                header('Location:./driver_index.php');
            }else if ($_SESSION['user']['role']=='passenger'){
                header('Location:./index.php');
            }else if ($_SESSION['user']['AdminType']=='SuperAdmin'){
                header('Location:./super_admin.php');
            }
        }else{
            header('Location:./login.php');
        }

        date_default_timezone_set("Hongkong");

        // Get terminal name
        if(isset($_GET['id'])){
            //Refresh Every 5 seconds
            $url1=$_SERVER['REQUEST_URI'];
            header("Refresh: 5; URL=$url1");
        }

        $terminals = mysqli_query($conn, "SELECT * FROM terminal WHERE AdminID =".$_SESSION['user']['AdminID']);

        $vehicle = mysqli_query($conn, "SELECT * FROM vhire ");
        
        include_once './php/head.php';
    ?>
    <body>
        <header>
            <div id="header">
                <div class="hamburgerMenu">
                    <img id="menu" src="./images/icons/menu.png" alt="menu" onclick="menuButton()">
                </div>
                <div>
                    <a href="admin_index.php">
                        <img id="logo" src="./images/icons/logo.png" alt="logo">
                    </a>
                </div>
            </div>
        </header>
        <main>
            <div class="divider">
                <div id="left">
                    <?php include_once './php/admin_menu.php'; ?>
                </div>
                <div id="right">

                    <?php
                        if(!isset($_GET['id'])){
                    ?>
                    
                   <div class="center">
                        <div class="title">
                            <h1>Welcome, <?php echo $_SESSION['user']['FirstName']; ?>!</h1>
                        </div>
                        <div class="center_img">
                            <img id="loginlogo" src="./images/icons/logo2.png" alt="logo">
                        </div>
                        </br></br></br>
                        <h1 style="color: black">Terminals</h1>
                        <form id="trip_form" method="GET" onsubmit="chooseTerminal(event)">
                            <div class="select_div">
                                <select name="terminal" id="terminal">
                                    <option value="none" selected hidden>
                                        Select a Terminal
                                    </option>
                                    <?php while( $terminalList  = mysqli_fetch_assoc($terminals)) {
                                        echo "<option value='".$terminalList["TerminalID"]."'>".$terminalList['LocationName']."</option>";
                                    } ?>
                                </select>
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                    <?php
                        }else{
                            $terminal_id = $_GET['id'];
                            // Retrieve route data
                            $res2 = mysqli_query($conn, "SELECT * FROM route WHERE OriginalTerminalID =".$terminal_id);
                            $route = array();
                            for($x = 1; $row = mysqli_fetch_assoc($res2); $x++){
                                $route[$x] = $row['RouteID'];
                            } 
                            $values = implode(",",$route);  

                            // Retrieve All Trips for current date
                            $currentDate = new Datetime();
                            $trips = mysqli_query($conn, "SELECT * FROM trip WHERE RouteID IN ($values)
                                            AND date(EstimatedTimeDeparture) = '".$currentDate->format('Y-m-d')."' AND Status != 'Arrived' ");

                            // Terminal Names into Local Array
                            $terminal = mysqli_query($conn, "SELECT * FROM terminal");
                            $terminalName = array();
                            for($x = 1; $row = mysqli_fetch_assoc($terminal); $x++){
                                $terminalName[$x] = $row['LocationName'];
                            }
                            
                            if( mysqli_num_rows($trips) > 0){              
                    ?>
                    
                    <div class="center6">
                        <div class="title">
                            <h1><?php echo "Terminal $terminal_id: $terminalName[$terminal_id]";?></h1>
                        </div>
                        </br></br></br>
                        <div class = "divScroll" style="background-color: #ffd9d9;">
                            <table>
                                <tr>
                                    <th>TripID</th>
                                    <th>Vehicle</th>
                                    <th>Driver</th>
                                    <th>Destination</th>
                                    <th>Available Seats</th>
                                    <th>Estimated Time Departure</th>
                                    <th>Estimated Time Arrival</th>
                                    <th>Status</th>
                                </tr>

                                <?php
                                    //Loop through all trips
                                    while($trip = mysqli_fetch_assoc($trips)){  

                                        // Passengers count
                                        $res3 = mysqli_query($conn, "SELECT COUNT(ReservationID) AS COUNT FROM reservations WHERE tripid =".$trip['TripID']);
                                        $passengers = mysqli_fetch_assoc($res3); 
                                        $availableSeats = $trip['AvailableSeats']-$passengers['COUNT'];

                                        // Driver name
                                        $res4 = mysqli_query($conn, "SELECT CONCAT(FirstName,' ',MiddleName,' ',LastName) AS Name FROM Driver WHERE DriverID =".$trip['DriverID']);
                                        $driver = mysqli_fetch_assoc($res4);
                                        
                                        // Destination name
                                        $res5 = mysqli_query($conn, "SELECT DestinationTerminalID FROM Route WHERE RouteID =".$trip['RouteID']);
                                        $destination = mysqli_fetch_assoc($res5);

                                        // Format date
                                        $departure = new Datetime($trip['EstimatedTimeDeparture']);
                                        $arrival = new Datetime($trip['EstimatedTimeArrival']);

                                        echo " <tr>    
                                                    <td class='t_others'>".$trip['TripID']."</td>
                                                    <td class='t_others'>".$trip['VehicleID']."</td>
                                                    <td class='td_others'>".$driver['Name']."</td>
                                                    <td class='td_others'>".$terminalName[$destination['DestinationTerminalID']]."</td>
                                                    <td class='t_other'>".$availableSeats."</td>
                                                    <td class='td_others'>".$departure->format('M d, Y h:m:s A')."</td>
                                                    <td class='td_others'>".$arrival->format('M d, Y h:m:s A')."</td>
                                                    <td class='t_other'>".$trip['Status']."</td>
                                                </tr>";
                                } ?>

                            </table>
                        </div>
                        </br>
                        <div class="button_blue">
                            <button onclick="refreshAdmin()">Choose New Terminal</button>
                        </div>
                    </div> 

                    <?php
                        }else{
                    ?>

                    <div class="center6">
                        <div class="title">
                            <h1><?php echo "Terminal $terminal_id: $terminalName[$terminal_id]";?></h1>   
                        </div>
                        </br></br></br></br>
                        <div class="title">
                            <h1 style="color:black;">No Trips</h1>   
                        </div>
                        </br></br>
                        <div class="button_blue">
                            <button onclick="refreshAdmin()">Choose New Terminal</button>
                        </div>
                    </div>

                    <?php
                            }
                        }
                    ?>

                </div> 
            </div>

        </main>   
    </body>     
</html>