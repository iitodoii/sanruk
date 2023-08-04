<?php
// $conn = new mysqli("127.0.0.1:3308", "admin", "admin999", "dietary");
// $conn = new mysqli("184.168.96.211", "root_999", "sheepcow", "monkshop");
$conn = new mysqli("127.0.0.1:3308", "root", "", "sanruk");
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    echo "Connection failed";
} else {
    echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
}
?>


<!-- <?php include 'footer.php';?> -->