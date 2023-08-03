<?php
require ('database/DBController.php');
require ('database/Product.php');
require ('database/User.php');
require ('database/Cart.php');

$db = new DBController();

$product = new Product($db);
$product_shuffle = $product->getProds();
$id_seller = null;
$product_shop = $product->getProdCount();
$Cart = new Cart($db);

?>