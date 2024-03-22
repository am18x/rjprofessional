<?php
    include "Database.php";

    $log = $_GET['currentLogged'];

    $data = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `status` != 2");
    if(mysqli_num_rows($data) > 0){
        while($row = mysqli_fetch_array($data)){
            $id = $row['uID'];
            if($id == $log && $log > 1){
                echo "<option value='$id' selected>".$row['fname']." ".$row['lname']."</option>";
            }else{
                echo "<option value='$id'>".$row['fname']." ".$row['lname']."</option>";
            }
        }
    }
?>