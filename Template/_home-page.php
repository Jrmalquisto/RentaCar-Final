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
    <div class="masthead justify-content-center  align-items-center" id="backg"  style="background-image: url('assets/6wall.jpg'); ">
        <div class="container" id="parallax">
            <div class = "row justify-content-center">
                
                <div class ="container pb-3 col-12" id="text1"> 
                    <p class="pt-5 " style="display:inline; padding-bottom:10px;">Looking for a</p> <span style="display:inline;">vehicle</span><p style="display:inline;">?</p>
                    <p class="pt-1 pb-1" style=" font-size: 50px;">Find the suitable car for you.</p>
                    <!-- <p class="pt-1 pb-1" style=" font-size: 50px;">Time to venture our beautiful region.</p> -->

                    <!-- <h5 class="font-baloo font-size-25"><?php echo $dated ?? 0; ?></h5>
                    <h5 class="font-baloo font-size-25">//<?php echo $_SESSION["dateFrom"]?? 0; ?></h5> -->
                </div>
                
                <div class="form-container mb-5 col-12 h-100 font-family row">
                    <form action="" method="post" class="justify-content-center row align-items-center pt-5 pb-4" >
                        <div class="row  ">
                            <div class="input-box col-md-4 ">
                                <span>Location</span>
                                <input type="search" name="" id="" placeholder="Search Places">
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
                                <button id="" type="submit" class="btn btn-primary "  name="submit">Continue</button>

                           </div>
                               
                            
                        </div>
                    </form>
                </div>

                <div>

                </div>
            </div>
        </div>
    </div>
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
            bgParallax.style.backgroundPositionY = (50 - 10*scrollPosition/limit) + '%';   
        }else{
            bgParallax.style.backgroundPositionY = '50%';    
        }
        var scrollPosition1 = window.pageYOffset;
        var bgParallax1 = document.getElementsByClassName('wallp3')[0];
        if (scrollPosition1 > bgParallax1.offsetTop && scrollPosition1 <= limit){
            bgParallax1.style.backgroundPositionY = (50 - 10*scrollPosition1/limit) + '%';   
        }else{
            bgParallax1.style.backgroundPositionY = '50%';    
        }
    });
    // $(function() {
    //     $("#dateFrom").datepicker(

    //     ).datepicker('setDate', '0');
    // });
</script>