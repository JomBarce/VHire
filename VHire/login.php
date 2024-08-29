<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='admin'){
                header('Location:./admin_index.php');
            }else if ($_SESSION['user']['role']=='driver'){
                header('Location:./driver_index.php');
            }else{
                header('Location:./index.php');
            }
        }

        include_once './php/head.php';
    ?>
    <body>
        <main>
            <div class="divider">
                <div class="center2">
                    <div class="center_img">
                        <img id="loginlogo" src="./images/icons/logo2.png" alt="logo">
                    </div>
                    <!-- The form will call login_action.php which will check if the user is already registered -->
                    <form id="loginform" method="GET" onsubmit="loginSubmit(event)">
                        <input type="text" name="user_name" placeholder="Username" autocomplete="off" required>
                        <input type="password" name="pword" placeholder="Password" autocomplete="off" required>
                        <div class="form_div3 radio-label">
                                <div class="radio_div">
                                    <label >Login as:</label>
                                </div>
                                <div class="select_div">
                                    <input type="radio"  value="passenger"  name="role" checked >
                                    <label for="driver">Passenger</label>
                                </div>
                                <div class="select_div">
                                    <input type="radio"  value="driver"  class="radio" name="role" >
                                    <label for="driver">Driver</label>
                                </div>
                                <div class="select_div">
                                    <input type="radio"  value="admin" name="role" >
                                    <label for="driver">Admin</label>
                                </div>
                        </div>
                        <button value="login" name="login">LOGIN</button>
                    </form>
                    <div class="divider">
                        <a class="link" href="question.php">Don't have an account? Sign up</a>
                    </div>
                </div>       
            </div>
        </main>   
    </body>
</html>