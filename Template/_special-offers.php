<?php
    
   

    $brand = array_map(function ($pro){return $pro['item_brand'];},$product_shuffle);
    $unique = array_unique($brand);
    sort($unique);
    shuffle($product_shuffle);
    $db=null;
    function __construct(DBController $db){
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['special_offers'])){

            $Cart->addToCart($_POST['user_id'],$_POST['item_id']);
        }
    }
    //$in_cart = getProdData();
    $in_cart = $product->getProds();
    
?>

<section id="special-offers">

    <div class="container py-5">
        <h4 class="font-rubik  padding-top-20"><b>Special Offers</b></h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16 d-flex align-self-end">
            
            <button class="btn is-checked" id="btn1" data-filter="*">All</button>

            <?php
                array_map(function ($brand){
                    printf('<button class="btn" id="btn1" data-filter=".%s">%s</button>',$brand,$brand);
                },$unique);
            ?>
        </div>

        <div class="grid">
            
            <?php array_map(function ($item) use($in_cart){?>
            <!-- array_map(function ($item) use($in_cart){?> -->
                <div class="grid-item <?php echo $item['item_brand'] ?? "Brand"; ?> border" style="height:253px; width:202px;">
                    <div class="item py-2 " style="width:200px;">
                    <h5 class="margin-left-10 text-blue"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                        <div class="product font-rale">
                            <h6 class="margin-left-10"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6>
                            <a  href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img style="width:200px; height:auto;" src="<?php echo $item['item_image'] ?? "assets/products/1.png"; ?>" alt="product1" class="img-fluid padding"></a>
                            
                                <div class="margin-left-10 price py-2  d-flex justify-content-between margin-right-10">
                                    <span>₱<?php echo $item['item_price'] ?? 0?>/day</span>
                                
                                
                                    
                                </div>
                        </div>
                    </div>
                </div>
            

            <?php },$product->getProds())?>
        </div>
    </div>
</section>

