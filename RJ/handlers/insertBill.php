<?php
    include "Database.php";

    $nm = $_POST['person'];
    $service = $_POST['service'];
    $bill = $_POST['bill'];
    $mode = $_POST['mode'];
    $mob = $_POST['phone'];
    $serviceBy = $_POST['serviceby'];
    $items = $_POST['items'];
    
    $alldone = 0;
    if($items != "NA"){
        $getItems = explode(',', $items);
        foreach ($getItems as $itm) {
            $update = mysqli_query($conn, "SELECT `qty` FROM `inventory` WHERE `itmID`=$itm");
            $update = mysqli_fetch_array($update)[0];
            if($update - 1 <= 0){
                $update = 0;
            }else{
                $update -= 1;
            }

            $update = mysqli_query($conn, "UPDATE `inventory` SET `qty`=$update  WHERE `itmID`=$itm");
        }
    }

    if($nm == '' || $service == '' || $bill == '' || $mode == '' || $mob == '' || $serviceBy == '' ){
        echo 2;
    }else{
        // insert data in bills table
        $insert = mysqli_query($conn, "INSERT INTO `bills` VALUES (null, '$nm', '$service', '$bill', '$mode', '$mob', '$serviceBy', '$items', CURRENT_TIMESTAMP())") or die(mysqli_error($conn));       
        if($insert){
            // get latest bill id
            $getLast = mysqli_query($conn, "SELECT `billID` FROM `bills` ORDER BY `billID` DESC LIMIT 1");
            $getLast = mysqli_fetch_array($getLast)[0];     // get last entered id

            // check if entered mobile number is present
            $getMob = mysqli_query($conn, "SELECT `billID` FROM `smslog` WHERE mob='$mob' LIMIT 1");
            if(mysqli_num_rows($getMob) > 0){
                $getMob = mysqli_fetch_array($getMob);
                $getMob = $getMob[0];
                // if customer is already registered reset status
                $update = mysqli_query($conn, "UPDATE `smslog` SET `billID` = $getLast, `status`=0, `billdate`=CURRENT_TIMESTAMP() WHERE billID=$getMob") or die(mysqli_error($conn));
            }else{   
                // if new mobile insert new sms log
                $insert = mysqli_query($conn, "INSERT INTO `smslog` VALUES (null, $getLast, '$mob', 0, CURRENT_TIMESTAMP())") or die(mysqli_error($conn));
            }          
            echo 1;
        }else{
            echo 0;
        }
    }
?>