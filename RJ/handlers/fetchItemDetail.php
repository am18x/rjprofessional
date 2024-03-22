<?php
    include "Database.php";
    $id = $_GET['iID'];
    $data = mysqli_query($conn, "SELECT * FROM `inventory` WHERE itmID = $id");
    if(mysqli_num_rows($data) > 0){
        $row = mysqli_fetch_array($data);
        echo $row['itmID']."|".$row['itmName']."|".$row['category']."|".$row['itmCost']."|".$row['qty'];
    }
?>