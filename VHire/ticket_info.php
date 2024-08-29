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
                    <!-- This will show ticket information and it is where users can cancel the reservations -->
                    <?php
                        include './php/ticket-route_action.php';
                        $id = $_GET['data'];
                        foreach($_SESSION['history'] as $record){
                            if($id == $record['ReservationID']){ 
                                $timestamp = $record['EstimatedTimeDeparture'];   
                                $splitTimeStamp = explode(" ",$timestamp);
                                $time1 = date("g:i a", strtotime("$splitTimeStamp[1]"));
                                $timestamp = $record['EstimatedTimeArrival'];
                                $splitTimeStamp = explode(" ",$timestamp);
                                $checkdate = $splitTimeStamp[0];
                                $time2 = date("g:i a", strtotime("$splitTimeStamp[1]"));
                                
                  ?>
                    <div id="right_left">
                        <div class="table_div2">
                            <table>
                                <tr>
                                    <th colspan="2">
                                        
                                        <?php  
                                            foreach($names as $place){
                                                 if($place['TID']==$record['OriginalTerminalID']){
                                                           $origin=$place['LN'];
                                                           echo $origin;
                                                }
                                            }   
                                            ?>                 
                                    
                                    </th>
                                </tr>
                                <tr>
                                    <td class="td_bold">Vehicle Plate No.</td>
                                    <td><?php echo $record['PlateNumber'];  ?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Terminal</td>
                                    <td><?php echo $origin; ?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Time</td>
                                    <td><?php echo $time1." - ".$time2;?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Quantity</td>
                                    <td><?php echo $record['Quantity']; ?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Fare Price</td>
                                    <td>PHP <?php echo $record['Fare'];?></td>
                                </tr>
                                <tr>
                                    <td class="td_bold">Total Amount</td>
                                    <td>PHP <?php echo $record['TotalFare'];?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <form id="search" method="GET" onsubmit="cancelClick(event)" >
                                            <?php
                                                date_default_timezone_set("Hongkong");
                                                $currentdate = date("Y-m-d");
                                                $currenttime = date("h:i:sa");
                                                if($currentdate < $checkdate && $record['R_Status'] != 'Cancelled'){
                                            ?>  
                                                    <input type="hidden" name="data" value="<?php echo $record['ReservationID']?>"/>
                                                    <button class="button_blue" type="submit">Cancel</button>
                                                    
                                            <?php  
                                                }
                                                else if($currentdate == $checkdate && $record['R_Status'] != 'Cancelled'){
                                                    if($currenttime < $time2){
                                            ?>
                                                    <input type="hidden" name="data" value="<?php echo $record['ReservationID']?>"/>
                                                    <button class="button_blue" type="submit">Cancel</button>
                                                
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- This will show ticket log ( ticket number, confirmed date, departure time, ride confirmed) -->
                    <div id="right_right">
                        <div class="ticket">
                            <div class="ticket_img">
                                <img id="vhire" src="./images/icons/vhire2.png" alt="vhire">
                            </div>
                            <div class="ticket_details">
                                <div class="ticket_gap">
                                    <h2>Booking Details</h2>
                                </div>
                                <div>
                                    <h2>Order Number</h2>
                                    <h2>#<?php echo $record['ReservationID']?></h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ticket_img">
                                <img id="dot" src="./images/icons/dot.png" alt="dot">
                            </div>
                            <div class="ticket_details">
                                <div class="ticket_gap">
                                    <h2>Booking Confirmed</h2>
                                    <p>
                                        <?php 
                                                $timestamp =  $record['ConfirmationDate'];   
                                                $splitTimeStamp = explode(" ",$timestamp);
                                                $date = $splitTimeStamp[0];
                                                echo $date; 
                                    
                                        ?>
                                    </p>
                                </div>
                                <div class="ticket_gap">
                                    <h2>Vehicle Available</h2>
                                    <p>
                                        <?php
                                           
                                           $timestamp = $record['EstimatedTimeDeparture'];
                                           $splitTimeStamp = explode(" ",$timestamp);
                                           $date = $splitTimeStamp[0];
                                           echo $date;
                                    
                                        ?>
                                    </p>
                                </div>
                                <div class="ticket_gap">
                                    <h2>Ride Confirmed</h2>
                                    <p> 
                                        <?php
                                         $timestamp = $record['EstimatedTimeArrival'];
                                         $splitTimeStamp = explode(" ",$timestamp);
                                         $date = $splitTimeStamp[0];
                                            echo $date;
                                    
                                          ?>
                                    
                                  </p>
                                </div>
                            </div>
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