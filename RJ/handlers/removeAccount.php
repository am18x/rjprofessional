<?php
    include "Database.php";

    $id = $_GET['uid'];

    $delete = mysqli_query($conn, "UPDATE `accounts` SET `status` = 2 WHERE `uID`=$id");
    if($delete){
        echo "1";
    }else{
        echo "0";
    }
?>