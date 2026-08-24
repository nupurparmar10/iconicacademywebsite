<?php
	ob_start();
	session_start();
	include_once("connect.php");
    	require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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


            $to  = 'Iconickidssalon@gmail.com'; 
            $mail = new PHPMailer(true);
            try 
            {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'Iconickidssalon@gmail.com';
                $mail->Password = 'nags bfcr obmm okbo';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('Iconickidssalon@gmail.com', 'Enquiry Form');
                $mail->addAddress($to, 'Enquiry Form');

                $mail->isHTML(true);
                $mail->Subject = 'Enquiry Details from website';
                $message = '
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Enquiry Form</title>
                </head>
                <body>
                    <table align="center" style="width:100%; text-align:center;  border-collapse:collapse;" border="1">
                        <tr>
                            <th style="color:#1F356D; font-size:16px; font-weight:bold; text-align:left;">Customer Name</th>
                            <td style="word-wrap:break-word;  white-space:pre-line; text-align:left;">'.$name.'</td>
                        </tr>
                        <tr>
                            <th style="color:#1F356D; font-size:16px; font-weight:bold; text-align:left;">Email</th>
                            <td style="word-wrap:break-word;  white-space:pre-line; text-align:left;">'.$email.'</td>
                        </tr>
                        <tr>
                            <th style="color:#1F356D; font-size:16px; font-weight:bold; text-align:left;">Contact no.</th>
                            <td style="word-wrap:break-word;  white-space:pre-line; text-align:left;">'.$contact.'</td>
                        </tr>
                        <tr>
                            <th style="color:#1F356D; font-size:16px; font-weight:bold; text-align:left;">Course</th>
                            <td style="word-wrap:break-word;  white-space:pre-line; text-align:left;">'.$course.'</td>
                        </tr>
                        <tr>
                            <th style="color:#1F356D; font-size:16px; font-weight:bold; text-align:left;">Message</th>
                            <td style="word-wrap:break-word;  white-space:pre-line; text-align:left;">'.$message.'</td>
                        </tr>
                    </table>
        
                </body>
                </html>
                ';
                $mail->Body = $message;
                $mail->send();
                echo "<script>alert('Thank you. We will get back to you soon!!!.'); </script>";
            } 
            catch (Exception $e) 
            {
                echo "<script>alert('Form saved, but email could not be sent. Error: " . $mail->ErrorInfo . "'); </script>";
                exit;
            }

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
                <h2 class="page-header__title">Enquiry Form</h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->


        <section class="team-form-one background-gray">
            <div class="team-form-one__bg" style="background-image: url(assets/images/shapes/team-one-form-bg-1-1.jpg);"></div>
            <!-- /.team-form-one__bg -->
            <div class="container">
                <div class="sec-title">
                    <img src="assets/images/shapes/sec-title-s-1.png" alt="Contact with me " class="sec-title__img">
                    <h6 class="sec-title__tagline">Contact with us</h6><!-- /.sec-title__tagline -->
                    <h3 class="sec-title__title">Enquire About Our Courses</h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <?php if ($msg !== "") { ?>
                    <div class="alert <?php echo ($msg === "Enquiry submitted successfully.") ? "alert-success" : "alert-warning"; ?>" role="alert">
                        <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <form class="form-one team-form-one__form" action="enquiry" method="post">
                    <div class="form-one__group">
                        <div class="form-one__control ">
                            <input type="text" name="name" placeholder="Your name">
                        </div><!-- /.form-one__control  -->
                        <div class="form-one__control">
                            <input type="email" name="email" placeholder="Email address">
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control">
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
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control">
                             <input type="text" name="contact" placeholder="Enter Contact No.">
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control form-one__control--full">
                            <textarea name="message" placeholder="Write  a message"></textarea><!-- /# -->
                        </div><!-- /.form-one__control -->
                        <div class="form-one__control form-one__control--full text-center">
                            <button type="submit" name="s1"  class="solox-btn solox-btn--base"><span>Send a message</span></button>
                        </div><!-- /.form-one__control -->
                    </div><!-- /.form-one__group -->
                </form>
                <div class="result"></div><!-- /.result -->
            </div><!-- /.container -->
        </section><!-- /.team-form-one -->

        <?php include_once("footer.php"); ?>
        <!-- /.main-footer -->

    </div><!-- /.page-wrapper -->



    <?php include_once("mobileheader.php"); ?>
    <!-- /.search-popup -->

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