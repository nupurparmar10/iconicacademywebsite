<?php
	ob_start();
	session_start();
	include_once("connect.php");
	$msg="";
    if(get_input('c_id', 'int', null, 'post') !== null)
    {
        header("Location:index"); die;
    }
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
    <style>
        .course-list > li {
            margin-bottom: 15px;
        }

        .course-list strong {
            color: #c2a74e;
        }

        .course-list ul {
            margin-top: 8px;
        }

        /* Service details thumbnail: video + image / image-only */
        .service-details__thumbnail {
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            gap: 20px;
            margin-bottom: 25px;
            height: 380px;
        }

        .service-details__video-wrap,
        .service-details__img-wrap {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            border: 3px solid #c2a74e;
            background: #000;
            height: 100%;
        }

        .service-details__video-wrap {
            position: relative;
            flex: 0 0 auto;
            aspect-ratio: 9 / 16;
        }

        .service-details__video-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .service-details__img-wrap {
            position: relative;
            flex: 1 1 auto;
            min-width: 0;
        }

        .service-details__img-wrap img {
            width: 100%;
            height: 100%;
            display: block;
            transition: transform 0.4s ease;
        }

        .service-details__img-wrap:hover img {
            transform: scale(1.04);
        }

        .service-details__img-wrap--full {
            height: 100%;
        }

        @media (max-width: 767px) {
            .service-details__thumbnail {
                flex-wrap: wrap;
                height: auto;
            }

            .service-details__video-wrap {
                width: 100%;
                flex: 1 1 100%;
                aspect-ratio: 9 / 16;
                max-height: 420px;
            }

            .service-details__img-wrap {
                flex: 1 1 100%;
                min-height: 260px;
                height: 260px;
            }
        }
</style>
</head>

<body class="custom-cursor">
    <?php
    $h1=$db->query("select * from courses where c_id='$_REQUEST[c_id]'");
    if(!$h=$h1->fetch(PDO::FETCH_ASSOC))
    {
        header("Location:index"); die;
    }
    ?>
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
                
                <h2 class="page-header__title"><?php echo $h['title']; ?></h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="service-details">
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-md-12 col-lg-4">
                        <div class="service-sidebar">
                            <div class="service-sidebar__single">
                                <h3 class="service-sidebar__title background-base">Courses</h3><!-- /.service-sidebar__title -->
                                <ul class="list-unstyled service-sidebar__nav">
                                    <?php
                                    $l1=$db->query("select * from courses");
                                    while($l=$l1->fetch(PDO::FETCH_ASSOC))
                                    {
                                    ?>
                                    <li><a href="course?c_id=<?php echo $l['c_id']; ?>"><?php echo $l['title']; ?> </a></li>
                                    <?php
                                    }
                                    ?>
                                </ul><!-- /.list-unstyled service-sidebar__nav -->
                            </div><!-- /.service-sidebar__single -->

                            <div class="service-sidebar__single ">
                                <div class="service-sidebar__contact background-base text-center" style="background-image: url(assets/images/shapes/service-contact-bg-1-1.png);">
                                    <div class="service-sidebar__contact__icon">
                                        <i class="icon-phone-call"></i>
                                    </div><!-- /.service-sidebar__contact__icon -->
                                    <h3 class="service-sidebar__contact__title">Turn Your Passion into a Profession</h3><!-- /.service-sidebar__contact__title -->
                                    <?php
                                    $c=$db->query("Select value from contact_info where c_id='2 '")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <p class="service-sidebar__contact__number">
                                        <span>Call anytime</span> <br>
                                        <a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a>
                                    </p><!-- /.service-sidebar__contact__number -->
                                    <?php
                                    }
                                    ?>
                                </div><!-- /.service-sidebar__contact -->
                            </div>

                        </div><!-- /.sidebar -->
                    </div><!-- /.col-md-12 col-lg-4 -->
                    <div class="col-md-12 col-lg-8">
                        <div class="service-details__content">
                            <div class="service-details__thumbnail">
                                <?php if (!empty($h['video'])) { ?>
                                <div class="service-details__video-wrap">
                                    <iframe src="<?php echo $h['video']; ?>" allow="autoplay; encrypted-media" allowfullscreen loading="lazy"></iframe>
                                </div>
                                <div class="service-details__img-wrap" style="width: 100%; height: 380px; overflow: hidden; background: transparent; text-align: center; vertical-align:middle; line-height: 380px;">
                                    <img src="<?php echo $h['pic']; ?>" alt="<?php echo htmlspecialchars($h['title'], ENT_QUOTES, 'UTF-8'); ?>" style="max-width: 100%; max-height: 100%; vertical-align: middle;" >
                                </div>
                                <?php } else { ?>
                                <div class="service-details__img-wrap service-details__img-wrap--full" style="width: 100%; height: 380px; overflow: hidden; background: transparent; text-align: center; vertical-align:middle; line-height: 380px;">
                                    <img src="<?php echo $h['pic']; ?>" alt="<?php echo htmlspecialchars($h['title'], ENT_QUOTES, 'UTF-8'); ?>" style="max-width: 100%; max-height: 100%; vertical-align: middle;" >
                                </div>
                                <?php } ?>
                            </div><!-- /.service-details__thumbnail -->
                            <h3 class="service-details__title"><?php echo $h['title']; ?></h3><!-- /.service-details__title -->
                            <p class="service-details__text"><?php echo $h['desp']; ?></p>
                        </div><!-- /.service-details__content -->
                    </div><!-- /.col-md-12 col-lg-8 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.service-details -->

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