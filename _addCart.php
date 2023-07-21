<?php
//เพิ่มข้อมูลลงในตะกร้าสินค้า
session_start();


$_SESSION["product_id"] = $_POST["product_id"]; //รับรหัสสินค้า
$_SESSION["product_name"] = $_POST["product_name"];//รับชื่อสินค้า
$_SESSION["product_qty"] = $_POST["product_qty"];//รับจำนวน
$_SESSION["product_price"] = $_POST["product_price"];
$_SESSION["product_img"] = $_POST["product_img"];

$isSameId = false;

//เพิ่มจำนวนจากสินค้าเดิม 
foreach($_SESSION['cart'] as $key=>$value){

    if($value['id']==$_SESSION["product_id"]){ //รหัสสินค้าเหมือนเดิมไหม (เหมือนในตะกร้าสินค้าที่เคยมีอยู่หรือเปล่า)
        $_SESSION['cart'][$key]['qty'] = $value['qty'] + $_SESSION['product_qty']; //สินค้าเดิม + กับจำนวนสินค้าที่เพิ่มเข้าใจ
        $isSameId = true; //มันเป็นรหัสสินค้าเดียวกัน
        break;
    }
}


//เพิ่มสินค้าใหม่
if(!$isSameId){
    $_SESSION['cart'][] = array(
        'id' => $_SESSION["product_id"],
        'name' => $_SESSION["product_name"],
        'qty' => $_SESSION["product_qty"],
        'price' => $_SESSION['product_price'],
        'img' => $_SESSION['product_img']
    );
}
?>