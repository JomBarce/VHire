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
                    <div class="cards">
                <?php include_once './php/ticket-route_action.php'; 
                                 $stop=1;
                                 $ctr=0;
                                do{
                                    foreach($names as $place){
                                        echo"<div class=right_equal>";
                                        echo"<br>";
                                        echo "<h2>".$place['LN']."</h2>"; 
                                                foreach($_SESSION['route'] AS $location){    
                                                
                                                    $origin = $location['OriginalTerminalID']; 
                                                    $stop = $origin;
                                                    if ($place['TID'] == $origin ){
                                                    ?>
                                                    <!-- <a href ="result.php?route=<?php echo $location['RouteID']?>&amp;origin=<?php echo $place['TID']?>&amp;des=<?php echo $location['DestinationTerminalID'] ?> "><button><?php echo $place['LN']?> to <?php echo $location['LocationName']?></button></a> -->
                                                    <button><?php echo $place['LN']?> to <?php echo $location['LocationName']?></button>
                                                    <br>
                                                    
                                                    <?php
                                                    }
                                                
                                                }
                                        echo "</div>";
                                    }
                                  
                                   
                                }while($ctr!=2 && $ctr >$stop);   
                                $ctr = 0;
                            ?> 
                    </div>
                </div>            
            </div>
        </main>   
    </body>
</html>