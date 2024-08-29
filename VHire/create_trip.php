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

        include_once './php/trip_create.php';
        $error = " ";
        // INSERT Trip into Database
        if(isset($_POST["create_trip"])){
            $isValid = true;
            $departureTime = date('G',strtotime($_POST['departure']));
            $arrivalTime = date('G',strtotime($_POST['arrival']));

            echo $departureTime;
            echo $arrivalTime;

            // Form Validation  
            if($departureTime > $arrivalTime){
                $isValid = false;
                $error = "Departure time should be lesser than arrival time.";
            }

            if(($isValid) && $departureTime < '5' || $arrivalTime >= '23'){
                $isValid = false;
                $error = "Travel Hours should be between 5:00 AM and 11:00 PM.";              
            }

            // Form Valid then call createTrip();
            if($isValid){
                $response = createTrip($_POST['route'], $_POST['vehicle'], $_SESSION['user']['DriverID'], 
                                   $_POST['departure'], $_POST['arrival']);
                if($response){
                    ob_start();
                    header('Location:./driver_index.php');
                    ob_end_flush();
                    die();
                }else{
                    $error = "Error: Status Code 500 Internal Server Error";
                }
            }
        }
        // END of Insert Trip

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
                    <?php include_once './php/driver_menu.php'; ?>
                </div>
                <div id="right">

                    <?php
                        $select = "SELECT * FROM Driver WHERE DriverID =".$_SESSION['user']['DriverID'].""; 
                        $query= mysqli_query($conn, $select);
                        if(mysqli_num_rows($query) > 0){
                            $row = mysqli_fetch_assoc($query);
                            if($row['ProfilePicture'] == NULL){
                                $imageURL = './images/drivers/placeholder.png';
                            }else{
                                $imageURL = $row['ProfilePicture'];	
                            }
                            $fullname = $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
                        }
                        $dateformat = date("m/d/Y", strtotime($row["DateOfBirth"])); 
                    ?>

                    <div class="center4">
                        <div>
                                <h1 style="color:Black; margin: 75px 0 10px 0;">CREATE TRIP</h1>
                                <h3>Driver Name: <?php echo $fullname;?> </h3> 
                        </div>
                    
                    <div>
                        <div class="form_div">
                                <h1 class="profile_text">Trip Details</h1>
                            </div>

                            <?php
                                // GET ROUTES AND VEHICLES QUERIES
                                $res = mysqli_query($conn, "SELECT * FROM vhire WHERE status = 'Available' ");
                                $res2 = mysqli_query($conn, "SELECT * FROM route");
                                
                                // Terminal Names into Local Array
                                $terminal = mysqli_query($conn, "SELECT * FROM terminal");
                                $terminalName = array();
                                for($x = 1; $row = mysqli_fetch_assoc($terminal); $x++){
                                    $terminalName[$x] = $row['LocationName'];
                                }                           
                            ?>

                            
                            <form id="profileform" method="POST">
                                <?php
                                echo "<h3 style='color:red'>".$error."</h3>";
                                ?>    
                            
                                <div class="form_div2">
                                    <label for="vehicle">Vehicle:</label>
                                    <select class="input3" name="vehicle"> 
                                        <?php 
                                            while($row = mysqli_fetch_assoc($res)){
                                                echo "<option value='".$row['VehicleID']."'>".$row['PlateNumber']." - ".$row['Brand']." ".$row['Model']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form_div2">
                                    <label  for="route">Route:</label>
                                    <select class="input3" name="route"> 
                                        <?php 
                                            while($row = mysqli_fetch_assoc($res2)){
                                                echo "<option value='".$row['RouteID']."'>".$row['RouteID']." - ".
                                                $terminalName[$row['OriginalTerminalID']]." to ".$terminalName[$row['DestinationTerminalID']]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form_div2">
                                    <label  for="departure">Est. Departure Time:</label>
                                    <input type="datetime-local" class="input4" name="departure" required/>
                                </div>
                                <div class="form_div2">
                                    <label  for="arrival">Est. Arrival Time:</label>
                                    <input type="datetime-local" class="input4" name="arrival" required/>
                                </div>
                                <button type="submit" name="create_trip">Submit</button>
                            </form> 
                        </div>
                    </div>                    
                </div>   
            </div>     
        </main>   
    </body>
</html>