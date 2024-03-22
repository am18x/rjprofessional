<?php
    include "Database.php";

    $log = $_GET['currentLogged'];

    $data = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `visible` = 1");
    if(mysqli_num_rows($data) > 0){
        while($row = mysqli_fetch_array($data)){
            $id = $row['itmID'];
            echo "<option value='$id'>".$row['itmName']."</option>";
        }
    }
?>