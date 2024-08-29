<!DOCTYPE html>
<html lang="en">
    <?php
        include_once './php/connection.php';

        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role']=='admin'){
                header('Location:./admin_index.php');
            }else if ($_SESSION['user']['role']=='passenger'){
                header('Location:./index.php');
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
                        $conn->close();
                        $dateformat = date("m/d/Y", strtotime($row["DateOfBirth"])); 
                    ?>

                    <div class="center4">
                        <div class="user_profile">
                            <img id="p_picture" src="<?php echo $imageURL; ?>" />
                            <div >
                                <h1><?php echo $fullname; ?></h1>
                                <h2>User Number: <?php echo $row['DriverID']; ?></h2>
                            </div>
                        </div>
                        <div>
                            <div class="form_div">
                                <h1 class="profile_text">PROFILE</h1>
                                <button id="edit_btn" onclick="profileUpdate()">Edit</button>
                            </div>
                            <form id="profileform" method="GET" enctype="multipart/form-data" onsubmit="profileSubmit(event)">
                                <div class="form_div2">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="input3" name="first_name" id="first_name" value="<?php echo $row['FirstName']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label for="middle_name">Middle Name:</label>
                                    <input type="text" class="input3" name="middle_name" id="middle_name" value="<?php echo $row['MiddleName']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label  for="last_name">Last Name:</label>
                                    <input type="text" class="input3" name="last_name" id="last_name" value="<?php echo $row['LastName']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label  for="license">License Number:</label>
                                    <input type="text" class="input3" name="license" id="license" value="<?php echo $row['LicenseNumber']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label  for="username">Username:</label>
                                    <input type="text" class="input3" name="username" id="username" value="<?php echo $row['Username']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label  for="user_email">Email:</label>
                                    <input type="email" class="input3" name="user_email" id="user_email" value="<?php echo $row['Email']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label  for="contact_number">Contact Number:</label>
                                    <input type="text" class="input3" name="contact_number" id="contact_number" value="<?php echo $row['ContactNumber']; ?>" required readonly/>
                                </div>
                                <div class="form_div2">
                                    <label for="user_bday">Birthday:</label>
                                    <input type="date" class="input3" name="user_bday" id="user_bday" value="<?php echo($row["DateOfBirth"]); ?>" required readonly/>
                                </div>
                                <button id="profileform_btn" type="submit" value="submit" name="submit">Submit</button>
                            </form>
                            <form id="imageform" method="POST" enctype="multipart/form-data" action="./php/image_update.php">
                                <h2>Update Profile Picture</h2>
                                <label id="fileins" for="fileinput"><img id="icon_input" src="./images/icons/input.png" alt="input"><br/>Choose an Image</label>
                                <input id="fileinput" type="file" name="file" onchange="filetext()">
                                <button type="submit" value="submit" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>                    
                </div>   
            </div>     
        </main>   
    </body>
</html>