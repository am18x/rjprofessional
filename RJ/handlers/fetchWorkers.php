<?php
    include "Database.php";

    $data = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `type`='u' AND `status` != 2");
    if(mysqli_num_rows($data) > 0){
        $sr = 1;
        while($row = mysqli_fetch_array($data)){
            echo "<tr>";
            echo "<td>$sr</td>";
            echo "<td><span>".$row['fname']." ".$row['lname']."</span></td>";
            echo "<td><span>".$row['mob']."</span></td>";

            if($_GET['remove'] == 1){
                echo "<td><span>".$row['user']."</span></td>";
                echo "<td><span>".$row['pass']."</span></td>";
                // remove button
                echo "<td><button class='dangerBtn' onclick='removeWorker(".$row['uID'].")'><span class='reshide'>Remove</span> <i class=\"fas fa-user-times\"></i></button></td></tr>";
            }else{
                // status button
                echo "<td>
                        <label class=\"switch\">";
                if($row['status'] == 1){
                    echo "<input type=\"checkbox\" checked onclick='changePermission(".$row['uID'].", this, 0)'>";
                }else{
                    echo "<input type=\"checkbox\" onclick='changePermission(".$row['uID'].", this, 1)'>";
                }
                echo "<span class=\"slider\"></span>
                        </label>
                    </td>
                </tr>
                ";
            }
            $sr++;
        }
    }
?>