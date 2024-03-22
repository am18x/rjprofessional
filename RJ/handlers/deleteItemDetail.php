<?php
    include "Database.php";

    $upID = $_GET['iID'];

    $update = mysqli_query($conn, "UPDATE `inventory` SET `visible` = 0 WHERE `itmID`=$upID");
    if($update){
        echo "1";
    }else{
        echo "0";
    }
?>