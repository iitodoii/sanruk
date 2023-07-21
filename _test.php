<?php
include '_con.php';
$order_id = 3;
$sql2 = "SELECT * FROM order_detail where order_id = '$order_id'";
$result2 = $conn->query($sql2);
$arrayA = array();
$arrayB = array();

//Update ตาราง Product ด้วย Product ที่เหมือนกันกับใน order
//Loop นอกด้วย Product Loop ในด้วย order_product 
//อัพเดทตอน if a.product = b.product get b.product - b.product
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
    foreach($arrayB as $keyB => $valueB){
        if($valueA["id"] == $valueB["product_id"]){
            // echo $valueA["id"]."xxx".$valueB["product_id"];
            $newValue = $valueA["qty"]-$valueB["product_qty"] ;
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
// print_r($arrayA[0]['id']);
?>
