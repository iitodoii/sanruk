<?php

$order_id = $_POST['order_id'];

include '_con.php';
$sql = "UPDATE `order_header` SET `order_status`='4' WHERE id ='$order_id'";
if ($conn->query($sql) === true) {
    $sql2 = "SELECT * FROM order_detail where order_id = '$order_id'";
    $result2 = $conn->query($sql2);
    $arrayA = array();
    $arrayB = array();

    if ($result2->num_rows > 0) {
        while ($row_b = $result2->fetch_assoc()) {
            $arrayB[] = $row_b;
        }
    }
    // print_r($arrayB);
    $sql3 = "SELECT * FROM tbl_product";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        while ($row_a = $result3->fetch_assoc()) {
            $arrayA[] = $row_a;
        }
    }
    foreach ($arrayA as $keyA => $valueA) {
        foreach ($arrayB as $keyB => $valueB) {
            if ($valueA["id"] == $valueB["product_id"]) {
                // echo $valueA["id"]."xxx".$valueB["product_id"];
                $newValue = $valueA["qty"] - $valueB["product_qty"];
                $id = $valueA["id"];
                // echo "<br>";
                $sql4 = "UPDATE `tbl_product` SET `qty`='$newValue' WHERE id='$id'";
                if ($conn->query($sql4) === true) {
                    echo "New record created successfully";
                } else {
                    echo "New record not created";
                }
            }
        }
    }
} else {
    echo "New record not created";
}
