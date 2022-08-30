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
  <title><?= $this->config->item('PROJECT'); ?> </title>
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
            <li class="nav-item">
              <a class="nav-link" href="mailto:<?= $emails['contact_email']; ?>">Contact Us</a>
            </li>
            <li class="nav-item btn_login">
              <a class="nav-link" href="<?= $urls['login']; ?>" target="_blank">Login</a>
            </li>
            <li class="nav-item btn_sign_up">
              <a class="nav-link" href="<?= $urls['signup']; ?>" target="_blank">Sign Up</a>
            </li>
            <li class="nav-item btn_book">
              <a class="nav-link" href="<?= $urls['youtube_subscribe']; ?>" target="_blank"><i class="fa fa-youtube"></i> Subscribe </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>