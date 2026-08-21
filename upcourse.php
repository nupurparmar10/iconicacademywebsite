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

$edit_id = get_input('c_id', 'int', null, 'get', ['min' => 1]);
$course = [
    'c_id' => '',
    'title' => '',
    'duration' => '',
    'desp' => '',
    'pic' => '',
    'icon' => ''
];

if($edit_id !== null)
{
    $edit_stmt = $db->prepare("SELECT c_id, title, duration, desp, pic, icon FROM courses WHERE c_id = :c_id");
    $edit_stmt->execute([':c_id' => $edit_id]);
    $edit_course = $edit_stmt->fetch(PDO::FETCH_ASSOC);
    if(!$edit_course)
    {
        header("Location:upcourse?status=failed&msg=Course not found");
        exit;
    }
    $course = $edit_course;
}

if(isset($_POST['save_course']))
{
    if(!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? ''))
    {
        header("Location:upcourse?status=failed&msg=Invalid request");
        exit;
    }

    $is_update = get_input('is_update', 'int', 0, 'post') === 1;
    $c_id = get_input('c_id', 'int', null, 'post', ['min' => 1]);
    $title = get_input('title', 'string', '', 'post', ['max_length' => 255]);
    $duration = get_input('duration', 'string', '', 'post', ['max_length' => 255]);
    $desp = sanitize_input($_POST['desp'] ?? '', 'string', ['forbid_tags' => ['iframe']]) ?? '';
    $icon = get_input('icon', 'string', '', 'post', ['max_length' => 255]);
    $old_pic = get_input('old_pic', 'string', '', 'post', ['max_length' => 255]);
    $status = "failed";

    if($c_id === null || $title === '' || $duration === '' || $desp === '' || $icon === '')
    {
        $msg = "Please fill all required course details.";
    }
    else
    {
        $pic = upload_pic_image($_FILES['pic'] ?? null, 'assets/images/courses', [
            'filename' => 'course-' . $c_id . '-' . time()
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
                $msg = "Course image is required for new course upload.";
            }
            else
            {
                if($is_update)
                {
                    $check_stmt = $db->prepare("SELECT c_id FROM courses WHERE c_id = :c_id");
                    $check_stmt->execute([':c_id' => $c_id]);
                    if(!$check_stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $msg = "Course not found.";
                    }
                    else
                    {
                        $save_stmt = $db->prepare("UPDATE courses SET title = :title, duration = :duration, desp = :desp, pic = :pic, icon = :icon WHERE c_id = :c_id");
                        $save_stmt->execute([
                            ':title' => $title,
                            ':duration' => $duration,
                            ':desp' => $desp,
                            ':pic' => $pic,
                            ':icon' => $icon,
                            ':c_id' => $c_id
                        ]);
                        $status = "success";
                        $msg = "Course updated successfully.";
                    }
                }
                else
                {
                    $check_stmt = $db->prepare("SELECT c_id FROM courses WHERE c_id = :c_id");
                    $check_stmt->execute([':c_id' => $c_id]);
                    if($check_stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $msg = "Course already exists. Please edit the existing course.";
                    }
                    else
                    {
                        $save_stmt = $db->prepare("INSERT INTO courses (c_id, title, duration, desp, pic, icon) VALUES (:c_id, :title, :duration, :desp, :pic, :icon)");
                        $save_stmt->execute([
                            ':c_id' => $c_id,
                            ':title' => $title,
                            ':duration' => $duration,
                            ':desp' => $desp,
                            ':pic' => $pic,
                            ':icon' => $icon
                        ]);
                        $status = "success";
                        $msg = "Course uploaded successfully.";
                    }
                }
            }
        }
    }

    header("Location:upcourse?status=" . urlencode($status) . "&msg=" . urlencode($msg) . ($is_update && $c_id !== null ? "&c_id=" . $c_id : ""));
    exit;
}

$next_course_id = (int)$db->query("SELECT COALESCE(MAX(c_id), 0) + 1 FROM courses")->fetchColumn();
$course_list = $db->query("SELECT c_id, title, duration, pic, icon FROM courses ORDER BY c_id ASC")->fetchAll(PDO::FETCH_ASSOC);
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
                <h2 class="page-header__title">Courses</h2>
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
                            <h3 class="login-page__wrap__title  text-center"><?php echo $edit_id !== null ? 'Update Course' : 'Upload Course'; ?></h3>
                            <form class="login-page__form course-admin-form" action="upcourse" method="post" enctype="multipart/form-data">
                                <?php if(isset($_REQUEST['status']) && $_REQUEST['status']!== '') { ?>
                                    <div class="alert <?php if($_REQUEST['status']=='failed') echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show" role="alert">
                                        <?php echo htmlspecialchars($_REQUEST['msg'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="is_update" value="<?php echo $edit_id !== null ? '1' : '0'; ?>">
                                <input type="hidden" name="old_pic" value="<?php echo htmlspecialchars($course['pic'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" id="c_id" name="c_id" value="<?php echo htmlspecialchars((string)($course['c_id'] !== '' ? $course['c_id'] : $next_course_id), ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="login-page__form-input-box">
                                    <input type="text" required class="form-control" id="title" name="title" placeholder="Course Title *" value="<?php echo htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <div class="login-page__form-input-box">
                                    <input type="text" required class="form-control" id="duration" name="duration" placeholder="Duration *" value="<?php echo htmlspecialchars($course['duration'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <div class="login-page__form-input-box">
                                    <div id="quill-editor" style="height:300px;">
                                        <?php echo $course['desp']; ?>
                                    </div>

                                    <input type="hidden" name="desp" id="desp">
                                </div>
                                <div class="login-page__form-input-box">
                                    <input type="file" class="form-control" id="pic" name="pic" accept=".jpg,.jpeg,.png" <?php echo $edit_id === null ? 'required' : ''; ?>>
                                </div>
                                <?php if($course['pic'] !== '') { ?>
                                    <div class="login-page__form-input-box">
                                        <img src="<?php echo htmlspecialchars($course['pic'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8'); ?>" class="course-admin-preview">
                                    </div>
                                <?php } ?>
                                <div class="login-page__form-input-box">
                                    <input type="text" required class="form-control" id="icon" name="icon" placeholder="Icon Class *" value="<?php echo htmlspecialchars($course['icon'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Enter course description...',
    modules: {
        toolbar: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link'],
            ['clean']
        ]
    }
});

document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('desp').value = quill.root.innerHTML;
});
</script>
</body>

</html>
