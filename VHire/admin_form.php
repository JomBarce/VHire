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
                            <h1>Create Admin:</h1>
                        </div>
                        <form id="adminform" method="GET" onsubmit="addAdmin(event)">
                            <table class="table_left">
                                <tr>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                </tr>
                            </table>
                            <div class="form_div">
                                <input type="text" class="input2" name="f_name" autocomplete="off" required>
                                <input type="text" class="input2" name="m_name" autocomplete="off" required>
                                <input type="text" name="l_name" autocomplete="off" required>
                            </div>
                            <table class="table_left">
                                <tr>
                                    <td class="left_td2">Username</td>
                                    <td class="left_td2">Date of Birth</td>
                                </tr>
                            </table>
                            <div class="form_div">
                                <input type="text" class="input2" name="user_name" autocomplete="off" required>
                                <input type="date" name="bday" autocomplete="off" required>
                            </div>
                            <label for="email">Email Address</label>
                            <input type="text" name="email" autocomplete="off" required>
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" autocomplete="off" required>
                            <label for="password">Password</label>
                            <input type="password" name="password" autocomplete="off" required>
                            <label for="confirm_pword">Confirm Password</label>
                            <input type="password" name="confirm_pword" autocomplete="off" required>
                            <button value="signup" name="signup">ADD</button>
                        </form>
                    </div> 
                </div>
            </div>
        </main>   
    </body>
</html>