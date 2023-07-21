<?php
session_start();
include '_con.php';

$id = $_POST['prd_id'];

$sql = "DELETE FROM tbl_product WHERE id = '$id'";

if ($conn->query($sql) === true) {
    echo "Delete successfully";
} else {
    echo "Delete failed";
}
?>
