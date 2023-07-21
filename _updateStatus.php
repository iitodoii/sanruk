<?php

$order_id = $_POST['order_id'];
$tracking = $_POST['tracking'];

include '_con.php';
$sql = "UPDATE `order_header` SET `order_status`='3',`track_number`='$tracking' WHERE id ='$order_id'";
if ($conn->query($sql) === true) {
    echo "New record created successfully";
} else {
    echo "New record not created";
}



?>