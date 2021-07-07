<?php
# http://localhost/digiGoApp/resetPassword.php

if(isset($_GET['email'])){
  $token=$_GET['token'];
  $email=$_GET['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- SEO Meta Tags -->
    <meta
      name="description"
      content="DigiGo free Software to improve your business and generate leads for the offered services"
    />
    <meta name="André Gomes" content="DigiGO App" />

    <!-- Website Title -->
    <title>DigiGo App - Reset Password</title>

    <!-- Styles -->
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext"
      rel="stylesheet"
    />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <link href="css/swiper.css" rel="stylesheet" />
    <link href="css/magnific-popup.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/myCss.css" rel="stylesheet" />

    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png" />
  </head>
  <body data-spy="scroll" data-target=".fixed-top">
    <!-- Preloader -->
    <div class="spinner-wrapper">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- end of preloader -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <!-- Text Logo - Use this if you don't have a graphic logo -->
      <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

      <!-- Image Logo -->
      <a class="navbar-brand logo-image" href="index.html"
        ><span class="brand-name">DigiGo</span></a>

      <!-- Mobile Menu Toggle Button -->
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
      </button>
      <!-- end of mobile menu toggle button -->

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link page-scroll" href="index.html#header"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link page-scroll" href="index.html#services">Services</a>
          </li>

          <!-- Dropdown Menu -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle page-scroll"
              href="index.html#about"
              id="navbarDropdown"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >About</a
            >
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="terms-conditions.html"
                ><span class="item-text">Terms Conditions</span></a
              >
              <div class="dropdown-items-divide-hr"></div>
              <a class="dropdown-item" href="privacy-policy.html"
                ><span class="item-text">Privacy Policy</span></a
              >
            </div>
          </li>
          <!-- end of dropdown menu -->
          <li class="nav-item">
            <a class="nav-link page-scroll" href="index.html#contact">Contact</a>
          </li>
          <!-- Dropdown Menu Log in/Sign in-->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle page-scroll"
              id="navbarDropdown"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >Enter</a
            >
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="login.html"
                ><span class="item-text">Log in</span></a
              >
              <div class="dropdown-items-divide-hr"></div>
              <a class="dropdown-item" href="signin.html"
                ><span class="item-text">Sign in</span></a
              >
            </div>
          </li>
          <!-- end of dropdown menu Log in/Sig in -->
        </ul>
      </div>
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->
    <!-- Header -->
    <header id="header" class="header">
      <div class="header-content header-padding-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="text-container">
                <h1>
                  <span class="turquoise">Reset Password</span>
                </h1>
                <div class="contact-form">
                  <form id="signForm" class="user" method="get" action="php/resetPassword.php">
                  <div class="form-group">
                    <input
                      class="form-control form-control-user"
                      type="password"
                      id="signinPsw"
                      name="signinPsw"
                      placeholder="New Password"
                      autocomplete="off"
                      required/>
                  </div>
                  <input name="token" value="<?php echo $token;?>" hidden>
                  <input name="email" value="<?php echo $email;?>" hidden>
                  <div class="form-group">
                        <input type="checkbox" onclick="showPsw()">Show Password
                  </div>
                  <input
                    class="btn-solid-lg page-scroll" id="submitRegister"
                    type="button" name="resetPsw" onclick="validatePsw()" value="SUBMIT">
                </form>
                </div>
                <div class="text-body pt-3">
                  <ul class="list-unstyled li-space-lg">
                  <li><a class="links" href="login.html">Already have an account? Login!</a
                  ></li>
                  </ul>
                </div>
              </div>
              <!-- end of text-container -->
            </div>
            <!-- end of col -->
            
              <!-- end of image-container -->
            </div>
            <!-- end of col -->
          </div>
          <!-- end of row -->
        </div>
        <!-- end of container -->
      </div>
      <!-- end of header-content -->
    </header>
    <!-- end of header -->
    
    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="footer-col">
              <h4>About DigiGo</h4>
              <p>
                We're passionate about offering some of the best business growth
                services for support teams
              </p>
            </div>
          </div>
          <!-- end of col -->
          <div class="col-md-4">
            <div class="footer-col middle">
              <h4>Important Links</h4>
              <ul class="list-unstyled li-space-lg">
                <li class="media">
                  <i class="fas fa-square"></i>
                  <div class="media-body">
                    Our business partner
                    <a
                      class="turquoise"
                      href="https://www.cinel.pt/appv2/"
                      target="_blank"
                      >cinel.pt</a
                    >
                  </div>
                </li>
                <li class="media">
                  <i class="fas fa-square"></i>
                  <div class="media-body">
                    Read our
                    <a class="turquoise" href="terms-conditions.html"
                      >Terms & Conditions</a
                    >,
                    <a class="turquoise" href="privacy-policy.html"
                      >Privacy Policy</a
                    >
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- end of col -->
          <div class="col-md-4">
            <div class="footer-col last">
              <h4>Social Media</h4>
              <span class="fa-stack">
                <a href="https://www.facebook.com/agrockmusic" target="_blank">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x"></i>
                </a>
              </span>
              <!--<span class="fa-stack">
                <a href="#your-link">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x"></i>
                </a>
              </span>
              <span class="fa-stack">
                <a href="#your-link">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-google-plus-g fa-stack-1x"></i>
                </a>
              </span>-->
              <span class="fa-stack">
                <a href="https://www.instagram.com/agrockmusic" target="_blank">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-instagram fa-stack-1x"></i>
                </a>
              </span>
              <span class="fa-stack">
                <a
                  href="https://www.linkedin.com/in/andr%C3%A9-gomes-9a2bba123/"
                  target="_blank"
                >
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-linkedin-in fa-stack-1x"></i>
                </a>
              </span>
            </div>
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of footer -->
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p class="p-small">
              Copyright © 2021 <a href="">DigiGo</a> - All rights reserved
            </p>
          </div>
          <!-- end of col -->
        </div>
        <!-- enf of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of copyright -->
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script>
    <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script>
    <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script>
     <!-- reCaptcha Api Script -->
    <script src="js/recaptcha.signinForm.js"></script>
    <script
      src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
      async
      defer
    ></script>
    <!-- Validate sigin form  -->
    <script src="../digiGoApp/js/signin.form.ValidateNewPsw.js"></script>
   
  </body>
</html>
