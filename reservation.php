<?php
    ob_start();
    
    include ('header.php');
?>

<!------------------------------------------------------------------------------------------------------------>

<?php
    $_SESSION['user_id'];
    count($product->getData('cart')) ? include ('Template/_reservations.php') : include ('Template/notFound/_no-reservations.php');

?>

<!------------------------------------------------------------------------------------------------------------>

<?php
    include ('footer.php');
?>
