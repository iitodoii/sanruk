<?php
session_start();
include '_con.php';

$id = $_POST['id'];

$sql = "DELETE FROM tbl_user WHERE id = '$id'";

if ($conn->query($sql) === true) {
    echo "Delete successfully";
} else {
    echo "Delete failed";
}
?>
