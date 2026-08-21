<?php
	ob_start();
	session_start();
	include_once("connect.php");
	if(get_input('val', 'string', null, 'request') !== null)
	{
		session_unset();
		$_SESSION['a']="set";
	}
	$msg="";
	if(get_input('s1', 'string', null, 'post') !== null)
	{
		$name = strip_tags(get_input('name', 'string', '', 'post', ['max_length' => 255]));
		$email = strip_tags(get_input('email', 'email', '', 'post'));
		$course = strip_tags(get_input('course', 'string', '', 'post', ['max_length' => 255]));
		$contact = strip_tags(get_input('contact', 'string', '', 'post', ['max_length' => 255]));
		$message = strip_tags(get_input('message', 'string', '', 'post'));

		if ($name !== '' && $email !== '' && $course !== '' && $course !== 'Select Course' && $contact !== '' && $message !== '') {
			$stmt = $db->prepare("insert into enquiry (name, email, course, contact, message) values (:name, :email, :course, :contact, :message)");
			$stmt->execute([
				':name' => $name,
				':email' => $email,
				':course' => $course,
				':contact' => $contact,
				':message' => $message,
			]);
			$msg = "Enquiry submitted successfully.";
		} else {
			$msg = "Please fill all enquiry fields correctly.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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
    .insta-wrapper {
        width: 400px;
        height: 600px;        /* controls how much you see */
        overflow: hidden;     /* hides everything below */
        border-radius: 10px;
    }

    .insta-wrapper iframe {
        margin-top: -10px;    /* adjust to crop top */
        width: 100% !important;
    }
    @media (max-width: 768px) {
    .why-choose-one__list li {
        flex-wrap: wrap;
    }
    .why-choose-one__list li h4 {
        min-width: unset !important;
        max-width: 100% !important;
        width: 100%;
    }
    .why-choose-one__list li div[style*="width: 1px"] {
        display: none;
    }
    .why-choose-one__list li p {
        width: 100%;
    }
}
.certificate-box img{
    width:100%;
    height:auto;
    display:block;
    border-radius:10px;
}

/* Reduce main slider height */
.main-slider-one,
.main-slider-one__bg {
    min-height: 550px !important;   /* adjust this value up/down as needed */
    height: 550px !important;
}
</style>
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

        <!-- main-slider-start -->
        <section class="main-slider-one">
            <div class="main-slider-one__carousel solox-owl__carousel owl-carousel" data-owl-options='{
                "loop": true,
                "animateOut": "fadeOut",
                "animateIn": "fadeIn",
                "items": 1,
                "autoplay": true,
                "autoplayTimeout": 7000,
                "smartSpeed": 1000,
                "nav": true,
                "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
                "dots": true,
                "margin": 0
                }'>
                <?php
                $s1=$db->query("Select * from slider");
                while($s=$s1->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <div class="item">
                    <div class="main-slider-one__item">
                        <div class="main-slider-one__bg" style="background-image: url(<?php echo $s['pic']; ?>);"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <circle class='circle0 steap' cx="50%" cy="55%" r="5.2%"></circle>
                            <circle class='circle1 steap' cx="50%" cy="55%" r="15.6%"></circle>
                            <circle class='circle2 steap' cx="50%" cy="55%" r="26%"></circle>
                            <circle class='circle3 steap' cx="50%" cy="55%" r="36.4%"></circle>
                            <circle class='circle4 steap' cx="50%" cy="55%" r="46.8%"></circle>
                            <circle class='circle5 steap' cx="50%" cy="55%" r="57%"></circle>
                            <circle class='circle6 steap' cx="50%" cy="55%" r="67.7%"></circle>
                            <circle class='circle7 steap' cx="50%" cy="55%" r="78.1%"></circle>
                            <circle class='circle8 steap' cx="50%" cy="55%" r="88.5%"></circle>
                            <circle class='circle9 steap' cx="50%" cy="55%" r="100%"></circle>
                        </svg>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="main-slider-one__content">
                                        <h5 class="main-slider-one__sub-title"><?php echo $s['title']; ?></h5>
                                        <!-- slider-sub-title -->
                                        <h2 class="main-slider-one__title"><?php echo $s['desp']; ?></h2><!-- slider-title -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>
        <!-- main-slider-end -->
        <!-- Feature Start -->
        <section class="feature-one">
            <div class="feature-one__bg" style="background-image: url(assets/images/shapes/feature-bg-1.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <?php
                        $m=$db->query("Select * from matter where m_id='1'")->fetch(PDO::FETCH_ASSOC);
                        if($m['title']!='')
                        {
                            $arr=explode(' ',$m['title']);
                        }
                        ?>
                        <div class="feature-one__item text-center">
                            <div class="feature-one__item__hover-img"><img src="assets/images/shapes/feature-flower.png" ></div>
                            <div class="feature-one__item__img">
                                <img src="<?php echo $m['pic']; ?>">
                                <div class="feature-one__item__icon"><span class="icon-booking"></span></div>
                            </div>
                            <h4 class="feature-one__item__sub-title"><?php echo $arr[0]; ?></h4>
                            <h3 class="feature-one__item__title"><?php echo implode(' ', array_filter([
                                $arr[1] ?? '',
                                $arr[2] ?? '',
                                $arr[3] ?? '',
                                $arr[4] ?? ''
                            ])); ?> </h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 31 4">
                                <g data-name="3 Boxes">
                                    <g data-name="01">
                                        <path class="cls-1" d="M25.752,2.377c-2.7,2.164-5,2.164-7.7,0a3.508,3.508,0,0,0-5.021,0c-2.673,2.143-4.853,2.143-7.526,0-1.779-1.427-2.981-1.427-4.761,0L0.011,1.331c2.163-1.734,3.981-1.8,6.23,0,2.12,1.7,3.685,1.9,6.057,0a4.641,4.641,0,0,1,6.489,0c2.206,1.77,3.937,1.839,6.23,0,2.25-1.8,3.721-1.8,5.97,0L30.254,2.377C28.446,0.927,27.562.927,25.752,2.377Z"></path>
                                    </g>
                                </g>
                            </svg>
                            <p class="feature-one__item__text" style="text-align:justify;"><?php echo $m['desp']; ?></p>
                        </div><!-- feature-item -->
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <?php
                        $m=$db->query("Select * from matter where m_id='2'")->fetch(PDO::FETCH_ASSOC);
                        if($m['title']!='')
                        {
                            $arr=explode(' ',$m['title']);
                        }
                        ?>
                        <div class="feature-one__item feature-one__item--no-border-md text-center">
                            <div class="feature-one__item__hover-img"><img src="assets/images/shapes/feature-flower.png" ></div>
                            <div class="feature-one__item__img">
                                <img src="<?php echo $m['pic']; ?>">
                                <div class="feature-one__item__icon"><span class="icon-group"></span></div>
                            </div>
                            <h4 class="feature-one__item__sub-title"><?php echo $arr[0]; ?></h4>
                            <h3 class="feature-one__item__title"><?php echo $arr[1]; ?> </h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 31 4">
                                <g data-name="3 Boxes">
                                    <g data-name="01">
                                        <path class="cls-1" d="M25.752,2.377c-2.7,2.164-5,2.164-7.7,0a3.508,3.508,0,0,0-5.021,0c-2.673,2.143-4.853,2.143-7.526,0-1.779-1.427-2.981-1.427-4.761,0L0.011,1.331c2.163-1.734,3.981-1.8,6.23,0,2.12,1.7,3.685,1.9,6.057,0a4.641,4.641,0,0,1,6.489,0c2.206,1.77,3.937,1.839,6.23,0,2.25-1.8,3.721-1.8,5.97,0L30.254,2.377C28.446,0.927,27.562.927,25.752,2.377Z"></path>
                                    </g>
                                </g>
                            </svg>
                            <p class="feature-one__item__text" style="text-align:justify;"><?php echo $m['desp']; ?></p>
                        </div><!-- feature-item -->
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <?php
                        $m=$db->query("Select * from matter where m_id='3'")->fetch(PDO::FETCH_ASSOC);
                        if($m['title']!='')
                        {
                            $arr=explode(' ',$m['title']);
                        }
                        ?>
                        <div class="feature-one__item feature-one__item--no-border text-center">
                            <div class="feature-one__item__hover-img"><img src="assets/images/shapes/feature-flower.png" ></div>
                            <div class="feature-one__item__img">
                                <img src="<?php echo $m['pic']; ?>">
                                <div class="feature-one__item__icon"><span class="icon-tag"></span></div>
                            </div>
                            <h4 class="feature-one__item__sub-title"><?php echo $arr[0]; ?></h4>
                            <h3 class="feature-one__item__title"><?php echo $arr[1]; ?> </h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 31 4">
                                <g data-name="3 Boxes">
                                    <g data-name="01">
                                        <path class="cls-1" d="M25.752,2.377c-2.7,2.164-5,2.164-7.7,0a3.508,3.508,0,0,0-5.021,0c-2.673,2.143-4.853,2.143-7.526,0-1.779-1.427-2.981-1.427-4.761,0L0.011,1.331c2.163-1.734,3.981-1.8,6.23,0,2.12,1.7,3.685,1.9,6.057,0a4.641,4.641,0,0,1,6.489,0c2.206,1.77,3.937,1.839,6.23,0,2.25-1.8,3.721-1.8,5.97,0L30.254,2.377C28.446,0.927,27.562.927,25.752,2.377Z"></path>
                                    </g>
                                </g>
                            </svg>
                            <p class="feature-one__item__text" style="text-align:justify;"><?php echo $m['desp']; ?></p>
                        </div><!-- feature-item -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature End -->
        <section class="about-one">
            <?php 
                $m=$db->query("Select * from matter where m_id='4'")->fetch(PDO::FETCH_ASSOC);
                if($m['pic']!='')
                {
                    $pic=explode(';',$m['pic']);
                } 
                else
                {
                    $pic[0]=$pic[1]='';
                }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-one__image wow fadeInLeft" data-wow-delay="300ms">
                            <div class="about-one__double-image">
                                <img src="<?php echo $pic[0]; ?>" style="max-width: 100%; max-height: 477px; vertical-align: middle;">
                                <img src="<?php echo $pic[1]; ?>" style="max-width: 100%; max-height: 100%; vertical-align: middle;">
                            </div>
                            <div class="about-one__flower" style="background-image: url(assets/images/shapes/about-flower.png);"></div>
                            <?php
                            $c=$db->query("Select * from contact_info where c_id='2'")->fetch(PDO::FETCH_ASSOC);
                            if($c['value']!='')
                            {
                            ?>
                            <div class="about-one__image__info wow fadeInUp" data-wow-delay="400ms">
                                <div class="about-one__image__info__icon"><span class="fas fa-phone"></span></div>
                                <h3 class="about-one__image__info__title">Contact Us</h3>
                                <p class="about-one__image__info__text"><a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></p>
                            </div>
                            <?php } ?>
                            <div class="about-one__image__arrow"><img src="assets/images/shapes/about-arrow.png" >
                            </div>
                        </div><!-- /.why-choose-two__image -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="300ms">
                        <div class="about-one__content">
                            <div class="sec-title">

                                <img src="assets/images/shapes/sec-title-s-1.png" alt="Get to know us" class="sec-title__img">


                                <h6 class="sec-title__tagline">Get to know us</h6>

                                <h3 class="sec-title__title"><?php echo $m['title']; ?></h3>
                            </div><!-- /.sec-title -->
                            <ul class="about-one__content__list">
                                <li><span class="icon-stones"></span>Expert Trainers</li>
                                <li><span class="icon-giftbox"></span>Certified Courses</li>
                            </ul>
                            <p class="about-one__content__text-one"><?php echo $m['extra']; ?></p>
                            <p class="about-one__content__text-two"><?php echo $m['desp']; ?></p>
                            <div class="about-one__content__author-wrapper">
                                <a href="about" class="solox-btn solox-btn--base"><span>Discover more</span></a>
                            </div>
                        </div><!-- /.why-choose-two__content -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.about-one -->

        <div class="client-carousel client-carousel-one ">
            <div class="container">
                <div class="client-carousel__one solox-owl__carousel owl-theme owl-carousel" data-owl-options='{
                    "items": 5,
                    "margin": 55,
                    "smartSpeed": 700,
                    "loop":true,
                    "autoplay": 6000,
                    "nav":true,
                    "dots":false,
                    "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                    "responsive":{
                        "0":{
                            "items":1,
                            "margin": 0
                        },
                        "360":{
                            "items":2,
                            "margin": 0
                        },
                        "575":{
                            "items":3,
                            "margin": 30
                        },
                        "768":{
                            "items":3,
                            "margin": 40
                        },
                        "992":{
                            "items": 4,
                            "margin": 40
                        },
                        "1200":{
                            "items": 5
                        }
                    }
                    }'>
                    <?php
                    $b1=$db->query("select * from brands");
                    while($b=$b1->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <div class="client-carousel__one__item" style="width: 100%; height: 71px; overflow: hidden; background: transparent; text-align: center; vertical-align:middle; line-height: 71px;"> 
                        <img src="<?php echo $b['pic']; ?>" style="max-width: 100%; max-height: 100%; vertical-align: middle;">
                    </div>
                    <?php
                    }
                    ?>
                </div><!-- /.thm-owl__slider -->
            </div><!-- /.container -->
        </div><!-- /.client-carousel -->

        <?php
        $b1=$db->query("select * from matter where m_id='5' and desp!=''");
        if($b=$b1->fetch(PDO::FETCH_ASSOC))
        {
        ?>
        <section class="video-two">
            <div class="video-two__bg jarallax" data-jarallax="" data-speed="0.3" data-imgposition="50% -100%" style="background-image: url(assets/images/backgrounds/video-bg-2-1.jpg);"></div>
            <!-- /.video-two__bg -->
            <div class="video-two__shape wow fadeInLeft" style="background-image: url(assets/images/shapes/video-shape-1.png);">
            </div>
            <!-- /.video-two__bg -->
            <div class="container">
                <div class="row">
                    <div class="col-md-9 wow fadeInLeft" data-wow-delay="200ms">
                        <h2 class="video-two__title">Book & Step <br>Into the World of Professional Hair & Beauty </h2>
                        <!-- /.video-two__title -->
                        <a href="" class="solox-btn solox-btn--base"><span>Discover more</span></a>
                    </div>
                    <div class="col-md-3 text-end wow fadeInRight" data-wow-delay="200ms">
                        <div class="video-two__btn">
                            <a href="<?php echo $b['desp']; ?>" class="video-popup">
                                <i class="fa fa-play"></i>
                            </a>
                            <div class="curved-circle">
                                <!-- curved-circle start-->
                                <div class="curved-circle--item" data-circle-text-options='{
                                        "radius": 92,
                                        "forceWidth": true,
                                        "forceHeight": true
                                    }'>
                                    Watch our Academy Video
                                </div>
                            </div><!-- curved-circle end-->
                        </div><!-- /.video-two__btn -->
                    </div>
                </div>
            </div><!-- /.container -->
        </section><!-- /.video-two -->
        <?php
        }
        ?>

        <!-- Service Start -->
        <section class="service-one">
            <div class="service-one__bg" style="background-image: url(assets/images/shapes/service-bg-1.jpg);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-title">
                            <img src="assets/images/shapes/sec-title-s-3.png"  class="sec-title__img">
                            <h6 class="sec-title__tagline">Enroll & Transform Your Future</h6><!-- /.sec-title__tagline -->
                            <h3 class="sec-title__title">Hair & Beauty Education</h3><!-- /.sec-title__title -->
                        </div><!-- /.sec-title -->
                    </div>
                </div>
                <div class="row">
                    <?php
                    $s1=$db->query("select * from courses");
                    while($s=$s1->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="service-one__item text-center" style="background-image: url(assets/images/shapes/service-1-1.png);">
                            <div class="service-one__item__wrapper">
                            <div class="service-one__item__hover" style="background-image: url(<?php echo $s['pic']; ?>);"></div>
                                <div class="service-one__item__icon">
                                    <i class="<?php echo $s['icon']; ?>"></i>
                                </div>
                                <h3 class="service-one__item__title">
                                    <a href="course?c_id=<?php echo $s['c_id']; ?>"><?php echo $s['title']; ?></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- Service End -->
        <section class="testimonials-one testimonials-one--home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center">
                            <img src="assets/images/shapes/sec-title-s-1.png" class="sec-title__img">
                            <h6 class="sec-title__tagline">Our testimonials</h6>
                            <h3 class="sec-title__title">What they say?</h3>
                        </div>
                    </div>
                </div>
                <div class="testimonials-one__carousel solox-owl__carousel solox-owl__carousel--with-shadow solox-owl__carousel--basic-nav owl-carousel" data-owl-options='{
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
                            "768": {
                                "items": 2,
                                "margin": 15
                            },
                            "992": {
                                "items": 3,
                                "margin": 15
                            }
                        }
                    }'>
                    <?php
                    $s1=$db->query("select * from testimonial where status='1' order by t_id desc  ");
                    while($s=$s1->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <div class="item">
                        <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                            <div class="testimonials-card__inner" style="background-image: url(assets/images/shapes/testi-card-bg-1-1.jpg);">
                                <div class="testimonials-card__top">
                                    <div class="testimonials-card__image">
                                        <i class="fas fa-user" style="color: #c2a74e; font-size:52px; margin:10px;"></i>
                                    </div>
                                    <div class="testimonials-card__top__left">
                                        <h3 class="testimonials-card__name"><?php echo $s['name']; ?></h3>
                                    </div>
                                </div>
                                <div class="testimonials-card__content">
                                    <?php echo $s['msg']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div><!-- /.testimonials-one__carousel -->
            </div><!-- /.container -->
        </section><!-- /.testimonials-one -->

        <section class="why-choose-one" style="    background-color: var(--solox-gray, #f9f6f1);">
                <div class="container">
                    <div class="why-choose-one__inner">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="why-choose-one__content">
                                    <div class="sec-title" style="text-align:center;">
                                        <img src="assets/images/shapes/sec-title-s-1.png" alt="Our benefits" class="sec-title__img">
                                        <h6 class="sec-title__tagline">What We Stand For</h6>
                                        <h3 class="sec-title__title">Our Core Principle</h3>
                                    </div>

                                    <ul class="list-unstyled why-choose-one__list">
                                        <?php
                                        $s1 = $db->query("select * from matter where m_id IN (6,7,8,9,10)");
                                        while ($s = $s1->fetch(PDO::FETCH_ASSOC)) {
                                            if ($s['title'] != '' && $s['desp'] != '') {
                                        ?>
                                        <li style="display: flex;align-items: center; gap: 20px; padding: 18px 0;">
                                            <!-- Gold Circle Icon -->
                                            <div style="min-width: 50px; height: 50px; background-color: #c2a74e;border-radius: 50%;display: flex;
                                                align-items: center;justify-content: center;">
                                                <i class="fas fa-check" style="color: white; font-size: 18px;"></i>
                                            </div>

                                            <!-- Title -->
                                            <h4 style="min-width: 280px; max-width: 280px;font-size: 20px;font-weight: 700; letter-spacing: 1px;
                                                text-transform: uppercase; margin: 0; color: #1a1a1a;"><?php echo $s['title']; ?></h4>

                                            <!-- Divider Line -->
                                            <div style=" width: 1px; height: 40px; background-color: #c2a74e;opacity: 0.5; flex-shrink: 0;"></div>

                                            <!-- Description -->
                                            <p style=" margin: 0; color: #666;font-size: 18px; line-height: 1.6;"><?php echo $s['desp']; ?></p>
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="instagram-one">
    <div class="container">
        <h5 class="instagram-one__title"><span>Follow On Instagram</span></h5>

        <div class="instagram-one__carousel solox-owl__carousel owl-carousel owl-theme" data-owl-options='{
            "items": 6,
            "margin": 30,
            "loop": false,
            "smartSpeed": 700,
            "nav": false,
            "dots": false,
            "autoplay": true,
            "responsive": {
                "0": {"items": 1},
                "360": {"margin": 10,"items": 1},
                "576": {"items": 3},
                "992": {"items": 3},
                "1200": {"items": 3},
                "1400": {"items": 3}
            }
        }'>

            <?php
            $s1 = $db->query("SELECT * FROM instagram_post ORDER BY i_id DESC");
            while($s = $s1->fetch(PDO::FETCH_ASSOC))
            {
            ?>
                <div class="item">
                    <div class="insta-wrapper" style="width: 100%; height: 450px; overflow: hidden; background: transparent; text-align: center; vertical-align:middle; line-height: 450px;">
                        <a href="<?php echo $s['insta_link']; ?>" target="_blank">
                            <img src="<?php echo $s['pic']; ?>" class="img-fluid" style="max-width: 100%; max-height: 100%; vertical-align: middle;">
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>




        <section class="contact">
            <div class="contact__bg jarallax" data-jarallax="" data-speed="0.3" data-imgposition="50% -100%" style="background-image: url(assets/images/backgrounds/contact-bg-1.jpg);"></div>
            <!-- /.contact__bg -->
            <div class="contact__shape wow fadeInRight" style="background-image: url(assets/images/shapes/contact-shape-1.png);"></div>
            <!-- /.contact__shape -->
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-5"></div>
                    <div class="col-xl-6 col-lg-7 wow slideInRight">
                        <form action="index" method="post">
                            <div class="sec-title">
                                <img src="assets/images/shapes/sec-title-s-1.png" alt="Contact with us" class="sec-title__img">
                                <h6 class="sec-title__tagline">Contact with us</h6><!-- /.sec-title__tagline -->
                                <h3 class="sec-title__title">Enquire About Our Courses</h3><!-- /.sec-title__title -->
                            </div><!-- /.sec-title -->
                            <?php if ($msg !== "") { ?>
                            <div class="alert <?php echo ($msg === "Enquiry submitted successfully.") ? "alert-success" : "alert-warning"; ?>" role="alert">
                                <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact__input-box">
                                        <input type="text" placeholder="Your name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact__input-box">
                                        <input type="email" placeholder="Email address" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact__input-box">
                                        <select class="selectpicker" name="course" aria-label="Default select example">
                                            <option selected="">Select Course</option>
                                            <?php
                                            $s1=$db->query("select * from courses ");
                                            while($s=$s1->fetch(PDO::FETCH_ASSOC))
                                            {
                                            ?>
                                            <option value="<?php echo $s['title']; ?>"><?php echo $s['title']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact__input-box">
                                        <input type="text" name="contact" placeholder="Enter Contact No.">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact__input-box text-message-box">
                                        <textarea name="message" placeholder="Write a message"></textarea>
                                    </div>
                                    <div class="contact__btn-box">
                                        <button type="submit" name="s1" class="solox-btn solox-btn--base"><span>Submit</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container -->
        </section><!-- /.contact -->

        <div class="offer-one">
            <div class="container">
                <div class="row gutter-y-30">

                    <div class="col-md-12 col-lg-6">
                        <div class="certificate-box" style="width: 100%;  height: 300px; overflow: hidden; background: #fff; text-align: center; vertical-align:middle; line-height: 275px; border: 5px solid #c2a74e; padding:5%;">
                            <img src="assets/images/matter/cert.jpeg" alt="Certificate" class="img-fluid w-100" style="max-width: 100%;   max-height: 100%;  vertical-align: middle;">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <div class="certificate-box" style="width: 100%;  height: 300px; overflow: hidden; background: #fff; text-align: center; vertical-align:middle; line-height: 275px; border: 5px solid #c2a74e; padding:10%;">
                            <img src="assets/images/matter/cert1.jpeg" alt="Certificate" class="img-fluid w-100" style="max-width: 100%;   max-height: 100%;  vertical-align: middle;">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <?php
            $c=$db->query("Select value from contact_info where c_id='7'")->fetch(PDO::FETCH_ASSOC);
            if($c['value']!='')
            {
        ?>
        <section class="opening">
            <div class="container-fluid">
                <div class="opening__wrapper">
                    <div class="row">
                        <div class="col-lg-2 col-md-6">
                            <div class="opening__icon"><span class="icon-alarm-clock"></span></div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <h4 class="opening__title">Opening hours</h4>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="opening__info"><span class="opening__info__text"><?php echo $c['value']; ?></span></div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container -->
        </section><!-- /.opening -->

        <?php
            }
            $c=$db->query("Select value from contact_info where c_id='9'")->fetch(PDO::FETCH_ASSOC);
            if($c['value']!='')
            {
        ?>
        <section class="contact-map" style="    margin-top: 1%;">
            <div class="container-fluid">
                <div class="google-map google-map__contact">
                    <iframe src="<?php echo $c['value']; ?>" class="map__contact" allowfullscreen=""></iframe>
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


    
    <script async src="//www.instagram.com/embed.js"></script>
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