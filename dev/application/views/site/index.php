<style>
  .man_nav {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    z-index: 2;
  }

  .sec_pad.abhout {
    background: #edebf082;
  }
</style>
<div class="tot_had">
  <div class="efff_h">

    <div class="purple"></div>
    <div class="medium-blue"></div>
    <div class="light-blue"></div>
    <div class="red1"></div>
    <div class="orange"></div>
    <div class="cyan"></div>
    <div class="lime"></div>
  </div>
  <div class="container">
    <div class="row d_flex a_t">
      <div class="col-sm-6" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="linear">
        <div class="conten_set des_c1">
          <h1>
            India's #1 <br>
            Problem Solving <?= $this->config->item('PROJECT'); ?> Professionals
          </h1>
          <p class="text-justified">
            Welcome to <?= $this->config->item('PROJECT'); ?>, an OnlineCourse offering Website in the field of Operating Systems, Networking, Linux System Programming and Several Coding Projects. We offer only Development based Projects, no DS/ALGO/CP.
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="video_set">
          <video width="320" height="240" controls>
            <source src="https://video.wixstatic.com/video/8cccc0_15cae689a97e4a2781b24890abba2073/1080p/mp4/file.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="sec_pad abhout">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="zoom-in" data-aos-duration="2000">
        <div class="ab_img2 text-center">
          <img src="<?= site_url('assets/site/'); ?>img/img_16.png" alt="" class="img_r">
        </div>
      </div>
      <div class="col-md-6" data-aos="zoom-in-up" data-aos-duration="2000">
        <div class="abn_text">
          <div class="heading">
            <h1>
              About Us
            </h1>
            <p>
              Welcome to <?= $this->config->item('PROJECT'); ?>, an Online Course offering Website in the field of Operating Systems, Networking, Linux System Programming and Several Coding Projects. We offer only Development based Projects, no DS/ALGO/CP.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
