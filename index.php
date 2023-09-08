<?php
   //  ob_start();
    //session_start();
    include ('header.php');
 //-------------------------------------------------------
    include ('Template/_home-page.php');
    include('Template/_advertisement.php');
    include ('Template/_news.php');
 //-------------------------------------------------------
    include ('footer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <script>
      $(document).ready(function() {
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
      });
   </script>

</body>

</html>