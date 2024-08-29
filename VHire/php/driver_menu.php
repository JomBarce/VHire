<!DOCTYPE html>
<html lang="en">
    <?php
        $select = "SELECT * FROM Driver WHERE DriverID =".$_SESSION['user']['DriverID'].""; 
        $query= mysqli_query($conn, $select);
        if(mysqli_num_rows($query) > 0){
            while( $row = mysqli_fetch_assoc($query) ){
                if($row['ProfilePicture'] == NULL){
                    $imageURL = './images/users/icon.png';
                }else{
                    $imageURL =  $row['ProfilePicture'];	
                }
                $name = $row['FirstName'];
            }
        }
    ?>
    <img class="menu_picture" src="<?php echo $imageURL; ?>" />
    <h1><?php echo $name; ?></h1>
    <ul>
        <li><a href="driver_index.php">Trips</a></li>
        <li><a href="driver_profile.php">Profile</a></li>
        <li><a onclick="signoutClick(event)">Logout</a></li>
    </ul>
</html>