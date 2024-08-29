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
                    <div class="center4">
                        <div class="title2">
                            <h1>Ticket History</h1>
                        </div>
                        <div class="button_div">
                            <!-- This will show the Ticket history of the users (iterate from the reservations table) -->
                            <?php 
                                     include './php/ticket-route_action.php';
                                                
                                     foreach($_SESSION['history'] as $record){
                                        $timestamp = $record['EstimatedTimeDeparture'];   
                                         $splitTimeStamp = explode(" ",$timestamp);
                                         $date = $splitTimeStamp[0];
                                         $time1 = date("g:i a", strtotime("$splitTimeStamp[1]"));
                                        $timestamp = $record['EstimatedTimeArrival'];
                                         $splitTimeStamp = explode(" ",$timestamp);
                                         $time2 = date("g:i a", strtotime("$splitTimeStamp[1]"));
                                          $_SESSION['info'] =$record;
                                         ?><a href ="./ticket_info.php?data=<?php echo $record['ReservationID'];?>">
                                                        <button>
                                                        <table>
                                                                <tr>
                                                                   <td>
                                                       <?php                             
                                                        foreach($names as $place){
                                                            if($place['TID']==$record['OriginalTerminalID']){
                                                                    array($_SESSION['info'],$place); 
                                                                    $origin= $place['LN'];
                                                                     echo $origin."  To  ";
                                                                foreach($names as $place){
                                                                    if($place['TID']==$record['DestinationTerminalID']){
                                                                        array($_SESSION['info'],$place); 
                                                                        $des = $place['LN'];
                                                                        echo $des;
                                                                        echo "</td>
                                                                              <td> PHP ".$record['TotalFare']."</td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Sched: ".$time1." - ".$time2."   | Date: ".$date." | Origin: ". $origin ."</td>
                                                                    <td>Order No.".$record['ReservationID']."</td>
                                                            </tr>
                                                        </table>
                                                    </button> 
                                                    </a>";
                                                                }
                                                            }
                                                           
                                                 }
                                            }
                                        }  
                                            
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>   
    </body>
</html>