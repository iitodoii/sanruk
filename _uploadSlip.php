<?php
try {
session_start();
    include '_con.php';
    require('_genRunNo.php');
    $e_id = $_POST['e_id'];

    $arr = array();
    $arr = genRunNo('SL');
    $id = $arr[0]["id"];
    $updateId = $arr[0]["updateId"];

    $path = "dist/img/slip/$id/";
    if (!file_exists($path))
        mkdir($path,0777, true);

    if (isset($_FILES['e_img'])) {
        $tmp_name =  $_FILES['e_img']['tmp_name'];
        $filename = $_FILES['e_img']['name'];
        $temp = explode(".", $filename); //Split . and add member to array
        $extention = end($temp); //get last array in this case is file extension
        $newfilename = $id . '.' . $extention;
        move_uploaded_file($tmp_name, $path . $newfilename);
    }

    $sql = "UPDATE `order_header` SET `slip_img`='$path$newfilename',`order_status`='2' WHERE `id` = '$e_id'";

    if ($conn->query($sql) === true) {
        updateRunNo('SL', $updateId);
        echo "New record created successfully";
    } else {
        echo "New record not created";
    }
} catch (Exception $e) {
    echo $e;
}
?>