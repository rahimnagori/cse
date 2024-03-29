<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/slick.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/aos.css" />
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/effect.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/style.css">
  <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/responsive.css">
  <link rel="shortcut icon" type="image/x-icon" href="<?= site_url('assets/site/'); ?>img/favi.png">
  <title><?= $this->config->item('TITLE'); ?> </title>
</head>

<body>

  <div class="man_nav" data-aos="fade-down">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url(); ?>">
          <img src="<?= site_url('assets/site/'); ?>img/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar line_us1"></span>
          <span class="icon-bar line_us2"></span>
          <span class="icon-bar line_us3"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <a class="nav-link" href="<?= site_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('About'); ?>">About Us</a>
            </li>
            <?php
            if (count($upcomingCourses)) {
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Upcoming Courses</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  foreach ($upcomingCourses as $upcomingCourse) {
                  ?>
                    <a class="dropdown-item" href="#"><?= $upcomingCourse['title']; ?></a>
                  <?php
                  }
                  ?>
                </div>
              </li>
            <?php
            }
            ?>
            <?php
            if (count($youtubePlaylists)) {
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Youtube Playlists</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                  <?php
                  foreach ($youtubePlaylists as $upcomingCourse) {
                  ?>
                    <a class="dropdown-item" target="_blank" href="<?= $upcomingCourse['url']; ?>"><?= $upcomingCourse['title']; ?></a>
                  <?php
                  }
                  ?>
                </div>
              </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="./#OurCourse">Our Course</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contact Us</a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                <a class="dropdown-item" href="mailto:<?= $emails['contact_email']; ?>">Email</a>
                <a class="dropdown-item" target="_blank" href="<?=$urls['whatsapp_url'];?>">WhatsApp </a>
                <a class="dropdown-item" target="_blank" href="<?=$urls['telegram_url'];?>">Telegram </a>
              </div>
            </li>

            <li class="nav-item btn_login">
              <a class="nav-link" href="<?= $urls['login_url']; ?>" target="_blank">Login</a>
            </li>
            <li class="nav-item btn_sign_up">
              <a class="nav-link" href="<?= $urls['signup_url']; ?>" target="_blank">Sign Up</a>
            </li>
            <li class="nav-item btn_book">
              <a class="nav-link" href="<?= $urls['youtube_subscribe_url']; ?>" target="_blank"><i class="fa fa-youtube"></i> Subscribe </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <!-- VISA Tracking Code for www.csepracticals.com --><script>(function(v,i,s,a,t){v[t]=v[t]||function(){(v[t].v=v[t].v||[]).push(arguments)};if(!v._visaSettings){v._visaSettings={}}v._visaSettings[a]={v:'1.0',s:a,a:'1',t:t};var b=i.getElementsByTagName('body')[0];var p=i.createElement('script');p.defer=1;p.async=1;p.src=s+'?s='+a;b.appendChild(p)})(window,document,'//app-worker.visitor-analytics.io/main.js','6e3914e5-2eb8-11ec-b589-901b0edac50a','va')</script><!-- VISA Tracking Code for www.csepracticals.com -->

  