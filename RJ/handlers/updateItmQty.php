<?php
    include "Database.php";

    $id = $_GET['itmid'];
    $qty = $_GET['qty'];

    $update = mysqli_query($conn, "UPDATE `inventory` SET `qty` = $qty WHERE `itmID`=$id");
    if($update){
        echo "1";
    }else{
        echo "0";
    }
?>