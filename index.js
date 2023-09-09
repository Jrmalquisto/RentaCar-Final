$(document).ready(function(){
    
    
// alert("hi");

// products.php(Reload Price)
    $('#addBtn').click(function(){
   
        var price= document.getElementById("price");
        var datee1 = document.getElementById("dateFrom");
        var date2 = document.getElementById("dateTo");
    
        $.ajax({
            type:'POST',
            url:'total.php',
            data:{
                num1:$(datee1).val(),
                num2:$(date2).val(),
                price:$(price).val(),
            },
            beforeSend:function(){
                $("#loading").show();
                $("#addBtn").hide();
            },
            success:function(data){
                $('#total_num').html(data);
                $("#loading").hide();
                $("#addBtn").show(); 
            }
        })
    });
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
        
        var bgParallax1 = document.getElementsByClassName('wallp3')[0];
        if (scrollPosition > bgParallax1.offsetTop && scrollPosition <= limit){
            bgParallax1.style.backgroundPositionY = (50 - 10*scrollPosition1/limit) + '%';   
        }else{
            bgParallax1.style.backgroundPositionY = '50%';    
        }
    });
// banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        dots: true,
        items:1
    });

//top products owl carousel
    $("#top-products .owl-carousel").owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        lazyLoad:true,
        margin: 10,
        autoWidth:true,
        responsive: {
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:7
            }
        }

    });

// isotope filter
    var $grid = $(".grid").isotope({
        itemSelector : '',
        layoutMode : 'fitRows',
        fitRows:{
            equalheight: true,
            resizeContainer: false
        }
    });

    // var $grid = $(".gride").isotope({
    //     itemSelector : '',
    //     layoutMode : 'fitRows',
    //     fitRows:{
    //         equalheight: true,
    //         resizeContainer: false
    //     }
    // });

// filter items on button click
    $(".button-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue});
    })

