<?php
    include "Database.php";

    $id = $_GET['uid'];
    $status = $_GET['status'];

    $update = mysqli_query($conn, "UPDATE `accounts` SET `status` = $status WHERE `uID`=$id");
    if($update){
        echo "1";
    }else{
        echo "0";
    }
?>