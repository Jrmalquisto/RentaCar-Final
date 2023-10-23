<?php
//  $dF = date('Y m d', strtotime($_POST['dateFrom']));
//  $dF = strtolower($dF);
//  $dF = str_replace(" ", "-", $dF);

//  $dT = date('Y m d', strtotime($_POST['dateTo']));
//  $dT = strtolower($dT);
//  $dT = str_replace(" ", "-", $dT);
 
//  $_SESSION["dateFrom"]=$dF;
//  $_SESSION["dateTo"]=$dT;

$dated = date("Y-m-d H:m");
if(!isset($_SESSION["dateFrom"]) && !isset($_SESSION["dateTo"])){
    
        if(isset($_POST['submit'])){
            
            $dF = date('Y-m-d H:m', strtotime($_POST['dateFrom']));
            
            $dT = date('Y-m-d H:m', strtotime($_POST['dateTo']));
            
            $_SESSION["dateFrom"]=$dF;
            $_SESSION["dateTo"]=$dT;
        
            exit(header("Location: ../specialoffers.php"));
        
        }
    
    
} else {
    $dF = $_SESSION["dateFrom"];
    $dT = $_SESSION["dateTo"];
    
    if(isset($_POST['submit'])){

        $dF = date('Y-m-d H:m', strtotime($_POST['dateFrom']));
        
        $dT = date('Y-m-d H:m', strtotime($_POST['dateTo']));
        
        
        $_SESSION["dateFrom"]=$dF;
        $_SESSION["dateTo"]=$dT;

        
        exit(header("Location: ../specialoffers.php"));
        // header("");
    
    }
    
    
    
}
?>
<section class="banner-section" id="banner">
    <div class="masthead justify-content-center align-items-center" id="backg" >
        <div class="container" id="parallax">
            <div class = "row justify-content-center">
                
                <div class ="container pb-3 col-12" id="text1"> 
                    <p class="pt-1" style="display:inline; font-family:Gabarito, sans-serif;">Looking to </p> <span style="display:inline;">Rent-a-Car</span><p style="display:inline;">?</p>
                    <p class="pt-1 pb-5" style="font-weight:100; font-size: 30px; font-family:Gabarito, sans-serif;">Travel Leyte & Samar with RentaCar</p>

                    <p class="txt" style="">We will help you find the best offers from different shops in Leyte & Samar</p>
                    <!-- <p class="pt-1 pb-1" style=" font-size: 50px;">Time to venture our beautiful region.</p> -->

                    <!-- <h5 class="font-baloo font-size-25"><?php echo $dated ?? 0; ?></h5>
                    <h5 class="font-baloo font-size-25">//<?php echo $_SESSION["dateFrom"]?? 0; ?></h5> -->
                </div>

                <!-- <hr class="float-start"style ="width:500px;" >
                </hr> -->

                <div class="form-container mb-5 col-12 h-100 font-family" >
                    <form action="" method="post" class="d-flex justify-content-start row " style = "" >

                        <div class="row  ">
                        <!-- <span><?php print_r($_SESSION['whole'])?></span> -->

                            <div class="input-box col-md-4 ">
                                <span>Location</span>
                                <input type="search" name="location" id="location" placeholder="Search Places">
                            </div> 

                           <div class="input-box col-md-4">
                                <span>Pick-up Date</span>
                                <input type="datetime-local" name="dateFrom" id="dateFrom" min="<?php echo $dated;?>" value="<?php echo $dF ?? $dated;?>">
                            </div>
                            
                           
                            <div class="input-box col-md-4">
                                <span>Return Date</span>
                                <input type="datetime-local" name="dateTo" id="dateTo" min="<?php echo $dated;?>" value="<?php echo $dT ?? $dated;?>">
                            </div>
                        </div>
                        <!-- <input type="submit" name="" id="" class="btn" value="" placeholder="Continue"> -->
                        <div class="container">
                           <div class="d-flex justify-content-end text-center pe-2">
                                <button id="" type="submit" class="btn btn-primary "  name="submit" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Tooltip on left">Continue</button>

                           </div>
                               
                            
                        </div>
                    </form>
                </div>



                <div class = "result-box"  >
                    
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="fb-root"></div>

    <div id="fb-customer-chat" class="fb-customerchat"></div> -->

</section>
<script type="text/javascript">
    
    // window.addEventListener("scroll", function(){
    //     bgPattern.style.backgroundPosition=`$` 120 - +window.pageYOffset/50+'%';
    //     // bgPattern.style.opacity=2-+window.pageYOffset/400+'';
    // });
    
    //var bgParallax = document.getElementsByClassName('parallax');
    window.addEventListener('scroll', function(){
        var scrollPosition = window.pageYOffset;
        // var bgParallax = document.getElementById('backg')[0];
        var bgParallax = document.getElementsByClassName('masthead')[0];
        var limit = bgParallax.offsetTop + bgParallax.offsetHeight;  
        if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit){
            bgParallax.style.backgroundPositionY = (70 - 30*scrollPosition/limit) + '%';   
        }else{
            bgParallax.style.backgroundPositionY = '100%';    
        }
        // var scrollPosition1 = window.pageYOffset;
        // var bgParallax1 = document.getElementsByClassName('wallp3')[0];
        // if (scrollPosition1 > bgParallax1.offsetTop && scrollPosition1 <= limit){
        //     bgParallax1.style.backgroundPositionY = (70 - 30*scrollPosition1/limit) + '%';   
        // }else{
        //     bgParallax1.style.backgroundPositionY = '70%';    
        // }
    });
    // observer.observe(cards[0]);
    // $(function() {
    //     $("#dateFrom").datepicker(

    //     ).datepicker('setDate', '0');
    // });
</script>

