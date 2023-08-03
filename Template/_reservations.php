<?php
    include 'connection.php';
    $uid = $_SESSION["user_id"];
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['remove-cart-submit'])){
            $deletedrecord = $Cart->deleteCart($_POST['item_id']);
        }

        if(isset($_POST['wishlist-submit'])){
            $Cart->saveForLater($_POST['item_id']);
        }
    }
?>

<section id="cart" class="py-3">
    <div class="container-fluid width w-75">
        <h5 class="font-baloo font-size-25">Wishlist</h5>
        <!-- <h5 class="font-baloo font-size-25"><?php echo $uid; ?></h5> -->
        

<!-----------------------------------------------VEHICLES--------------------------------------------------------->
        <div class="row">
            <div class="col-sm-9">
                <?php

                    
                    
                    foreach ($product->getData('cart') as $item):
                        
                        $_SESSION["item_id"] = $item['item_id'];
                        $cart = $product->getOnProduct($item['item_id']);
                        $subTotal[] = array_map(function ($item){

                         
                ?>
                
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-4">
                        <input type="hidden" value="<?php echo $item[$user_id]?? 0;?>" name="user_id">
                        
                        <img src="<?php echo $item['item_image'] ?>" alt="cart1" class="img-fluid skeleton">
                    </div>
                    <div class="col-sm-7">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown";?></h5>
                        <p>by <?php echo $item['item_brand'] ?? "Brand";?></p>
<!-----------------------------------------------VEHICLES--------------------------------------------------------->

<!----------------------------------------------REMOVE BUTTON-------------------------------------------------------->
                        <div class="qty d-flex pt-2">
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id']?? 0;?>" name="item_id">
                                <button type="submit" name="remove-cart-submit" class="btn font-baloo text-danger ">Remove</button>
                            </form>
                        </div>
                    </div>
<!----------------------------------------------REMOVE BUTTON-------------------------------------------------------->

<!----------------------------------------------PRODUCT-------------------------------------------------------->
                <form method="post" action="insert.php">                    
                    <div class="col-sm-1 text-right">   
                        <div class="font-size-20 text-danger font-baloo">
                            ₱<span class="product_price" data-id="<?php echo $item['item_id']?? '0'; ?>"><?php echo $item['item_price'] ?? 0;?>/day</span>
                        </div>
                        <button type="submit" name="confirmreserve" class="btn btn-danger" >Reserve</button>
                    </div>
                    </form>
            </div>

                <?php  
                        return $item['item_price'];
                        }, $cart);
                        endforeach;
                ?>
            </div>
<!----------------------------------------------PRODUCT-------------------------------------------------------->

<!----------------------------------------------TOTAL AMOUNT-------------------------------------------------------->
          <!--<div class="col-sm-3 px-3">
                <div class="sub-total border text-center mt-2">
                    <div class="py-4">
                        <p class="font-baloo font-size-20">Subtotal:&nbsp;<span class="text-danger"><br>₱<span class="text-danger" id="deal-price"><?php echo isset($subTotal)? $Cart->getSum($subTotal):0?></span></span></p>
                        <a href="reservationform.php" type="submit" name="checkout-cart" class="btn btn-warning mt-3">Reserve</a>
                    </div>
                </div>
            </div>

--------------------------------------------TOTAL AMOUNT-------------------------------------------------------->
        </div>
    </div>
</section>