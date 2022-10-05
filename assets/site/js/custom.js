

 /*nav*/
 $(window).on("scroll", function() {
     if ($(window).scrollTop() > 50) {
         $(".main_nav").addClass("fixed_top");
     } else {
         $(".main_nav").removeClass("fixed_top");
     }
 });
 /*nav close*/


 /*slider */
//  $(function() {
 
//     $(".slider").slick({
//       slidesToShow: 3,
//       slidesToScroll: 3,
      
//       arrows: true,
//        responsive: [
//       {
//         breakpoint: 1024,
//         settings: {
//           arrows: true,
//        slidesToShow: 1,
//       slidesToScroll: 1,
//         }
//       }
//     ]
//     });
    
//     $(".filter li").on('click', function(){
//       var filter = $(this).data('filter');
//       $(".slider").slick('slickUnfilter');
      
//       if(filter == 'red1'){
//         $(".slider").slick('slickFilter','.red1');
//       }
//       else if(filter == 'yellow1'){
//         $(".slider").slick('slickFilter','.yellow1');
//       }
  
//       else if(filter == 'all'){
        
//         $(".slider").slick('slickUnfilter');
//       }
      
//     })
    
//   });
  
 /*slider close*/


//  $(".filter  li").click(function() {
//     $(this).addClass('active').siblings().removeClass('active');
//     });


 /*slider*/
 
$('#slider2').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
 /*slider close*/


 /*back to top*/
 var btn2 = $('#back_top');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn2.addClass('show');
  } else {
    btn2.removeClass('show');
  }
});

btn2.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
 /*back to top*/

 /*slider*/
 $('#slider3').slick({
  dots: true,
  // arrows: false,
  // autoplay: true,
  slidesToShow: 2,
  slidesToScroll: 2,
  adaptiveHeight: true,
  autoplaySpeed: 1500,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
 });
 
  /*slider close*/