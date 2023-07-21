<?php
try {
    session_start();
    include '_con.php';
    $id = $_POST['e_id'];
    $name = $_POST['e_name'];
    $lastname = $_POST['e_lastname'];
    $address = $_POST['e_address'];
    $email = $_POST['e_email'];
    $tel = $_POST['e_tel'];
    $username = $_POST['e_username'];
    $password = $_POST['e_password'];
    $level = $_POST['e_level'];

    $sql = "UPDATE `tbl_user` SET `firstname`='$name',`lastname`='$lastname',`username`='$username',`password`='$password',
    `email`='$email',`address`='$address',`tel`='$tel',`level`='$level' WHERE `id` = '$id'";


    if ($conn->query($sql) === true) {
        echo "แก้ไขข้อมูลเสร็จสิ้น";
    } else {
        echo "แก้ไขข้อมูลไม่สำเร็จ";
    }
} catch (Exception $e) {
    echo $e;
}
