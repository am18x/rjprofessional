<?php
    // 0 = No account found
    // 1 = Query error
    // 2 = admin
    // 3 = user 
    // 4 = No permission

    include "Database.php";

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $check = mysqli_query($conn, "SELECT * FROM `accounts` WHERE pass='$pass' AND user='$user' or email='$user' AND pass='$pass'") or die(mysqli_error($conn));
    if($check){
        if(mysqli_num_rows($check) > 0){
            $data = mysqli_fetch_array($check);
            if($data['type'] == 'u'){
                if($data['status'] == 1){
                    echo "3-".$data['fname']." ".$data['lname']."-".$data['uID'];
                }if($data['status'] == 0) {
                    echo "4-P-0";
                }
            }elseif($data['type'] == 'a'){
                echo "2-".$data['fname']." ".$data['lname']."-".$data['uID'];
            } 
        }else{
            echo "0-N-0";
        }
    }else{
        echo "1-Q-0";
    }
?>