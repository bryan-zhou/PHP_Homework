<?php
include_once 'Cart.php';

session_start();

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = new Cart;
}

$resMsg = '';

$request = $_REQUEST;

if (isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'add') {
    $cart->addProduct($request['pid'], 1);

    $resMsg = 'success';
}

if (isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'change') {
    $cart->modifyProduct($request['pid'], $request['qty']);

    $resMsg = json_encode(['id' => (int)$request['pid'], 'qty' => (int)$request['qty']]);
}

if (isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'delete') {
    $cart->removeProduct($request['pid']);

    $resMsg = json_encode(['id' => (int)$request['pid']]);
}

$_SESSION['cart'] = $cart;

echo $resMsg;
