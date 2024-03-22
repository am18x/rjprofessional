<?php
    include "Database.php";

    $upID = $_POST['upID'];
    $upitmName = $_POST['upitmName'];
    $upcat = $_POST['upcat'];
    $upprice = $_POST['upprice'];
    $upqty = $_POST['upqty'];

    $update = mysqli_query($conn, "UPDATE `inventory` SET `itmName` = '$upitmName', `itmCost` = '$upprice', `category` = '$upcat', `qty` = '$upqty' WHERE `itmID`=$upID");
    if($update){
        echo "1";
    }else{
        echo "0";
    }
?>