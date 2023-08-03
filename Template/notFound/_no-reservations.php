<!-----------------------------------------------RESERVATION--------------------------------------------------------->
<section id="cart" class="py-3">
    <div class="container-fluid width w-75">
        <h5 class="font-baloo font-size-25">Wishlist</h5>
        <div class="row border-top py-3 mt-3">
            
<!-----------------------------------------------EMPTY--------------------------------------------------------->
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-12 text-center padding-top-5">
                        <img src="./assets/empty1.png" alt="Empty Cart" class="img-fluid" style="height:200px">
                        <p class="font-baloo font-size-20 text-black">Empty Wishlist!</p>
                    </div>
                </div>
            </div>
<!-----------------------------------------------EMPTY--------------------------------------------------------->

<!-------------------------------------------------TOTAL------------------------------------------------------------->
            <!--<div class="col-sm-3 px-3">
                <div class="sub-total border text-center mt-2">
                    <div class="py-4">
                        <p class="font-baloo font-size-20">Subtotal (<?php echo isset($subTotal)? count($subTotal):0;?> items):&nbsp;<span class="text-danger"><br>₱<span class="text-danger" id="deal-price"><?php echo isset($subTotal)? $Cart->getSum($subTotal):0?></span></span></p>
                        <button type="submit" class="btn btn-warning mt-3">Checkout</button>
                    </div>
                </div>
            </div>
<!-------------------------------------------------TOTAL------------------------------------------------------------->
        </div>
    </div>
</section>
<!-----------------------------------------------RESERVATION--------------------------------------------------------->