<?php
   
    shuffle($product_shuffle);


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_products_submit'])){

            $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
    }
    
    $countedSeller = $product->getSellerCount();
    
    $count = 0;
    // <?php foreach ($product_shop as $item){
?>

<section id="top-products">
<div class="container py-5">
    <?php 
            
            // foreach ($product->getSeller('seller') as $item):
            //     $cart = $product->getOnProduct($item['item_id']);
            // if($statement->rowCount() > 0) {
            //     $items = $statement->fetchAll(PDO::FETCH_ASSOC);
            // }
                // while ($count <= $countedSeller){
                //     $count++;
                foreach ($countedSeller as $value):
                    // $trimmedArray = array_map('trim', $value);
                    // $emptyRemoved = array_filter($trimmedArray);

    ?>
                   
                        
                   <div class="container py-4 mb-4">
                   
                        <h4 class="font-rubik font-size-25"><?php echo $value['shopname'] ?? "Unknown"; ?></h4>
                        <hr>
                        <div class="owl-carousel owl-theme shop-container">
                           
                        
            
    <?php 
                    foreach ($product->getSeller($value['seller_id']) as $item):
                          //foreach ($product->getProdCount($value['seller_id']) as $in_display):
                            // print_r($item);
                            // print_r($value);
                             $in_display = $product->getProdCount($value['seller_id']);
                            // print_r($item);
                            // print_r($in_display);

    ?>
             
                    <?php array_map(function ($item) use($in_display){
                        $itemid = $item['item_id'];
                        ?>
                        
                            
                            <div class="grid-item <?php echo $item['item_brand'] ?? "Brand"; ?> border">
                                <div class="item py-2" style="width:200px;">
                                    <h5 class="margin-left-10 text-blue"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                                    <div class="product font-rale">
                                        <h6 class="margin-left-10"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6>

                                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img style="width:150px; height:auto;" src="../images/cars/<?php echo $item['item_image']; ?>" alt="product1" class="img-fluid padding mx-auto d-block"></a>

                                            <div class="margin-left-10 price py-2  d-flex justify-content-between margin-right-10">
                                                <span>₱<?php echo $item['item_price'] ?? 0?>/day</span>
                                            
                                            </div>
                                    </div>
                                </div>
                            
                            
                            </div>
        
                                          
                         
            <?php }, $product->getProdCount($value['seller_id']));
        
                        // return $cart; 
                      //endforeach; 
                    endforeach;
                    
            ?>
                    </div>
                    <hr>
                </div>
                

            <?php    
                    endforeach;
                // };
                
            ?>
            
       </div> 
    
</section>