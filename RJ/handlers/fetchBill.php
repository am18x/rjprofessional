<?php
    include("Database.php");

    $workerID = $_GET['worker'];
    $bdate = $_GET['billdate'];
    $findData = date('Y-m-d',strtotime($bdate));

    $workerssql = mysqli_query($conn,"SELECT uID, fname, lname FROM `accounts`");
    $accounts = array();
    while($row = mysqli_fetch_array($workerssql)){
        $accounts[$row['uID']] = $row['fname']." ".$row['lname']; 
    }
    if($bdate == ''){
        if($workerID == 'NA'){
            $sql = "SELECT * FROM `bills`";

            echo "
                <thead class='header'>
                    <th><b>Bill ID</b></th>
                    <th><b>Customer</b></th>
                    <th><b>Service</b></th>
                    <th><b>Payment Mode</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Payment</b></th>
                    <th><b>Items</b></th>
                    <th><b>Product Total</b></th>
                    <th><b>Service By</b></th>
                    <th><b>Payment Date</b></th>
                </thead>
            ";
        }else {
            $sql = "SELECT * FROM `bills` WHERE `serviceby` = '$workerID'";

            echo "
                <thead class='header'>
                    <th><b>Bill ID</b></th=>
                    <th><b>Customer</b></th>
                    <th><b>Service</b></th>
                    <th><b>Payment Mode</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Payment</b></th>
                    <th><b>Items</b></th>
                    <th><b>Product Total</b></th>
                    <th><b>Payment Date</b></th>
                </thead>
            ";
        }
    }else{
        if($workerID == 'NA'){
            $sql = "SELECT * FROM `bills` WHERE DATE(billdate) = '$findData'";
    
            echo "
                <thead class='header'>
                    <th><b>Bill ID</b></th>
                    <th><b>Customer</b></th>
                    <th><b>Service</b></th>
                    <th><b>Payment Mode</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Payment</b></th>
                    <th><b>Items</b></th>
                    <th><b>Product Total</b></th>
                    <th><b>Service By</b></th>
                </thead>
            ";
        }else{
            $sql = "SELECT * FROM `bills` WHERE DATE(billdate) = '$findData' AND `serviceby` = '$workerID'";

            echo "
                <thead class='header'>
                    <th><b>Bill ID</b></th>
                    <th><b>Customer</b></th>
                    <th><b>Service</b></th>
                    <th><b>Payment Mode</b></th>
                    <th><b>Mobile</b></th>
                    <th><b>Payment</b></th>
                    <th><b>Items</b></th>
                    <th><b>Product Total</b></th>
                </thead>
            ";
        }
    }

    $data = mysqli_query($conn, $sql);
    $total = 0;
    $onlineBill = 0;
    $cashBill = 0;
    $prodBill = 0;
    if(mysqli_num_rows($data) > 0){
        while($row = mysqli_fetch_array($data)){
            if($row['mode'] == "Online"){
                $onlineBill += $row['billPaid'];
            }else if($row['mode'] == "Cash"){
                $cashBill += $row['billPaid'];
            }
            
            echo "
                <tr>
                    <td>".$row['billID']."</td>
                    <td>".$row['person']."</td>
                    <td>".$row['service']."</td>
                    <td>".$row['mode']."</td>
                    <td>".$row['mob']."</td>
                    <td>₹ ".$row['billPaid']."</td>";
                    if($row['items'] != "NA"){
                        $totProd = 0;
                        echo "<td>";
                        $itmNames = array();
                        $getItems = explode(',', $row['items']);
                        foreach ($getItems as $itm) {
                            $getname = mysqli_query($conn, "SELECT `itmName`,`itmCost`  FROM `inventory` WHERE `itmID`=$itm");
                            $getname = mysqli_fetch_array($getname);
                            array_push($itmNames, $getname[0]);
                            $totProd += $getname[1];
                        }
                        $prodBill += $totProd;
                        echo implode('<br>', $itmNames);
                        echo "</td>";
                        echo "<td>$totProd</td>";
                    }else{
                        echo "<td>NA</td>";
                        echo "<td>0</td>";
                    }

                    if($bdate == ''){
                        if($workerID == 'NA'){
                            if (array_key_exists($row['serviceby'], $accounts)) {
                                echo "<td>".$accounts[$row['serviceby']]."</td>";
                            }else{
                                echo "<td>NA</td>";
                            }
                            echo "<td>".date('Y-m-d',strtotime($row['billdate']))."</td>";
                        }else{
                            echo "<td>".date('Y-m-d',strtotime($row['billdate']))."</td>";
                        }
                    }else{
                        if($workerID == 'NA'){
                            if (array_key_exists($row['serviceby'], $accounts)) {
                                echo "<td>".$accounts[$row['serviceby']]."</td>";
                            }
                        }
                    }
                echo "</tr>
            ";
        }
    }else{
        if($bdate == ''){
            if($workerID == 'NA'){
                echo "<tr><td colspan='10'>No bills found</td></tr>";
            }else{
                echo "<tr><td colspan='9'>No bills found</td></tr>";
            }
        }else{
            if($workerID == 'NA'){
                echo "<tr><td colspan='9'>No bills found</td></tr>";
            }else{
                echo "<tr><td colspan='8'>No bills found</td></tr>";
            }
        }
    }
    $total = $onlineBill + $cashBill + $prodBill;
    
    $total = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total);
    $onlineBill = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $onlineBill);
    $cashBill = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $cashBill);
    $prodBill = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $prodBill);

    echo "|₹ $total.00| ₹ $onlineBill.00|₹ $cashBill.00|₹ $prodBill.00";
?>