if (count($courses)) {
?>
  <section class="sec_pad  sec_3 slide_set" id="OurCourse" data-js="hero-demo">
    <div class="container">
      <div class="btn_sim">
        <a href="<?= $urls['telegram']; ?>" target="_blank" class="btn btn_theme2 btn-lg btn_r rad_morre1">
          <span class="on1"><img src="<?= site_url('assets/site/'); ?>img/telegram.png" alt="" style="width: 26px;transform: translateX(-10px) translateY(-2px);"> Telegram <i class="fa fa-long-arrow-right"></i></span>
        </a>
      </div>
      <div class="heading text-center " data-aos="slide-right" data-aos-duration="1000">
        <h1>
          Best Selling Courses
        </h1>
        <p>We offer 20+ Courses in the field of System Programming, Networking Theory and Development Projects. The Courses are available on Udemy and Teachable Platform with Life-time access.</p>

      </div>
      <div class="fiter_set">
        <ul class="filters  js-radio-button-group ul_set clearfix">
          <button data-filter="*" class="button is-checked">All (<?= count($courses); ?>)</button>
          <?php
          foreach ($categories as $category) {
          ?>
            <button data-filter=".cat-<?= $category['id']; ?>" class="button" type="button" onclick="load_category('<?= $category['id']; ?>');"><?= $category['category_name']; ?> (<?= $category['totalCourses']; ?>)</button>
          <?php
          }
          ?>
        </ul>
      </div>
      <div class="btn_us_add">
        <span id="all-category-btn"></span>
        <?php
        foreach ($categories as $category) {
          continue;
          if ($category['category_link'] != null) {
        ?>
            <a href="<?= $category['category_link']; ?>" class="hidden btn btn_theme hidden category-<?= $category['category_name']; ?> category-btn">Buy all courses in this category</a>
        <?php
          }
        }
        ?>
      </div>
      <div class="row grid">
        <?php
        foreach ($courses as $course) {
          $youTubeUrl = '';
          if ($course['thumbnail_type'] == 2) {
            $youTubeEmbed = explode("v=", $course['thumbnail']);
            $youTubeUrl = $youTubeEmbed[1];
          }
        ?>
          <div class="col-sm-3 col-6 element-item cat-<?= ($course['type']) ? 'paid' : 'free'; ?> cat-<?= $course['category']; ?>" data-category="cat-<?= $course['category']; ?>">
            <div class="box_cos1">
              <div class="bors_img">
                <?php
                if ($course['thumbnail_type'] == 1) {
                ?>
                  <img class="" src="<?= site_url($course['thumbnail']); ?>">
                <?php
                } else {
                ?>
                  <iframe width="100%" src="https://www.youtube.com/embed/<?= $youTubeUrl; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php
                }
                ?>
              </div>
              <div class="conten_b linkAd">
                <a href="<?= $course['course_link']; ?>" target="_blank"></a>
                <h4><?= $course['title']; ?></h4>
                <p>
                  <?= $course['short_description']; ?>
                  <span class="star_rat">
                    <?= $course['ratings']; ?>
                    <span><i class="fa fa-star"></i></span>
                  </span>
                </p>

                <h5>
                  <span class="or1">Enrolled: <?= $course['enrolled']; ?></span>
                  <span class="or2">Duration: <?= $course['duration']; ?> (h)</span>
                </h5>
                <h6>
                  <span class="or1">Price: $<?= $course['price']; ?></span>
                  <span class="or2">
                    <button type="button" onclick="get_course_details(<?= $course['id']; ?>);" class="btn btn_theme2 btn_r">Content </button>
                  </span>
                </h6>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>
<?php
}
?>

<section class="sec_pad sec_5">
  <div class="container">
    <div class="heading text-center">
      <h1>
        <?= $this->config->item('PROJECT'); ?>
      </h1>
    </div>
    <div class="row align-items-center">
      <div class="col-sm-3">
        <div class="conter_set">
          <img class="img_rat" alt="" src="<?= site_url('assets/site/'); ?>img/COURSES.png">
          <div class="circle">
            <span class="count"><?= $highlights['active_courses']; ?></span>
          </div>

          <h4>
            ACTIVE COURSES
          </h4>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="conter_set">
          <img class="img_rat" alt="" src="<?= site_url('assets/site/'); ?>img/UPDATE.png">
          <div class="circle2">
            <span class="count"><?= date("Y", strtotime($highlights['last_update'])); ?></span>
          </div>
          <h4>
            LAST UPDATE
          </h4>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="conter_set">
          <img class="img_rat" alt="" src="<?= site_url('assets/site/'); ?>img/REVIEWS.png">
          <div class="circle3">
            <span class="count"><?= $highlights['total_reviews']; ?></span>
          </div>

          <h4>
            TOTAL REVIEWS
          </h4>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="conter_set">
          <img class="img_rat" alt="" src="<?= site_url('assets/site/'); ?>img/RATING.png">
          <div class="circle4">
            <span class=""><?= $highlights['average_rating']; ?></span>
          </div>

          <h4>
            AVERAGE RATING
          </h4>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="conter_set">
          <img class="img_rat" alt="" src="<?= site_url('assets/site/'); ?>img/STUDENTS.png">
          <div class="circle5">
            <span class="count"><?= $highlights['total_students']; ?></span>
          </div>

          <h4>
            TOTAL STUDENTS
          </h4>
        </div>
      </div>

    </div>
  </div>
  <div class="download-shape-1">
    <img src="<?= site_url('assets/site/'); ?>img/shape_1.png" alt="">
  </div>
  <div class="download-shape-2">
    <img src="<?= site_url('assets/site/'); ?>img/shape_2.png" alt="">
  </div>
  <div class="download-shape-3">
    <img src="<?= site_url('assets/site/'); ?>img/shape_3.png" alt="">
  </div>
</section>
<section class="sec_pad">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <img class="img_r" src="<?= site_url('assets/site/'); ?>img/img_44.png">
      </div>
      <div class="col-sm-6">
        <div class="abn_text">
          <div class="heading">
            <h1>
              Download Full Course PDF/PPT of all courses for Free
            </h1>
          </div>
          <a href="<?= $urls['download_full_course']; ?>" class="btn btn_theme2 btn-lg btn_r " target="_blank">
            <span class="on1">Download </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- <section class="sec_des_h2 sec_pad">
  <div class="container">
    <div class="heading text-center" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="linear">
      <h1>
        JACKPOT OFFER
      </h1>
      <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, took a galley of type and scrambled.
      </p>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="box_pay conten_set">
          <h4>
            Buy Entire Course Bundle
            (20 Courses ) in Just
          </h4>
          <img src="<?= site_url('assets/site/'); ?>img/img_40.png">
          <h2>~INR 4900 | $65</h2>
          <p>
            ​Note for Jackpot offer : Get Rs 250/$5 off for each paid course you are already enrolled in !
          </p>
          <p>
            Lifetime Access to Udemy + Teachable, and All Future Courses shall be Free !
          </p>
          <div class="bntn_get">
            <a href="#" class="btn btn_theme2 btn-lg btn_r">Get Started</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box_pay conten_set">
          <h4>
            Only System Programmig 12 Courses
          </h4>
          <img src="<?= site_url('assets/site/'); ?>img/img_40.png">
          <h2>$30 <span class="mmmm">One time </span></h2>
          <p>
            LifeTime Access
            on Udemy + Teachable, $30 One time Payment
          </p>

          <div class="bntn_get">
            <a href="#" class="btn btn_theme2 btn-lg btn_r">Get Started</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box_pay conten_set">
          <h4>
            Monthly Subscription
          </h4>
          <img src="<?= site_url('assets/site/'); ?>img/img_40.png">
          <h2>$10 <span class="mmmm">/Month </span></h2>
          <p>
            Access to Teachable Only
            First 7 days is Free, then $10/Month, Cancel Anytime
          </p>

          <div class="bntn_get">
            <a href="#" class="btn btn_theme2 btn-lg btn_r">Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<?php
if (count($deals)) {
?>
  <section class="sec_des_h1 pad_t">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="gir_im1">
            <div class="table_1">
              <div class="table_2">
                <img src="<?= site_url('assets/site/'); ?>img/img_24.png" alt="" class="img_r">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="conten_set">
            <h4 class="bg_hed">Learn and Learn </h4>
            <h1>Interesting packages!!</h1>
            <p>
              Pls send email to <a href="mailto:<?= $emails['default_email']; ?>"><?= $emails['default_email']; ?></a> after payment, telling us which Courses you want. You will be given lifetime access to Courses. Use Partial Payment links below in case you need to pay us an arbitrary amount after negotiation.
            </p>
          </div>
          <div class="des_c2">
            <div class="row">
              <?php
              foreach ($deals as $deal) {
              ?>
                <div class="col-sm-6">
                  <div class="rig_icon conten_set">
                    <a href="<?= $deal['link']; ?>" target="_blank"></a>
                    <span><img src="<?= site_url('assets/site/'); ?>img/img_25.png" alt="<?= $deal['title']; ?>"></span>
                    <h4><?= $deal['title']; ?></h4>
                    <p><?= $deal['description']; ?></p>
                    <h2><?= $deal['price_inr']; ?> INR | $<?= $deal['price_dollar']; ?></h2>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>

<section class="sec_pad get_in_touch1" id="contact">
  <div class="efff_h effect_cont">

    <div class="yellow1"></div>
    <div class="light-green"></div>
    <div class="magenta"></div>
    <div class="lightish-red"></div>
    <div class="pink"></div>
  </div>
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="get_in_touch2">
          <div class="heading text-center">
            <h1>
              Enquiry Form
            </h1>
            <p>
              Leave us a little info, and we’ll be in touch.
            </p>
          </div>
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="img_con">
                <img src="<?= site_url('assets/site/'); ?>img/img_21.png" alt="" class="img_r">
              </div>
            </div>
            <div class="col-md-6">
              <form method="post" id="contactForm" onsubmit="send_contact_request(event);">
                <div class="form-group">
                  <label for="name">Name</label>
                  <div class="ion_in">
                    <i class="fa fa-user-o"></i>
                    <input type="text" class="form-control" placeholder="Full Name" name="full_name" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Phone Number</label>
                  <div class="ion_in">
                    <i class="fa fa-phone"></i>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <div class="ion_in">
                    <i class="fa fa-envelope-o"></i>
                    <input type="email" class="form-control" placeholder="Email" name="email" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Subject</label>
                  <div class="ion_in">
                    <i class="fa fa-info-circle"></i>
                    <input type="text" class="form-control" placeholder="Subject" name="subject" required="">
                  </div>
                  <p class=" text-danger" style="display:none" id="alte_subject2">Sorry first space is not allowed</p>
                </div>
                <div class="form-group">
                  <label for="">Leave us a message...</label>
                  <div class="ion_in">
                    <i class="fa fa-edit"></i>
                    <textarea class="form-control" placeholder="Message" name="message" required=""></textarea>
                  </div>
                </div>
                <div id="responseMessage"></div>
                <div class="form-group ">
                  <button type="submit" class="btn btn_theme2 btn-lg btn_r fb btn_submit" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
if (count($reviews)) {
?>
  <section class="sec_pad sec_4 text_monial" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="1000">
    <div class="container">
      <div class="heading text-center">
        <h1>
          Users Reviews
        </h1>
      </div>
      <div class="slihh_min arrow_set  ">
        <div class=" slider_arrrw" id="slider3">
          <?php
          foreach ($reviews as $review) {
          ?>
            <div class="item">
              <div class="testimonial2">
                <div class="testimonial-content2">
                  <p class="description">
                    <?= $review['review']; ?>
                  </p>
                </div>
                <div class="user_immg">
                  <h4>
                    <a href="<?= ($review['link'] != null ? $review['link'] : '#'); ?>" target="_blank"><?= $review['name']; ?></a>
                    <span><?= $review['designation']; ?></span>
                  </h4>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>

<!-- modal -->
<div class="modal fade" id="courseDetailModal" tabindex="-1" role="dialog" aria-labelledby="lab_na1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lab_na1">Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="course-detail"></div>
    </div>
  </div>
</div>
<!-- modal -->


<script>
  function get_course_details(course_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Course/' + course_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {

      },
      success: function(response) {
        $("#courseDetailModal").modal("show");
        $("#course-detail").html(response);
      }
    });
  }

  function send_contact_request(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Contact-Request',
      data: new FormData($('#contactForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Send ');
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
        if (response.status == 1) {
          $("#contactForm")[0].reset();
        }
      }
    });
  }

  function load_category(category_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Category/' + category_id,
      dataType: 'json',
      beforeSend: function(xhr) {
        $("#all-category-btn").hide();
        $("#all-category-btn").html('');
      },
      success: function(response) {
        if (response.status == 1) {
          $("#all-category-btn").html(allCategoryBtn(response.url));
          $("#all-category-btn").show();
        }
      }
    });
  }

  const allCategoryBtn = (url) => {
    return `<a href="${url}" class="btn btn_theme category-btn" target="_blank" >Buy all courses in this category</a>`
  }
</script>