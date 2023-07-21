<?php
try {
    session_start();
    include '_con.php';
    require('_genRunNo.php');
    $name = $_POST['reg_name'];
    $lastname = $_POST['reg_lastname'];
    $address = $_POST['reg_address'];
    $email = $_POST['reg_email'];
    $reg_tel = $_POST['reg_tel'];
    $reg_usrname = $_POST['reg_usrname'];
    $reg_psw = $_POST['reg_psw'];

    $sql = "INSERT INTO `tbl_user`(`firstname`, `lastname`, `username`, `password`,`email`, `address`, `tel`, `level`) 
    VALUES ('$name','$lastname','$reg_usrname','$reg_psw','$email','$address','$reg_tel','user')";

    if ($conn->query($sql) === true) {
        echo "true";
    } else {
        echo "false";
    }
} catch (Exception $e) {
    echo $e;
}
?>