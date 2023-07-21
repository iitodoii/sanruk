<?php
session_start();

$product_id = $_POST["product_id"];//รหัสของสินค้าที่รับมาจากหน้า Summary เพื่อลบออกจากตะกร้าสินค้า

foreach($_SESSION['cart'] as $key=>$value){
    if($value['id']== $product_id){
        unset($_SESSION['cart'][$key]);//ลบสินค้าออกจากตะกร้า
    }
}

?>