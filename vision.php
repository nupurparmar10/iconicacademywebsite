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
                
                <h2 class="page-header__title">Vision & Mission</h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="service-page">
            <div class="container">
                <div class="service-card-two__carousel solox-owl__carousel solox-owl__carousel--with-shadow solox-owl__carousel--basic-nav owl-carousel" data-owl-options='{
                        "items": 1,
                        "margin": 0,
                        "loop": false,
                        "smartSpeed": 700,
                        "nav": true,
                        "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                        "dots": false,
                        "autoplay": false,
                        "responsive": {
                            "0": {
                                "items": 1
                            },
                            "576": {
                                "items": 2,
                                "margin": 30
                            },
                            "992": {
                                "items":2,
                                "margin": 30
                            }
                        }
                    }'>
                    <?php
                        $c=$db->query("Select * from matter where m_id='16'")->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="item">
                        <div class="service-card-two wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms" style="background-image: url(assets/images/shapes/service-card-two-bg-1.png);">
                            <div class="service-card-two__image">
                                <img src="<?php echo $c['pic']; ?>" alt="Sauna relax">
                            </div><!-- /.service-card-two__image -->
                            <div class="service-card-two__content">

                                <h3 class="service-card-two__title">
                                    <a href="#">Our Vision</a>
                                </h3><!-- /.service-card-two__title -->
                                <p class="service-card-two__text"><?php echo $c['desp']; ?></p><!-- /.service-card-two__text -->
                            </div><!-- /.service-card-two__content -->
                        </div><!-- /.service-card-two -->
                    </div><!-- /.item -->
                    <?php
                        $c=$db->query("Select * from matter where m_id='17'")->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="item">
                        <div class="service-card-two wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms" style="background-image: url(assets/images/shapes/service-card-two-bg-1.png);">
                            <div class="service-card-two__image">
                                <img src="<?php echo $c['pic']; ?>" alt="Sauna relax">
                            </div><!-- /.service-card-two__image -->
                            <div class="service-card-two__content">

                                <h3 class="service-card-two__title">
                                    <a href="#">Our Mission</a>
                                </h3><!-- /.service-card-two__title -->
                                <p class="service-card-two__text"><?php echo $c['desp']; ?></p><!-- /.service-card-two__text -->
                            </div><!-- /.service-card-two__content -->
                        </div><!-- /.service-card-two -->
                    </div><!-- /.item -->

                    
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.service-page -->

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