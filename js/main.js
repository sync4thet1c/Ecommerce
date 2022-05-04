$(document).ready(function()
        {
        $('#containerSlider').slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            });
        });



        // window.addEventListener("scroll", function () {
        //     let header = document.querySelector("site-header");
        //     let windowPosition = window.scrollY > 0;
        //     header.classList.toggle("container-fluid", windowPosition);
        //   });
        document.addEventListener("DOMContentLoaded", function(){
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                  document.getElementById('navbar_top').classList.add('fixed-top');
                  // add padding top to show content behind navbar
                  navbar_height = document.querySelector('.container-fluid').offsetHeight;
                  document.body.style.paddingTop = navbar_height + 'px';
                } else {
                  document.getElementById('navbar_top').classList.remove('fixed-top');
                   // remove padding top from body
                  document.body.style.paddingTop = '0';
                } 
            });
          }); 
