<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['remove-wishlist-submit'])){
            $deletedrecord = $Cart->deleteWishlist($_POST['item_id']);
        }

        if(isset($_POST['cart-submit'])){
            $Cart->saveForLater($_POST['item_id'], saveTable:'cart',fromTable:'wishlist');
        }
    }
?>

<section id="cart" class="py-3">
    <div class="container-fluid width w-75">
        <h5 class="font-baloo font-size-25">Favorites</h5>

<!-----------------------------------------------VEHICLES--------------------------------------------------------->
        <div class="row">
            <div class="col-sm-9">
                <?php
                    foreach ($product->getData('wishlist') as $item):
                        $cart = $product->getProduct($item['item_id']);
                        $subTotal[] = array_map(function ($item){
                ?>
                <?php array_map(function ($item) use($in_cart){?>
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-3">
                        <img src="<?php echo $item['item_image'] ?>" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-7">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown";?></h5>
                        <p>by <?php echo $item['item_brand'] ?? "Brand";?></p>
<!-----------------------------------------------VEHICLES--------------------------------------------------------->
                       
<!----------------------------------------------REMOVE BUTTON-------------------------------------------------------->
                        <div class="qty d-flex pt-2">
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id']?? 0;?>" name="item_id">
                                <button type="submit" name="remove-wishlist-submit" class="btn font-baloo text-danger border-right">Remove</button>
                            </form>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id']?? 0;?>" name="item_id">
                                <button type="submit" name="cart-submit" class="btn font-baloo text-danger">Add to Reservation<i class="fa fa-book fa-fw px-2"></i></button>
                                
                            </form>
                        </div>
                    </div>
<!----------------------------------------------REMOVE BUTTON-------------------------------------------------------->

<!----------------------------------------------PRODUCT-------------------------------------------------------->
                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            ₱<span class="product_price" data-id="<?php echo $item['item_id']?? '0'; ?>"><?php echo $item['item_price'] ?? 0;?>/day</span>
                        </div>
                    </div>
                </div>

                <?},$product->getProds());
                    return $item['item_price'];
                    },$cart); 
                    endforeach;
                ?>
            </div>
<!----------------------------------------------PRODUCT-------------------------------------------------------->
        </div>
    </div>
</section>

