<?php
session_start();
include '_con.php'; //1.
//รับค่ารายละเอียดการจัดส่งสินค้าของออเดอร์
$user_id = $_SESSION['user_id'];
$name = $_POST["name"];
$address = $_POST["address"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$total = $_POST["total"];

$sql = "INSERT INTO `order_header`(`user_id`, `order_name`, `order_address`, `order_email`, 
`order_tel`, `order_total`, `order_status`, `track_number`) 
VALUES ('$user_id','$name','$address','$email',
'$tel','$total','1','')"; //2. คำสั่ง SQL เพื่อเพิ่มข้อมูลรายละเอียดการจัดส่งไปยังฐานข้อมูล

if ($conn->query($sql) === true) { //3.รันคำสั่ง sql
    echo "New record created successfully";
} else {
    echo "New record not created";
}

$max = 0;
$sql2 = "SELECT max(id) as max FROM `order_header`";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $max = $row['max']; //การหารหัสออเดอร์ล่าสุดและเพิ่มสินค้าที่เหลือไปยัง ออเดอร์เดิม
    }
}

//เพิ่มข้อมูลจากตะกร้าสินค้าลงฐานข้อมูล
foreach ($_SESSION['cart'] as $key => $value) {//วนซ้ำข้้อมูลในตะกร้าสินค้าไปลงยังฐานข้อมูล
    //สินค้าแต่ละชิ้นอต้องเข้าไปยังออเดอร์ล่าสุด
    $sql3 = "INSERT INTO `order_detail`(`order_id`, `product_id`, `product_qty`, `detail_total`) 
    VALUES ('$max','".$value["id"]."','".$value["qty"]."','".$value["qty"]*$value["price"]."')";


    if($conn->query($sql3)===true){ //รันคำสั่ง SQL
        unset($_SESSION['cart']);
    }else{
        echo "New record not created";
    }
}

?>