//new Arrivals owl carousel
    $("#new-arrivals .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

// news owl carousel
    $("#news .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive : {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    });

// product qty section
    let $qty_up = $(".qty .qty-up");
    let $qty_down = $(".qty .qty-down");
    let $deal_price = $("#deal-price");
    

    // var today = new Date.now().toISOString().split('T')[0];
    // document.getElementsByName("dateFrom")[0].setAttribute('min', today);

    // var today1 = new Date.now().toISOString().split('T')[0];
    // document.getElementsByName("dateTo")[0].setAttribute('min', today1);

    var price = document.getElementsByName("total");

    // $('#output').click(function(){
    //     $.ajax({
    //         type:'POST',
    //         url:'total.php',
    //         data:{
    //             num1:$('#dateFrom').val(),
    //             num2:$('#dateTo').val(),
                
    //             price:price,
    //         },
    //         success:function(data){
    //             $('#total').html(data);
    //         }
    //     })
    // });


    // let $input = $(".qty .qty_input");
    $(".oceanIn").keyup(function() {
        var total = 0.0;
        $.each($(".oceanIn"), function(key, input) {
            if(input.value && !isNaN(input.value)) {
                total += parseFloat(input.value);
            }
        });
        $("#oceanTotal").html("Total: " + total);
     });

     $(".total").bind('keyup blur', function(){
        $_SESSION["item_p"];
        $_SESSION["days_rent"];
        var quantity = $_SESSION["item_p"];$(this).parent().find(".package").val()
        var value = $_SESSION["days_rent"];
        var price = quantity*value;
        $(this).parent().find("total").html(price.toFixed(2));
      });

// click on qty up button
    $qty_up.click(function(e){

        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

       // change product price using ajax call
        $.ajax({url: "template/ajax.php", type : 'post', data : { item_id : $(this).data("id")}, success: function(result){
            // console.log(result);
            let obj = JSON.parse(result);
            let item_price = obj[0]['item_price'];

            if($input.val() >= 1 && $input.val() <= 9){
                $input.val(function(i, oldval){
                    return ++oldval;
                });

                  //increasing price of product
            $price.text(parseInt(item_price * $input.val()).toFixed(2));

            //setting subtotal
            let subtotal = parseInt($deal_price.text()) + parseInt(item_price);
            $deal_price.text(subtotal.toFixed(2));
            }

          

            }});// closing ajax request

       
      
    });

    // click on qty down button
    $qty_down.click(function(e){
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);


         // change product price using ajax call
         $.ajax({url: "template/ajax.php", type : 'post', data : { item_id : $(this).data("id")}, success: function(result){
            // console.log(result);
            let obj = JSON.parse(result);
            let item_price = obj[0]['item_price'];

            if($input.val() > 1 && $input.val() <= 10){
                $input.val(function(i, oldval){
                    return --oldval;
                });

                
            //increasing price of product
            $price.text(parseInt(item_price * $input.val()).toFixed(2));

            //setting subtotal
            let subtotal = parseInt($deal_price.text()) - parseInt(item_price);
            $deal_price.text(subtotal.toFixed(2));
            }


            }});// closing ajax request


       
    });


    // $('#reservebutton').click(function(){
    //     $('#confirm_modal').modal('show');

    //         // $tr = $(this).closest('tr');

    //         // var data = $tr.children('td').map(function(){
    //         //     return $(this).text();
    //         // }).get();

    //         // console.log(data);


       
    // });
    
    // var data1="<?php echo $_SESSION["item_n"];?>";
    // var price="<?php echo $_SESSION["item_p"];?>";
            
               
 
//     function calculateAmount(){
                    
//         var price = <?php echo $price = $_SESSION["item_p"] ?>;
//         var dateFrom =  <?php echo $dateFrom = $_SESSION["dateFrom"] ?>;
//         var dateTo =  <?php echo $dateTo = $_SESSION["dateTo"] ?>;
//         var datedDiff = dateFrom - dateTo;
//         var days = floor($datedDiff/(60*60*24));
//         // $_SESSION["days_rent"] = $days;
//         var total = (price * days)*-1 ;
       
        
//         alert('Hello'+price);
//         var tot_price = ($price * $days)*-1;
//         $("#total_num").val(total);
    
// };

// const navOptions = {};
// const navObs = new IntersectionObserver(navCallback, navOptions);
// navObs.observe(document.querySelector('header'));
// function navCallback(entries){
//     console.log(entries[0].isIntersecting);
// }


// const observer=new IntersectionObserver(entries =>{
//         // console.log(entries[0].isIntersecting);
//         entries.forEach(entry=>{
//             const intersecting = entry.isIntersecting
//             entry.target.style.backgroundColor = intersecting ? "blue ":"orange"
//         });
// })

const navOptions={
    threshold: .25,
};

const nav = document.querySelector('nav');
const cards = document.querySelectorAll("#backg");
const fade = document.querySelector(".fade-up");
const navbar = document.querySelector("#backyy");
const products=  document.querySelectorAll("#special-offers");

const observer = new IntersectionObserver(entries =>{
    console.log(entries[0].isIntersecting)
    nav.classList.toggle('active', !entries[0].isIntersecting)
    navbar.classList.toggle('active', !entries[0].isIntersecting)
    fade.classList.toggle('faded', !entries[0].isIntersecting)
}, navOptions);

observer.observe(cards[0]);
// cards[0]);

// const newObserver = new IntersectionObserver((ent) =>{
//     // console.log(ent[0].isIntersecting)
//     ent.forEach(entry=>{
//         if(entry.isIntersecting){
//             entry.target.classList.toggle('faded');
//             newObserver.unobserve(entry.target);
//         }
//     // fade.classList.toggle('faded', !ent[0].isIntersecting)
//     })
// }, navOptions);

// document.querySelectorAll('.fade-up').forEach(el=>{
//     newObserver.observe(el);
//     // newObserver.observe(cards[0]);
// });


function checkReserve(){
    return confirm('Confirm Reservation.');
};
 
              
function disableSubmit() {
    document.getElementById("reservebutton").disabled = true;
};

function activateButton(element) {

    if(element.checked) {
        document.getElementById("reservebutton").disabled = false;
    }
    else  {
        document.getElementById("reservebutton").disabled = true;
    }

};
  



});