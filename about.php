<?php
	ob_start();
	session_start();
	include_once("connect.php");
	$msg="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iconic Hair & Beauty School-Learn Today, Lead Tomorrow</title>
  <!-- favicons Icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">

  <meta name="description" content="Iconic Hair & Beauty School-Learn Today, Lead Tomorrow">

  <!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="css2?family=Alex+Brush&family=Cormorant:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">


<link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendors/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
<link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css">
<link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css">
<link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css">
<link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css">
<link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css">
<link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.css">
<link rel="stylesheet" href="assets/vendors/solox-icons/style.css">
<link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css">

<!-- template styles -->
<link rel="stylesheet" href="assets/css/solox.css">
</head>

<body class="custom-cursor">

  <div class="custom-cursor__cursor"></div>
  <div class="custom-cursor__cursor-two"></div>

  <div class="preloader">
    <div class="preloader__image" style="background-image: url(assets/images/loader.png);"></div>
  </div>
  <!-- /.preloader -->
  <div class="page-wrapper">
	<?php include_once("header.php"); ?>


	<section class="page-header">
		<div class="page-header__bg"></div>
		<!-- /.page-header__bg -->
		<div class="container">			
			<h2 class="page-header__title">About us</h2>
		</div><!-- /.container -->
	</section><!-- /.page-header -->

		<section class="why-choose-two">
			<?php
				$c=$db->query("Select * from matter where m_id='15'")->fetch(PDO::FETCH_ASSOC);
				$arr=explode(';',$c['pic']);
			?>
						<div class="container">
							<div class="row">
								<div class="col-lg-5">
									<div class="why-choose-two__image">
										
										<img src="<?php echo $arr[0]; ?>">
										<img src="<?php echo $arr[1]; ?>" class="why-choose-two__image__two" style="max-height: 73%;">

										<img src="assets/images/shapes/why-choose-2-s-1.png" class="why-choose-two__image__shape" alt="">
										<div class="why-choose-two__image__icon wow fadeInUp" data-wow-duration="1500ms">
											<img src="assets/images/shapes/why-choose-2-s-2.png" alt="">
										</div><!-- /.why-choose-two__icon -->
									</div><!-- /.why-choose-two__image -->
								</div><!-- /.col-lg-6 -->
								<div class="col-lg-7">
									<div class="why-choose-two__content">
										<div class="sec-title">
											<img src="assets/images/shapes/sec-title-s-1.png" alt="Get to know us" class="sec-title__img">						
											<h6 class="sec-title__tagline">Get to know us</h6><!-- /.sec-title__tagline -->
											<h3 class="sec-title__title"><?php echo $c['title']; ?></h3><!-- /.sec-title__title -->
										</div><!-- /.sec-title -->
										<p class="why-choose-two__highlight" style="word-wrap:break-word;  white-space:pre-line;  text-align:justify;"><?php echo $c['extra']; ?></p><!-- /.why-choose-two__highlight -->
										<p class="why-choose-two__text" style="word-wrap:break-word;  white-space:pre-line;  text-align:justify;"><?php echo $c['desp']; ?></p>
							<!-- /.why-choose-two__text -->
							
								</div><!-- /.why-choose-two__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.why-choose-two -->

		<?php include_once("footer.php"); ?>

</div><!-- /.page-wrapper -->

<?php include_once("mobileheader.php"); ?>

<a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    <span class="scroll-to-top__text">back top</span>
    <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
</a>


<script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/jarallax/jarallax.min.js"></script>
<script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
<script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
<script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
<script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
<script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="assets/vendors/nouislider/nouislider.min.js"></script>
<script src="assets/vendors/tiny-slider/tiny-slider.js"></script>
<script src="assets/vendors/wnumb/wNumb.min.js"></script>
<script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
<script src="assets/vendors/wow/wow.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.min.js"></script>
<script src="assets/vendors/isotope/isotope.js"></script>
<script src="assets/vendors/countdown/countdown.min.js"></script>
<script src="assets/vendors/jquery-circleType/jquery.circleType.js"></script>
<script src="assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
<!-- template js -->
<script src="assets/js/solox.js"></script>
</body>

</html>