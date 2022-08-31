<footer class="footer_us">
    <div class="container">
        <div class="footer_logo">
            <img src="<?= site_url('assets/site/'); ?>img/logo.png" alt="">
        </div>
        <div class="set_link">
            <ul class="ul_set">
                <li><a href="<?= site_url(); ?>">Home</a></li>
                <li><a href="<?= site_url('About'); ?>">About Us</a></li>
                <li><a href="<?= site_url('Terms'); ?>">Terms & Conditions</a></li>
                <li><a href="<?= site_url('Privacy'); ?>">Privacy Policy</a></li>
                <li><a href="<?= site_url('Refund'); ?>">Refund Cancellation Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="coppy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <p>
                        © Copyright 2022 | <?= $this->config->item('PROJECT'); ?>. | All Rights Reserved

                    </p>
                </div>
                <div class="col-sm-5">
                    <div class="footer_socc">
                        <ul class="ul_set socila_foo">
                            <li><a href="<?= $urls['whatsapp']; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            <li><a href="<?= $urls['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= $urls['youtube']; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="<?= $urls['telegram']; ?>" target="_blank"><i class="fa fa-telegram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="fixe_socil">
    <a href="<?= $urls['whatsapp']; ?>" target="_blank"><img src="<?= site_url('assets/site/'); ?>img/s3.png" alt=""></a>
    <a href="<?= $urls['facebook']; ?>" target="_blank"><img src="<?= site_url('assets/site/'); ?>img/s2.png" alt=""></a>
    <a href="<?= $urls['youtube']; ?>" target="_blank"><img src="<?= site_url('assets/site/'); ?>img/s1.png" alt=""></a>
    <a href="<?= $urls['telegram']; ?>" target="_blank"><img src="<?= site_url('assets/site/'); ?>img/s5.png" alt=""></a>
</div>


<a id="back_top" class="btn btn_theme2 btn2">
    <i class="fa fa-chevron-up"></i>
</a>

<script src="<?= site_url('assets/site/'); ?>js/jquery.min.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/popper.min.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/bootstrap.min.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/slick.min.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/custom.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/aos.js"></script>
<!-- <script src="<?= site_url('assets/site/'); ?>js/isotope-docs.min.js"></script> -->
<script>
    const BASE_URL = "<?= site_url(); ?>";
    const LOADING = "<i class='fa fa-spin fa-spinner' aria-hidden='true'></i> Processing ... ";
    $('.count').each(function() {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    $(document).ready(function() {
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = this.hash;
            var $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function() {});
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