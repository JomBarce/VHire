<?php
    include_once 'connection.php';

    $retVal = "Please insert an image.";
    $isValid = true;

    if(isset($_SESSION['user'])){
        if ($_SESSION['user']['role']=='passenger'){
            $userid = $_SESSION['user']['CustomerID'];
            $targetDir = "../images/users/";
            $location = "../profile.php";
        }else if ($_SESSION['user']['role']=='driver'){
            $userid = $_SESSION['user']['DriverID'];
            $targetDir = "../images/drivers/";
            $location = "../driver_profile.php";
        }
    }

    // File upload path
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

    // Check if file is duplicate
    $i = 1;
    $actual_name = pathinfo($targetFilePath,PATHINFO_FILENAME);
    $original_name = $actual_name;
    while( file_exists($targetFilePath) ){
        $actual_name = (string)$original_name.$i;
        $fileName = $actual_name.".".$fileType;
        $targetFilePath = $targetDir . $fileName;
        $i++;
    }

    if(!empty($_FILES['file']['name']) && $isValid){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                if($_SESSION['user']['role'] == 'driver'){
                    $targetDir = "./images/drivers/";
                    $targetFilePath = $targetDir . $fileName;
                    $updateSQL = "UPDATE Driver SET ProfilePicture='$targetFilePath' WHERE DriverID='$userid'";
                }else if($_SESSION['user']['role'] == 'passenger'){
                    $targetDir = "./images/users/";
                    $targetFilePath = $targetDir . $fileName;
                    $updateSQL = "UPDATE Customer SET ProfilePicture='$targetFilePath' WHERE CustomerID='$userid'";
                }
                if(mysqli_query($conn, $updateSQL)){
                    $retVal = "Profile picture updated.";
                }else{
                    $retVal = "ERROR: please try again.";
                }
            }else{
                $retVal = "Sorry, there was an error uploading your image.";
            }
        }else{
            $retVal = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    }
    
    echo '<script type="text/javascript">
            alert("'.$retVal.'");
            window.location="'.$location.'";
        </script>';
    $conn->close();
?>