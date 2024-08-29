<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='driver'){
                header('Location:./driver_index.php');
            }else if ($_SESSION['user']['role']=='passenger'){
                header('Location:./index.php');
            }else if ($_SESSION['user']['AdminType']=='Admin'){
                header('Location:./admin_index.php');
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
                    <a href="super_admin.php"><img id="logo" src="./images/icons/logo.png" alt="logo"></a>
                </div>
            </div>
        </header>
        <main>
            <div class="divider">
                <div id="left">
                    <?php include_once './php/super_menu.php'; ?>
                </div>
                <div id="right">
                    <div class="center5">
                        <div class="title3">
                            <h1>Add Vehicle:</h1>
                        </div>
                        <form id="vehicleform" method="GET" onsubmit="addVehicle(event)">
                            <label for="plate">Plate Number</label>
                            <input type="text" name="plate" autocomplete="off" required>
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" autocomplete="off" required>
                            <label for="model">Car Model</label>
                            <input type="text" name="model" autocomplete="off" required>
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" autocomplete="off" required>
                            <label for="weight">Weight (kg)</label>
                            <input type="number" name="weight" autocomplete="off" required>
                            <label for="status">Status</label>
                            <input type="text" name="status" autocomplete="off" required>
                            <button value="signup" name="signup">ADD VEHICLE</button>
                        </form>
                    </div> 
                </div>
            </div>
        </main>   
    </body>
</html>