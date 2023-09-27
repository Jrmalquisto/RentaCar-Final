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

<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid search-bar" style="width:100%;">
    <div class="row">
        <div class="col-md-4 row1">
        </div>
        <div class="col-md-4 row2 d-flex align-items-center justify-content-center">
            <h4 class="font-rubik text-light mt-1"><b>Special Offers</b></h4>
        </div>
        <div class="col-md-4 row3 d-flex search">
            <input type="search" name="search" id="searchInput" class="form-control search-field" placeholder="Search" 
                autocomplete="off" style="border: 2px solid #36454F"/>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<section class="py-5" id="special-offers">
    <div class="container px-4 px-lg-5">
    <div class="d-flex flex-wrap grid-container">
        
            <?php array_map(function ($item) use($in_cart){?>
                <div class="grid-item <?php echo $item['item_brand'] ?? "Brand"; ?> border mb-4">
                
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="margin-left-10 text-blue"></h5>
                        <div class="badge bg-dark text-white" style="margin-right: 10px; margin-top: 5px;">For You!
                        </div>
                </div>

                    <div class="item py-2">
                    
                        <h5 class="margin-left-10 text-blue center-text car-name"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                        <div class="product font-rale">
                            <h6 class="margin-left-10 center-text car-name"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6>
                            <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                                <img src="../images/cars/<?php echo $item['item_image']; ?>" alt="product1" class="img-fluid padding mx-auto d-block"></a>
                            <div class="margin-left-10 price py-2 d-flex justify-content-between margin-right-10">
                                <span class="center-text item-text">₱<?php echo $item['item_price'] ?? 0?>/day</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php },$product->getProds())?>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>


<script>
    $(document).ready(function () {
    $('#searchInput').on('input', function () {
        var searchText = $(this).val().toLowerCase();

        $('.grid-item').each(function () {
            var itemText = $(this).text().toLowerCase();
            if (itemText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // After filtering, trigger layout update
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: 20, // Adjust this to your item width
            gutter: 2
        });
    });

    // Initialize Masonry layout
    $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: 20, // Adjust this to your item width
        gutter: 2
    });
});
</script>

