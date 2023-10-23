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

    //$in_cart = getProdData();
    $in_cart = $product->getProds();
    
?>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid search-bar" >
    <div class="row head-row">
        <div class="col-md-4 col-sm-6 row1 d-flex align-items-center justify-content-center">

        </div>

        <div class="col-md-4 row2 col-sm-0 d-flex align-items-center justify-content-center">
        </div>

        <div class="col-md-4 col-sm-6 row3 d-flex align-items-center justify-content-center search ">
            <h5 class="font-rubik text-light"><b>Special Offers</b></h5>

            <input type="search" name="search" id="searchInput" class="form-control search-field ms-4" placeholder="Search" 
                autocomplete="off" style="border: 2px solid #36454F"/>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<section class="py-5" id="special-offers">
    <div class="container px-4 px-lg-5">
    <div class="d-flex flex-wrap grid-container">
        
            <?php array_map(function ($item) use($in_cart){
                    $con = mysqli_connect("localhost","root","","rentacar");

                    $get_rating = mysqli_query($con,"SELECT * FROM rating WHERE item_id = ".$item["item_id"]."");
                    $rating = mysqli_num_rows($get_rating);
                     
                    $rate5 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 5");
                    $r5 = mysqli_num_rows($rate5);
                    
                    $rate4 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 4");
                    $r4 = mysqli_num_rows($rate4);
                    
                    $rate3 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 3");
                    $r3 = mysqli_num_rows($rate3);
                    
                    $rate2 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 2");
                    $r2 = mysqli_num_rows($rate2);
                    
                    $rate1 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 1");
                    $r1 = mysqli_num_rows($rate1);
                    
                    if($rating!=0){
                        $total1=( $r5 + $r4 + $r3 + $r2 + $r1);
                        $ave = round((5* $r5 + 4*$r4 + 3*$r3 + 2*$r2 + 1*$r1) / ($total1)); 
                    } else{
                        $ave = 0;
                    }
            ?>

                <div class="grid-item <?php echo $item['item_brand'] ?? "Brand"; ?> border mb-4 pb-4">
                
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="margin-left-10 ms-3 text-blue"></h5>
                        <!-- <?php 
                                if ($ave !=0){
                                    echo '<p class="ave" >'.$ave.' <i class="fa-solid fa-star fa-2xs"></i> </p>';
                                } else {
                                    echo '<p></p>';
                                }
                            ?> -->
                        <div class="badge bg-dark text-white" style="margin-right: 10px; margin-top: 5px;">For You!
                        </div>
                </div>
<!-- 
                    <div class="item py-2">
                        
                        <h5 class="margin-left-10 text-blue center-text car-name"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                        <h6 class="margin-left-10 center-text car-name"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6>

                        <div class="product font-rale">
                            <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                                <img src="../images/cars/<?php echo $item['item_image']; ?>" alt="product1" class="img-fluid padding mx-auto d-block"></a>
                            <div class=" price ">
                                <span class="center-text item-text">₱<?php echo $item['item_price'] ?? 0?>/day</span>

                            </div>
                            
                            <div class="rating-text">
                            <?php 
                                if ($ave !=0){
                                    echo '<p class="center-text">'.$ave.' <i class="fa-solid fa-star fa-2xs"></i> </p>';
                                } else {
                                    echo '<p></p>';
                                }
                            ?>
                            </div>
                        </div>
                    </div> -->

                    <div class="item py-2 ">
                        
                        
                        <div class="product font-rale row">
                            
                            <div class="rating-text col-xs-6">
                                <h5 class="margin-left-10 text-blue center-text car-name"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                                <!-- <h6 class="margin-left-10 center-text car-name"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6> -->
                                <h6 class="margin-left-10 center-text car-name"><?php echo $item['item_name'] ?? "Unknown"; ?></h6>

                                
                            </div>
                                
                            <div class=" price col-xs-6 d-flex justify-content-center">
                                <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                                <img src="../images/cars/<?php echo $item['item_image']; ?>" alt="product1" class="img-fluid"></a>
                            </div>
                            
                            
                        </div>

                        <div class = "item-footer">
                            <p class=" item-text"><span>₱<?php echo $item['item_price'] ?? 0?></span> /day</p>

                            <?php 
                                if ($ave !=0){
                                    echo '<p class="ave" >'.$ave.' <i class="fa-solid fa-star fa-2xs"></i> </p>';
                                } else {
                                    echo '<p></p>';
                                }
                            ?>
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
        columnWidth: 40, // Adjust this to your item width
        gutter: 2
    });
});
</script>

