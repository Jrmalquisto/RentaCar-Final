const preloaderWrapper = document.querySelector('.loader');


// setTimeout(()=>{
    
//   preloaderWrapper.style.display='none';
// },2000);

window.addEventListener('load', () =>{
  document.body.style.overflow = 'hidden';
  
  setTimeout(()=>{
   
    preloaderWrapper.style.display='none';
    
  },2000);
});