<?php
try {
session_start();
    include '_con.php';
    require('_genRunNo.php');
    $prd_name = $_POST['prd_name'];
    $prd_desc = $_POST['prd_desc'];
    $prd_price = $_POST['prd_price'];
    $prd_qty = $_POST['prd_qty'];
    $prd_unit = $_POST['prd_unit'];
    $prd_category = $_POST['prd_category'];

    $arr = array();
    $arr = genRunNo('PD');
    $id = $arr[0]["id"];
    $updateId = $arr[0]["updateId"];

    $path = "dist/img/product/$id/";
    if (!file_exists($path))
        mkdir($path,0777, true);

    if (isset($_FILES['pro_img'])) {
        $tmp_name =  $_FILES['pro_img']['tmp_name'];
        $filename = $_FILES['pro_img']['name'];
        $temp = explode(".", $filename); //Split . and add member to array
        $extention = end($temp); //get last array in this case is file extension
        $newfilename = $id . '.' . $extention;
        move_uploaded_file($tmp_name, $path . $newfilename);
    }

    $sql = "INSERT INTO `tbl_product`(`id`, `name`,`category` ,`description`, `img`, `price`, `qty`, `unit`, `date`)
    VALUES ('$id','$prd_name','$prd_category','$prd_desc','$path$newfilename','$prd_price','$prd_qty','$prd_unit',now())";

    if ($conn->query($sql) === true) {
        updateRunNo('PD', $updateId);
        echo "New record created successfully";
    } else {
        echo "New record not created";
    }
} catch (Exception $e) {
    echo $e;
}
?>