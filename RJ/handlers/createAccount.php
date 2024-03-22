<?php
    include "Database.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['user'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $check = mysqli_query($conn, "SELECT * FROM `accounts` WHERE user = '$user'");
    if(mysqli_num_rows($check) > 0){
        echo '2';
    }else{
        $insert = mysqli_query($conn, "INSERT INTO `accounts` VALUES (NULL, '$fname', '$lname', '$user', '$mob', '$email', '$pass', 'u', '1')") or die(mysqli_error($conn));
        if($insert){
            echo '1';
        }else{
            echo '0';
        }
    }
?>