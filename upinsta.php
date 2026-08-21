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
if(!isset($_SESSION['iconic_salon']))
{
  header("Location:index");
  exit;
}

$edit_id = get_input('i_id', 'int', null, 'get', ['min' => 1]);
$course = [
    'i_id' => '',
    'insta_link' => '',
    'pic' => ''
];

if($edit_id !== null)
{
    $edit_stmt = $db->prepare("SELECT i_id, insta_link, pic FROM courses WHERE i_id = :i_id");
    $edit_stmt->execute([':i_id' => $edit_id]);
    $edit_course = $edit_stmt->fetch(PDO::FETCH_ASSOC);
    if(!$edit_course)
    {
        header("Location:upinsta?status=failed&msg=Insta Post not found");
        exit;
    }
    $course = $edit_course;
}

if(isset($_POST['save_course']))
{
    if(!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? ''))
    {
        header("Location:upinsta?status=failed&msg=Invalid request");
        exit;
    }

    $is_update = get_input('is_update', 'int', 0, 'post') === 1;
    $i_id = get_input('i_id', 'int', null, 'post', ['min' => 1]);
    $insta_link = get_input('insta_link', 'string', '', 'post', ['max_length' => 255]);
    $old_pic = get_input('old_pic', 'string', '', 'post', ['max_length' => 255]);
    $status = "failed";
    
    if($i_id === null || $insta_link === '')
    {
        $msg = "Please fill all required Post details.";
    }
    else
    {
        $pic = upload_pic_image($_FILES['pic'] ?? null, 'assets/images/instagram', [
            'filename' => 'insta-' . $i_id . '-' . time()
        ]);

        if($pic === '')
        {
            $msg = "Please upload a valid JPG or PNG course image.";
        }
        else
        {
            if($pic === null)
            {
                $pic = $old_pic;
            }

            if(!$is_update && $pic === '')
            {
                $msg = "Post image is required for new course upload.";
            }
            else
            {
                if($is_update)
                {
                    $check_stmt = $db->prepare("SELECT i_id FROM instagram_post WHERE i_id = :i_id");
                    $check_stmt->execute([':i_id' => $i_id]);
                    if(!$check_stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $msg = "Post not found.";
                    }
                    else
                    {
                        $save_stmt = $db->prepare("UPDATE instagram_post SET insta_link = :insta_link,pic = :pic WHERE i_id = :i_id");
                        $save_stmt->execute([
                            ':insta_link' => $insta_link,
                            ':pic' => $pic,
                            ':i_id' => $i_id
                        ]);
                        $status = "success";
                        $msg = "Instagram Post updated successfully.";
                    }
                }
                else
                {
                    $check_stmt = $db->prepare("SELECT i_id FROM instagram_post WHERE i_id = :i_id");
                    $check_stmt->execute([':i_id' => $i_id]);
                    if($check_stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $msg = "Post already exists. Please edit the existing course.";
                    }
                    else
                    {
                        $save_stmt = $db->prepare("INSERT INTO instagram_post (i_id, insta_link, pic) VALUES (:i_id, :insta_link, :pic)");
                        $save_stmt->execute([
                            ':i_id' => $i_id,
                            ':insta_link' => $insta_link,
                            ':pic' => $pic
                        ]);
                        $status = "success";
                        $msg = "Post uploaded successfully.";
                    }
                }
            }
        }
    }

    header("Location:upinsta?status=" . urlencode($status) . "&msg=" . urlencode($msg) . ($is_update && $i_id !== null ? "&i_id=" . $i_id : ""));
    exit;
}
$next_course_id = (int)$db->query("SELECT COALESCE(MAX(i_id), 0) + 1 FROM instagram_post")->fetchColumn();
$course_list = $db->query("SELECT * FROM instagram_post ORDER BY i_id ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/solox.css">
      <style>
        .course-admin-form textarea {
            min-height: 180px;
            resize: vertical;
        }
        .course-admin-form .form-control,
        .course-admin-form textarea {
            width: 100%;
        }
        .course-admin-preview {
            max-width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
        .course-admin-list {
            margin-top: 35px;
        }
        .course-admin-actions a {
            color: var(--solox-base, #c2a74e);
            font-weight: 700;
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
        <?php include_once("header1.php"); ?>


        <section class="page-header">
            <div class="page-header__bg"></div>
            <!-- /.page-header__bg -->
            <div class="container">
                <h2 class="page-header__title">Instagram Post</h2>
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
                            <h3 class="login-page__wrap__title  text-center"><?php echo $edit_id !== null ? 'Update Instagram Post' : 'Upload Instagram Post'; ?></h3>
                            <form class="login-page__form course-admin-form" action="upinsta" method="post" enctype="multipart/form-data">
                                <?php if(isset($_REQUEST['status']) && $_REQUEST['status']!== '') { ?>
                                    <div class="alert <?php if($_REQUEST['status']=='failed') echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show" role="alert">
                                        <?php echo htmlspecialchars($_REQUEST['msg'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="is_update" value="<?php echo $edit_id !== null ? '1' : '0'; ?>">
                                <input type="hidden" name="old_pic" value="<?php echo htmlspecialchars($course['pic'], ENT_QUOTES, 'UTF-8'); ?>">
                                 <input type="hidden" id="i_id" name="i_id" value="<?php echo htmlspecialchars((string)($course['i_id'] !== '' ? $course['i_id'] : $next_course_id), ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="login-page__form-input-box">
                                    <input type="text" required class="form-control" id="insta_link" name="insta_link" placeholder="Instagram Link *" value="<?php echo $course['insta_link']; ?>">
                                </div>
                                <div class="login-page__form-input-box">
                                    <input type="file" class="form-control" id="pic" name="pic" accept=".jpg,.jpeg,.png" <?php echo $edit_id === null ? 'required' : ''; ?>>
                                </div>
                                <?php if($course['pic'] !== '') { ?>
                                    <div class="login-page__form-input-box">
                                        <img src="<?php echo htmlspecialchars($course['pic'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($course['insta_link'], ENT_QUOTES, 'UTF-8'); ?>" class="course-admin-preview">
                                    </div>
                                <?php } ?>
                                <div class="login-page__form-btn-box">
                                    <button type="submit" name="save_course" value="1" class="solox-btn solox-btn--base"><span><?php echo $edit_id !== null ? 'Update' : 'Upload'; ?></span></button>
                                    <?php if($edit_id !== null) { ?>
                                        <a href="upcourse" class="solox-btn"><span>Cancel</span></a>
                                    <?php } ?>
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
