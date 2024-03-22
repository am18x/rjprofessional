<?php
    include "Database.php";
    $month = $_GET['mon'];

    $todayDate = date('Y-m-d', time());
    if($month == 0){
        $data = mysqli_query($conn, "SELECT b.person, b.mob, DATE(s.billdate) AS billdate , s.status, DATEDIFF('$todayDate', s.billdate) AS days FROM bills b INNER JOIN smslog s ON b.billID = s.billID ORDER BY days");
    }else{
        // month first date to month last date
        $data = mysqli_query($conn, "SELECT b.person, b.mob, DATE(s.billdate) AS billdate , s.status, DATEDIFF('$todayDate', s.billdate) AS days FROM bills b INNER JOIN smslog s ON b.billID = s.billID WHERE month(s.billdate)=$month ORDER BY days");
    }
    if(mysqli_num_rows($data) > 0){
        $sr = 1;
        while($row = mysqli_fetch_array($data)){
            echo "<tr>";
            echo "<td>$sr</td>";
            echo "<td>".$row['person']."</td>";
            echo "<td>".$row['mob']."</td>";
            echo "<td>".$row['billdate']."</td>";
            echo "<td>".$row['days']."</td>";
            if($row['status'] == 1){
                echo "<td>Sent</td>";
            }else{
                echo "<td>Not Sent</td>";
            }
            if($row['days'] > 15){
                if($row['status'] == 1){
                    echo "<td><button class='smsSent btnTable' disabled>SMS Sent</button></td>";
                }else{
                    echo "<td><button class='smsSend btnTable'>Send <i class='fas fa-comment'></i></button></td>";
                }
            }else{
                echo "<td><button class='smsDisSend btnTable' disabled> Days <i class='fas fa-calendar-times'></i></button></td>";
            }
            echo "</tr>";
            $sr++;
        }
    }else{
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
?>

