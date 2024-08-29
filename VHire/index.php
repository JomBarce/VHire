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
                    <div class="center">
                        <div class="center_img">
                            <img id="icon" src="./images/icons/vhire.png" alt="icon">
                        </div>
                        <div class="title">
                            <!-- This will be changed according to the name of the user that is logged in-->
                            <h1>Welcome, <?php echo $_SESSION['user']['FirstName']; ?>!</h1>
                        </div>
                        <!-- The form will call search_action.php which will search for the route -->
                        <form id="search" method="GET" onsubmit="searchSubmit(event)" >
                            <div class="form_div">
                                <div class="select_div">
                                    <label for="origin">From:</label>
                                    <select name="origin" id="origin">
                                        <option value="none" selected hidden>
                                            Select a Terminal
                                        </option>

                                        <?php
                                            $select = "SELECT * FROM Terminal"; 
                                            $query= mysqli_query($conn, $select);
                                            if(mysqli_num_rows($query) > 0){
                                                while( $row = mysqli_fetch_assoc($query) ){
                                                    echo "<option value=".$row['TerminalID'].">".$row['LocationName']."</option>";
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                                <div class="select_div">
                                    <label for="destination">To:</label>
                                    <select name="destination" id="destination">
                                        <option value="none" selected hidden>
                                            Select a Destination
                                        </option>

                                        <?php
                                            $select = "SELECT * FROM Terminal"; 
                                            $query= mysqli_query($conn, $select);
                                            if(mysqli_num_rows($query) > 0){
                                                while( $row = mysqli_fetch_assoc($query) ){
                                                    echo "<option value=".$row['TerminalID'].">".$row['LocationName']."</option>";
                                                }
                                            }
                                            $conn->close();
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="select_div">
                                <label for="time">Time:</label>
                                <select name="time" id="time">
                                    <option value="none" selected hidden>
                                        Select a Time
                                    </option>
                                    <option value="5:00&nbsp;AM&nbsp;-&nbsp;5:59&nbsp;AM">5:00 AM - 5:59 AM</option>
                                    <option value="6:00&nbsp;AM&nbsp;-&nbsp;6:59&nbsp;AM">6:00 AM - 6:59 AM</option>
                                    <option value="7:00&nbsp;AM&nbsp;-&nbsp;7:59&nbsp;AM">7:00 AM - 7:59 AM</option>
                                    <option value="8:00&nbsp;AM&nbsp;-&nbsp;8:59&nbsp;AM">8:00 AM - 8:59 AM</option>
                                    <option value="9:00&nbsp;AM&nbsp;-&nbsp;9:59&nbsp;AM">9:00 AM - 9:59 AM</option>
                                    <option value="10:00&nbsp;AM&nbsp;-&nbsp;10:59&nbsp;AM">10:00 AM - 10:59 AM</option>
                                    <option value="11:00&nbsp;AM&nbsp;-&nbsp;11:59&nbsp;AM">11:00 AM - 11:59 AM</option>
                                    <option value="12:00&nbsp;PM&nbsp;-&nbsp;12:59&nbsp;AM">12:00 PM - 12:59 AM</option>
                                    <option value="1:00&nbsp;PM&nbsp;-&nbsp;1:59&nbsp;PM">1:00 PM - 1:59 PM</option>
                                    <option value="2:00&nbsp;PM&nbsp;-&nbsp;2:59&nbsp;PM">2:00 PM - 2:59 PM</option>
                                    <option value="3:00&nbsp;PM&nbsp;-&nbsp;3:59&nbsp;PM">3:00 PM - 3:59 PM</option>
                                    <option value="4:00&nbsp;PM&nbsp;-&nbsp;4:59&nbsp;PM">4:00 PM - 4:59 PM</option>
                                    <option value="5:00&nbsp;PM&nbsp;-&nbsp;5:59&nbsp;PM">5:00 PM - 5:59 PM</option>
                                    <option value="6:00&nbsp;PM&nbsp;-&nbsp;6:59&nbsp;PM">6:00 PM - 6:59 PM</option>
                                    <option value="7:00&nbsp;PM&nbsp;-&nbsp;7:59&nbsp;PM">7:00 PM - 7:59 PM</option>
                                    <option value="8:00&nbsp;PM&nbsp;-&nbsp;8:59&nbsp;PM">8:00 PM - 8:59 PM</option>
                                    <option value="9:00&nbsp;PM&nbsp;-&nbsp;9:59&nbsp;PM">9:00 PM - 9:59 PM</option>
                                    <option value="10:00&nbsp;PM&nbsp;-&nbsp;10:59&nbsp;PM">10:00 PM - 10:59 PM</option>
                                </select>
                                <button type="submit" value="search" name="search">Search for Available Seats</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>   
    </body>
</html>