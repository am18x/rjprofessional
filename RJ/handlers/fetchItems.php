<?php
    include "Database.php";

    $data = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `visible` = 1");
    if(mysqli_num_rows($data) > 0){
        $sr = 1;
        while($row = mysqli_fetch_array($data)){
            $iID = $row['itmID'];
            echo "
                <tr>
                    <td>$sr</td>
                    <td>".$row['itmName']."</td>
                    <td>₹ ".$row['itmCost']."</td>
                    <td>".$row['category']."</td>
                    <td>
                        <div class='qtyGrp'>
                            <button onclick='itemUpdateQty($iID, 0)'><i class='fas fa-minus'></i></button>
                            <b id='qty$iID'>".$row['qty']."</b>
                            <button onclick='itemUpdateQty($iID, 1)'><i class='fas fa-plus'></i></button>
                        </div>
                    </td>
                    <td>
                        <div class='qtyGrp'>
                            <button onclick='itemEdit($iID)'><i class='fas fa-edit'></i></button>
                            <button onclick='itemDelete($iID)'><i class='fas fa-trash'></i></button>
                        </div>
                    </td>
                </tr>
            ";

            $sr++;
        }
    }else{
        echo 0;
    }
?>