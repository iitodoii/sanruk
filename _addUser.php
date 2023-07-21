<?php
try {
    session_start();
    include '_con.php';
    require('_genRunNo.php');
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $reg_tel = $_POST['tel'];
    $reg_usrname = $_POST['username'];
    $reg_psw = $_POST['password'];
    $level = $_POST['level'];

    $sql = "INSERT INTO `tbl_user`(`firstname`, `lastname`, `username`, `password`,`email`, `address`, `tel`, `level`) 
    VALUES ('$name','$lastname','$reg_usrname','$reg_psw','$email','$address','$reg_tel','$level')";

    if ($conn->query($sql) === true) {
        echo "เพิ่มข้อมูลผู้ใช้งานสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด";
    }
} catch (Exception $e) {
    echo $e;
}
