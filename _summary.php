<?php 
session_start();

// print_r($_SESSION['cart']);
// echo $_SESSION["product_id"];
// $newArray = array(
//     'id' => $_SESSION["product_id"],
//     'name' => $_SESSION["product_name"],
//     'qty' => $_SESSION["product_qty"],
//     'price' => $_SESSION['product_price']
// );

// foreach($_SESSION['cart'] as $cart){

//     if($_SESSION["product_id"] == $cart['id']){
//         print_r($cart['id']);
//     }

    
// }

$arrayA[] = array(
    'id' => 1,
    'name' => "first",
    'qty' => 10,
    'price' => 10
);
$arrayA[] = array(
    'id' => 2,
    'name' => "second",
    'qty' => 20,
    'price' => 20
);
$arrayA[] = array(
    'id' => 3,
    'name' => "third",
    'qty' => 30,
    'price' => 30
);
print_r($_SESSION['cart']);
echo "<br>";
foreach($_SESSION['cart'] as $key=>$value){
    if($value['id']=="2"){
        unset($_SESSION['cart'][$key]);
    }
}
print_r($_SESSION['cart']);
// print_r($_SESSION['cart']);
// print_r($_SESSION['cart']);

// print_r($arrayA);
// $last_names = array_column($a, 'last_name');
// print_r(array_column($newArray[1], 'id'));
?>
