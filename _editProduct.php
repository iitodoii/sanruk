<?php
try {
    session_start();
    include '_con.php';
    require('_genRunNo.php');
    $prd_id = $_POST['e_prd_id'];
    $prd_name = $_POST['e_prd_name'];
    $prd_desc = $_POST['e_prd_desc'];
    $prd_price = $_POST['e_prd_price'];
    $prd_qty = $_POST['e_prd_qty'];
    $prd_unit = $_POST['e_prd_unit'];
    $prd_category = $_POST['e_prd_category'];

    $path = "dist/img/product/$prd_id/";
    $sql = "";
    if (!file_exists($path))
        mkdir($path, 0777, true);

    if (isset($_FILES['e_prd_img'])) {
        if ($_FILES['e_prd_img']['size'] > 0) {
            $tmp_name =  $_FILES['e_prd_img']['tmp_name'];
            $filename = $_FILES['e_prd_img']['name'];
            $temp = explode(".", $filename); //Split . and add member to array
            $extention = end($temp); //get last array in this case is file extension
            $newfilename = $prd_id . '.' . $extention;
            // $delete_file_name = $prd_id . '.' . $extention;
            $files = glob("dist/img/product/$prd_id/$filename");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            move_uploaded_file($tmp_name, $path . $newfilename);
            $sql = "UPDATE `tbl_product` SET `name`='$prd_name',`category`='$prd_category',`description`='$prd_desc',
            `img`='$path$newfilename',`price`='$prd_price',`qty`='$prd_qty',`unit`='$prd_unit',`date`=now() WHERE `id`='$prd_id'";
        } else {
            $sql = "UPDATE `tbl_product` SET `name`='$prd_name',`category`='$prd_category',`description`='$prd_desc',
            `price`='$prd_price',`qty`='$prd_qty',`unit`='$prd_unit',`date`=now() WHERE `id`='$prd_id'";
        }
    } else {
        $sql = "UPDATE `tbl_product` SET `name`='$prd_name',`category`='$prd_category',`description`='$prd_desc',
        `price`='$prd_price',`qty`='$prd_qty',`unit`='$prd_unit',`date`=now() WHERE `id`='$prd_id'";
    }


    if ($conn->query($sql) === true) {
        echo "Update record successfully";
    } else {
        echo "Record not update";
    }
} catch (Exception $e) {
    echo $e;
}
