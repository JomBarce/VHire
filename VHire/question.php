<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='passenger'){
                header('Location:./index.php');
            } else if ($_SESSION['user']['role']=='admin'){
                header('Location:./admin_index.php');
            }else if ($_SESSION['user']['role']=='driver'){
                header('Location:./driver_index.php');
            }
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
                <h1>Choose your role:</h1>
            </div>
            <div class="divider">
                <div class="center">
                    <div class="center_img">
                        <?php $role ="customer"?>
                        <a href="signup.php?data=<?php echo $role;?>"><img class="optionlogo" src="./images/icons/passenger.png" alt="logo"></a>
                    </div>
                </div>
                <div class="center">
                    <div class="center_img">
                        <?php $role ="driver"?>
                        <a href="signup.php?data=<?php echo $role;?>"><img class="optionlogo" src="./images/icons/driver.png" alt="logo"></a>
                    </div>
                </div>        
            </div>
        </main>   
    </body>
</html>