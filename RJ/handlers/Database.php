<?php
    $conn = mysqli_connect('localhost', 'root', '', 'rjsalondb');
    // $conn = mysqli_connect('127.0.0.1:3306', 'u475379977_rjprof', 'RjProf@1', 'u475379977_rjsalondb');
    if(!$conn){
        echo "Database not connected";
    }
?>