<?php
ob_start();
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', 1);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
include_once("connect.php");
$msg="";
if (get_input('s1', 'string', null, 'request') !== null)
{
  if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) 
  {
    die('Invalid CSRF token');
  }
  $opwd = get_input('opwd', 'string', '', 'post', ['max_length' => 255]);
  $npwd = get_input('npwd', 'string', '', 'post', ['max_length' => 255]);
  $cpwd = get_input('cpwd', 'string', '', 'post', ['max_length' => 255]);

  
  if ($npwd !== $cpwd)
  {
    $msg="New Password and Confirm Password does'nt match!!!";
    $status="failed";
  }
  else
  {
    $uname = $_SESSION['uname'] ?? 'admin';
    $stmt = $db->prepare("select uname, pwd from login where uname = ?");
    $stmt->execute([$uname]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($opwd, $user['pwd']))
    {
      $newPasswordHash = password_hash($npwd, PASSWORD_DEFAULT);
      $update = $db->prepare("update login set pwd = ? where uname = ?");
      $update->execute([$newPasswordHash, $user['uname']]);
      $msg="Password changed Successfully!!!";
      $status="success";
    }
    else
    {
      $msg="Old Password is Incorrect!!!";		
      $status="failed";
    }
  }
  header("Location: changepassword?status=$status&msg=$msg");
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
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    <meta name="description" content="Iconic Hair & Beauty School-Learn Today, Lead Tomorrow">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../css2?family=Alex+Brush&family=Cormorant:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">


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
        <?php include_once("header1.php"); ?>


        <section class="page-header">
            <div class="page-header__bg"></div>
            <!-- /.page-header__bg -->
            <div class="container">
                <h2 class="page-header__title">Change Password</h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->
        <!-- Login Start -->
        <section class="login-page">
            <div class="container">
                <div class="row">
                    <?php if(!empty($msg)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $msg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12 wow fadeInUp animated" data-wow-delay="300ms">
                        <div class="login-page__wrap">
                            <h3 class="login-page__wrap__title  text-center">Change Password</h3>
                            <form class="login-page__form" action="changepassword" method="post">
                                <?php if(isset($_REQUEST['status']) && $_REQUEST['status']!== '') { ?>
                    <div class="alert <?php if($_REQUEST['status']=='failed') echo 'alert-danger'; else echo 'alert-success'; ?> " role="alert"><?php echo $_REQUEST['msg']; ?> <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button></div>
                  <?php } ?>
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="login-page__form-input-box">
                                    <input  type='password' required="" class="form-control"id="opwd" name="opwd" placeholder="Old Password *">
                                </div>
                                <div class="login-page__form-input-box">
                                   <input type='password' required="" class="form-control" id="npwd" name="npwd" placeholder="New Password *" >
                                </div>
                                <div class="login-page__form-input-box">
                                   <input  type='password' required="" class="form-control" id="cpwd" name="cpwd" placeholder="Confirm Password *">
                                </div>
                                <div class="login-page__form-btn-box">
                                    <button type="submit" name="s1" class="solox-btn solox-btn--base"><span>Change Password</span>
                                    </button>
                                </div>
                            </form>
                        </div><!-- login-form -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Login End -->
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