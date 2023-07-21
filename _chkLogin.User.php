<?php
    include '_con.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    // if(isset($_POST["isUser"])){
    //     $isUser = $_POST["isUser"];
    // }
    // รับตัวแปรมาจากหน้า index 

    session_start();

    $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
    //ถ้า User และ Pass ตรงกับฐานข้อมูลจะ Login สำเร็จ
    $result = $conn->query($sql); //รันคำสั่ง SQL

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { //เป็นการ Loop ข้อมูลจากฐานข้อมูล
            //ตัวแปร Global ข้อมูลของผู้ใช้งานระบบ
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["level"] = $row["level"];
        }


        //เช็คว่าเป็น User หรือ Admin
        if($_SESSION["level"] == "user"){
            echo 'user'; //ไปยังหน้าแอดมิน
        }else if($_SESSION["level"] == "admin"){ 
            echo 'admin'; //ไปยังหน้าแอดมิน
        }
        
        // header("Location:index.html");
    }else{
        echo 'false';
    }
    $conn->close();
