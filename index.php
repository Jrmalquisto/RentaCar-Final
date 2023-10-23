<?php
   

    include ('header2.php');
    require_once('auth.php');

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
         // var searchInput = 'location';
         // var autocomplete;

        

         //    autocomplete = new google.maps.places.Autocomplete((document.getElementById(location)), {
         //       types: ['geocode'], componentRestrictions: {'country': ['PH']},
         //    });

         //    autocomplete.addListener('place_changed', onPlaceChanged);
         

         // function onPlaceChanged(){
         //    var place = autocomplete.getPlace();

         //    if (!place.geometry){
         //       document.getElementById('location').placeholder = 'Enter a name';

         //    } else {
         //       document.getElementById('location').innerHTML = place.name;
         //    }
         // }
         
         // google.maps.event.addListener(autocomplete, 'place_changed', function () {
         //    var near_place = autocomplete.getPlace();
         //    document.getElementById('latitude').value = near_place.geometry.location.lat();
         //    document.getElementById('longitude').value = near_place.geometry.location.lng();
         // });

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
            threshold: .50,
         };

         const nav = document.querySelector('nav');
         const cards = document.querySelectorAll("#backg");
         const fade = document.querySelector(".fade-up");
         const navbar = document.querySelector("#backyy");
         // const products=  document.querySelectorAll("#special-offers");
         const sections = document.querySelectorAll("section");

         const observer = new IntersectionObserver(function (entries, observer){
            // console.log(entries[0].isIntersecting)
            
            entries.forEach(entry =>{
               nav.classList.toggle('active', !entries[0].isIntersecting)
               navbar.classList.toggle('active', !entries[0].isIntersecting)
               fade.classList.toggle('faded', !entries[0].isIntersecting)
               // console.log(!entries[0].isIntersecting)


            });

         }, navOptions);
         

         observer.observe(sections[0]);

         // observer.observe(navbar[0]);
      });
   </script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDlsmj1XdHZ71UE12OIrGlv7ALC588fA-Y" async defer></script> -->
<script src="autocomplete.js" defer></script>

</body>

</html>