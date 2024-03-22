<?php
    include "Database.php";

    $itnm = $_POST['itnm'];
    $itcost = $_POST['itcost'];
    $itcat = $_POST['itcat'];
    $itqty = $_POST['itqty'];
    
    if($itnm == '' || $itcost == '' || $itcat == '' || $itqty == ''){
        echo 2;
    }else{
        $insert = mysqli_query($conn, "INSERT INTO `inventory` VALUES (null, '$itnm', '$itcost', '$itcat', '$itqty', now(), 1)") or die(mysqli_error($conn));
        if($insert){
            echo 1;
        }else{
            echo 0;
        }
    }
?>