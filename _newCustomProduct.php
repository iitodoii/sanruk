<?php
try {
    //เพิ่มสินค้าชนิดใหม่และใส่ลงตะกร้า
    session_start();
    include '_con.php';
    require('_genRunNo.php');
    $user_id = $_SESSION['user_id'];
    $send_name = $_POST['send_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $material = $_POST['material'];
    $price = $_POST['price'];
    $remark = $_POST['remark'];
    $total = $_POST['price'];
    $pattern = $_POST['pattern'];
    $pattern_img = $_POST['pattern_img'];

    $arr = array();
    $arr = genRunNo('CT');
    $id = $arr[0]["id"];
    $updateId = $arr[0]["updateId"];

    
    $path = "dist/img/custom_product/$id/";
    if (!file_exists($path))
        mkdir($path, 0777, true);

    if (isset($_FILES['img'])) {
        $tmp_name =  $_FILES['img']['tmp_name'];
        $filename = $_FILES['img']['name'];
        $temp = explode(".", $filename); //Split . and add member to array
        $extention = end($temp); //get last array in this case is file extension
        $newfilename = $id . '.' . $extention;
        move_uploaded_file($tmp_name, $path . $newfilename);
    } else {
        echo "Error";
    }
    

    $_SESSION["product_id"] = $id; //รับรหัสสินค้า
    $_SESSION["product_name"] = $name;//รับชื่อสินค้า
    $_SESSION["product_qty"] = $qty;//รับจำนวน
    $_SESSION["product_price"] = $price;
    $_SESSION["product_img"] = $path.$newfilename;
    // $_SESSION["product_img"] = $pattern_img;
    
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

    // Confirm Order


    $sql = "INSERT INTO `tbl_product`(`id`, `name`, `category`, `description`, `img`, `price`, `qty`, `unit`, `date`) 
    VALUES ('$id','$name','4','$remark','$pattern_img','$price','$qty','ชิ้น',now())";

    $sql2 = "INSERT INTO `tbl_custom_product`(`id`, `name`, `color_id`, `size_id`, `remark`, `material_id`,`pattern_id`) 
    VALUES ('$id','$name','$color','$size','$remark','$material','$pattern')";

    if ($conn->query($sql) === true && $conn->query($sql2)) {
        updateRunNo('CT', $updateId);
        echo "New record created successfully";
    } else {
        echo "New record not created";
    }
} catch (Exception $e) {
    echo $e;
}
