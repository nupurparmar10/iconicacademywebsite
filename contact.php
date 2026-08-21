<?php
	ob_start();
	session_start();
	include_once("connect.php");
	$msg="";
    if(get_input('s1', 'string', null, 'post') !== null)
	{
		$name = strip_tags(get_input('name', 'string', '', 'post', ['max_length' => 255]));
		$email = strip_tags(get_input('email', 'email', '', 'post'));
		$contact = strip_tags(get_input('contact', 'string', '', 'post', ['max_length' => 255]));
		$message = strip_tags(get_input('message', 'string', '', 'post'));

		if ($name !== '' && $email !== '' && $course !== ''  && $contact !== '' && $message !== '') {
			$stmt = $db->prepare("insert into feedback (name, email,  contact, message) values (:name, :email, :contact, :message)");
			$stmt->execute([
				':name' => $name,
				':email' => $email,
				':contact' => $contact,
				':message' => $message,
			]);
			$msg = "Feedback submitted successfully.";
		} else {
			$msg = "Please fill all fields correctly.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nupur Parmar">
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
                <h2 class="page-header__title">Contact</h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="contact-one pt-60">
            <div class="container">
                <div class="contact-one__inner">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="contact-one__content">
                                <img src="assets/images/shapes/contact-1-s-1.png" alt="" class="contact-one__content__shape-1">
                                <img src="assets/images/shapes/contact-1-s-2.png" alt="" class="contact-one__content__shape-2">
                                <div class="sec-title">
                                    <img src="assets/images/shapes/sec-title-s-1.png" alt="Contact with us" class="sec-title__img">
                                    <h6 class="sec-title__tagline">Contact with us</h6><!-- /.sec-title__tagline -->
                                    <h3 class="sec-title__title">get in touch</h3>
                                </div><!-- /.sec-title -->
                                <p class="contact-one__text">Have questions about our courses or admissions? We'd love to hear from you — reach out and let us guide you toward your beauty career.</p>
                                <ul class="list-unstyled contact-one__info">
                                    <?php
                                    $c=$db->query("Select value from contact_info where c_id='2'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="fas fa-phone-alt"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Have any Question?</p>
                                            <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></h4><!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='1'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="fas fa-envelope"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Write Email </p>
                                            <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="mailto:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></h4>
                                            <!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='8'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="fas fa-map-marker"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Visit Now </p> <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="#"><?php echo $c['value']; ?></a></h4><!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='11'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="fas fa-phone-alt"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Toll Free No.</p>
                                            <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></h4><!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul><!-- /.list-unstyled -->
                            </div><!-- /.contact-one__content -->
                        </div><!-- /.col-xl-7 -->
                        <div class="col-xl-5">
                            <form class="contact-one__form form-one background-base wow fadeInUp" data-wow-duration="1500ms" action="contact" method="post">
                                <div class="contact-one__form__top">
                                    <div class="sec-title">
                                        <h6 class="sec-title__tagline">Contact with us</h6><!-- /.sec-title__tagline -->
                                        <h3 class="sec-title__title">Enquire About Our Courses</h3><!-- /.sec-title__title -->
                                    </div><!-- /.sec-title -->
                                </div><!-- /.contact-one__form__top -->
                                 <?php if ($msg !== "") { ?>
                                <div class="alert <?php echo ($msg === "Feedback submitted successfully.") ? "alert-success" : "alert-warning"; ?>" role="alert">
                                    <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php } ?>
                                <div class="form-one__group">
                                    <div class="form-one__control form-one__control--full">
                                        <input type="text" name="name" placeholder="Your name">
                                    </div><!-- /.form-one__control form-one__control--full -->
                                    <div class="form-one__control form-one__control--full">
                                        <input type="email" name="email" placeholder="Email address">
                                    </div><!-- /.form-one__control form-one__control--full -->
                                    
                                    <div class="form-one__control form-one__control--full">
                                        <input type="text" name="contact" placeholder="Enter Contact No.">
                                    </div><!-- /.form-one__control form-one__control--full -->
                                    <div class="form-one__control form-one__control--full">
                                        <textarea name="message" placeholder="Write  a message"></textarea><!-- /# -->
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control form-one__control--full">
                                        <button type="submit" class="solox-btn" name="s1"><span>Submit</span></button>
                                    </div><!-- /.form-one__control -->
                                </div><!-- /.form-one__group -->
                            </form>
                        </div><!-- /.col-xl-5 -->
                    </div><!-- /.row -->
                </div><!-- /.contact-one__inner -->
            </div><!-- /.container -->
        </section><!-- /.contact-one -->
        <?php
            $c=$db->query("Select value from contact_info where c_id='9'")->fetch(PDO::FETCH_ASSOC);
            if($c['value']!='')
            {
        ?>
        <section class="contact-map">
            <div class="container-fluid">
                <div class="google-map google-map__contact">
                    <iframe  src="<?php echo $c['value']; ?>" class="map__contact" allowfullscreen=""></iframe>
                </div>
                <!-- /.google-map -->
            </div><!-- /.container-fluid -->
        </section><!-- /.contact-map -->
        <?php
            }
        ?>

       <?php include_once("footer.php"); ?><!-- /.main-footer -->

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