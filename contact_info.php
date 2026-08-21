<?php
ob_start();
session_start();
include_once("connect.php");
$msg='';
if(!isset($_SESSION['iconic_salon']))
{
  header("Location:index");
  exit;
}

if(isset($_POST['update_contact_info']))
{
    if(!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        $msg = "Invalid request. Please try again.";
    } elseif(isset($_POST['value']) && is_array($_POST['value'])) {
        $update_stmt = $db->prepare("UPDATE contact_info SET value = :value WHERE c_id = :c_id");

        foreach($_POST['value'] as $c_id => $value) {
            $c_id = filter_var($c_id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if($c_id === false) {
                continue;
            }

            $update_stmt->execute([
                ':value' => sanitize_input($value, 'string', ['forbid_tags' => ['iframe', 'a', 'script']]) ?? '',
                ':c_id' => $c_id
            ]);
        }

        header("Location:contact_info?msg=updated");
        exit;
    }
}

$contact_info_rows = $db->query("SELECT c_id, title, value FROM contact_info ORDER BY c_id ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    <style>
        .contact-info-table textarea {
            min-height: 52px;
            resize: vertical;
        }
        .contact-info-table .readonly-cell {
            font-weight: 600;
            color: var(--solox-black, #1c1a1d);
            vertical-align: middle;
        }
        .contact-info-actions {
            margin-top: 25px;
            text-align: center;
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
                <h2 class="page-header__title">Contact Info</h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->
        <!-- Login Start -->
        <section class="login-page">
            <div class="container">
                <div class="row">
                    <?php if(!empty($msg)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12 wow fadeInUp animated" data-wow-delay="300ms">
                        <div class="login-page__wrap">
                            <h3 class="login-page__wrap__title text-center">Contact Info</h3>
                            <form class="login-page__form" action="contact_info" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php if(isset($_GET['msg']) && $_GET['msg'] === 'updated') { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Contact info updated successfully.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>
                                <table class="table table-bordered table-striped table-responsive contact-info-table">
                                    <thead>
                                        <tr>
                                            <th class="text-n500">S.No.</th>
                                            <th class="text-n500">Title</th>
                                            <th class="text-n500">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(count($contact_info_rows) > 0) {
                                        $j = 1;
                                        foreach($contact_info_rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="readonly-cell"><?php echo $j; $j++; ?></td>
                                            <td class="readonly-cell"><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <textarea class="form-control" name="value[<?php echo (int)$row['c_id']; ?>]"><?php echo htmlspecialchars($row['value'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No contact info found.</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <?php if(count($contact_info_rows) > 0) { ?>
                                    <div class="contact-info-actions">
                                        <button type="submit" class="solox-btn" name="update_contact_info" value="1"><span>Update Contact Info</span></button>
                                    </div>
                                <?php } ?>
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
