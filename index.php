<!DOCTYPE html>
<html>
  <head>
		<title>Welcome to Zarurat.in | Your daily needs fulfiller</title>

    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

		<link rel="stylesheet" type="text/css" href="public/css/home_page.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_footer.css">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
  </head>
  <body>
		<header class="site-header">
			<nav>
				<!-- logo for website, Yet to work -->
				<div class="logo">
          <a href="index.php"><img src="images/Zarurat_logo.png" alt="Zarurat.in"></a>
				</div>

          <!-- Translate the Page -->
        <div class="menu">
          <button class="button-top" onclick="window.open('seller_home.php','_blank');" style="vertical-align:middle"><span>Start Selling</span></button>
          <div id="google_translate_element"></div>
          <script type="text/javascript">
          function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
          }
          </script>

          <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


        </div>
			</nav>
			<section class='header-section'>
				<!-- adding image -->
				<div class="leftside">
            <img src="images/home_screen_demo_mobile.png">
				</div>
        <!-- from : https://bbbootstrap.com/snippets/awesome-app-store-buttons-32348296 -->
        <div class="page-content page-container" id="page-content">
          <div class="padding">
            <div class="row container d-flex justify-content-center">
              <div class="template-demo mt-2">
                <button class="btn btn-outline-dark btn-icon-text" style="border-radius:10px;">
                  <i class="fa fa-apple btn-icon-prepend mdi-36px fa-3x"></i>
                  <span class="d-inline-block text-left">
                    <small class="font-weight-light d-block">Coming Soon on</small> App Store </span>
                  </button>

                  <button class="btn btn-outline-dark btn-icon-text" style="margin-top:10px; border-radius:10px;">
                    <i class="fa fa-android btn-icon-prepend mdi-36px fa-3x"></i>
                    <span class="d-inline-block text-left">
                      <small class="font-weight-light d-block">Coming Soon on</small> Google Play </span>
                    </button>
              </div>
            </div>
          </div>
        </div>

				<div class="rightside">
					<h1>Welcome to Zarurat.in</h1>
					<p>Your friend for all your daily requirements <br><br>
          More products arriving soon
          </p>
					<button class="button" onclick="window.location.href='buyer_home.php';" style="vertical-align:middle;"><span>Buy Now</span></button>
				</div>
			</section>
		</header>

    <!-- ABOUT -->
    <section id="about" data-stellar-background-ratio="0.5">
         <div class="container">
              <div class="row">

                   <div class="col-md-6 col-sm-12">
                        <div class="about-info">
                             <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                                  <h4>Read our story</h4>
                                  <h2 style="font-weight: bold; font-size:22px;"><em>Zarurat.in is a newborn child with Talent</em> </h2>
                             </div>

                             <div class="wow fadeInUp" data-wow-delay="0.4s">
                                  <p style="font-size:15px;">Situation like Covid-19 may have a greater chance to happen again in future. People suffered a lot while sitting at home and they were abondoned of many things including the necessities.</p>
                                  <p style="font-size:15px;">Whether Online Payments, or flexiblity to buy at ease, Buy some Medicine or Milk Products, We take care of everything.</p>
                                  <p style="font-size:15px;">Zarurat.in aims to provide the necessities at your doorstep. No worry to go out of home and taking risks or tension to buy lots of items. We are here to help you and provide the best from your nearby.</br></br><b>Just Log in and say Zarurat.in ;)</b></p>
                             </div>
                        </div>
                   </div>

                   <div class="col-md-6 col-sm-12">
                        <div class="wow fadeInUp about-image" data-wow-delay="0.6s" style="float:right;">
                             <img style="width:550px; height: 500px; border-radius:3px;" src="images/plain-zero-waste-bag-placed-on-marble-table-3850556.jpg" class="img-responsive" alt="">
                        </div>
                   </div>

              </div>
         </div>
    </section>

		<!-- Footer Added -->
		<footer class="contain">

      <?php include 'includes/buyer_footer.php';?>
		</footer>
  </body>
</html>
