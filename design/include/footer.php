<footer class="footer_us" >
    <div class="container">
        <div class="footer_logo">
            <img src="img/logo.png" alt="">
        </div>
        <div class="set_link">
            <ul class="ul_set">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="terms.php">Terms & Conditions</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="refund.php">Refund Cancellation Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="coppy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-7">
                <p>
© Copyright 2023 | Csepracticals. | All Rights Reserved | Bangalore, India - 560103

</p>
                </div>
                <div class="col-sm-5">
                <div class="footer_socc">
        <ul class="ul_set socila_foo">
      <li><a href="https://api.whatsapp.com/send?phone=919686081839" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
      <li><a href="https://www.facebook.com/csepracticals/" target="_blank"><i class="fa fa-facebook"></i></a></li>
      <li><a href="https://www.youtube.com/c/CSEPracticals" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
      <li><a href="https://t.me/telecsepracticals" target="_blank"><i class="fa fa-telegram"></i></a></li>
      
    </ul>
        </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="fixe_socil">
    <a href="https://api.whatsapp.com/send?phone=919686081839" target="_blank"><img src="img/s3.png" alt=""></a>
    <a href="https://www.facebook.com/csepracticals/" target="_blank"><img src="img/s2.png" alt=""></a>
    <a href="https://www.youtube.com/c/CSEPracticals" target="_blank"><img src="img/s1.png" alt=""></a>
    <a href="https://t.me/telecsepracticals" target="_blank"><img src="img/s5.png" alt=""></a>
</div>


<a id="back_top" class="btn btn_theme2 btn2">
    <i class="fa fa-chevron-up"></i>
</a>

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/aos.js"></script>
<script src="js/isotope-docs.min.js"></script>
<script>
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash;
	    var $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	    });
	});
});
</script>
<script>
   AOS.init({
				easing: 'ease-out-back',
				duration: 1000
			});
</script>


</body>

</html>

