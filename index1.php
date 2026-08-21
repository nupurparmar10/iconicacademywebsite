<?php
ob_start();
session_start();
include_once("connect.php");
$msg='';
if(!isset($_SESSION['iconic_salon']))
{
  header("Location:index");
}
if(isset($_REQUEST['e_id']) && ctype_digit($_REQUEST['e_id']) && $_REQUEST['e_id'] > 0)
{
    $e_id = (int)$_REQUEST['e_id'];
    $delete_return_page = get_input('page', 'int', 1, 'get', ['min' => 1]);

    $delete_stmt = $db->prepare("DELETE FROM enquiry WHERE e_id = :e_id");
    $delete_stmt->bindValue(':e_id', $e_id, PDO::PARAM_INT);
    $delete_stmt->execute();

    header("Location:index1?msg=set&page=" . $delete_return_page);
    exit;
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
    <style>
        .enquiry-pagination {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            padding-left: 0;
            list-style: none;
        }
        .enquiry-pagination li + li {
            margin-left: 0;
        }
        .enquiry-pagination a,
        .enquiry-pagination span {
            display: flex;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #eff2f6;
            color: var(--solox-text, #838184);
            font-size: 16px;
            font-weight: 600;
            transition: 500ms ease;
        }
        .enquiry-pagination a:hover,
        .enquiry-pagination .active span {
            background-color: var(--solox-base, #c2a74e);
            color: var(--solox-white, #fff);
        }
        .enquiry-pagination .pagination-nav a {
            background-color: var(--solox-black, #1c1a1d);
            color: var(--solox-white, #fff);
        }
        .enquiry-pagination .disabled span {
            cursor: not-allowed;
            opacity: 0.45;
        }
        @media (min-width: 992px) {
            .enquiry-pagination a,
            .enquiry-pagination span {
                width: 54px;
                height: 54px;
                font-size: 17px;
            }
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
                <h2 class="page-header__title">Enquiry Details</h2>
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
                            <h3 class="login-page__wrap__title text-center">Enquiry Details</h3>
                            <table class="table table-bordered table-striped table-responsive">
                            <?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']!== '') { ?>
                                <div class="alert alert-danger" role="alert">Enquiry deleted successfully!!!!! <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>
                            <?php } ?>
                            <thead>
                                <tr>
                                <th class="text-n500">S.No.</th>
                                <th class="text-n500">Name</th>
                                <th class="text-n500">Email-ID</th>
                                <th class="text-n500">Contact No.</th>
                                <th class="text-n500">Course.</th>
                                <th class="text-n500">Message</th>
                                <th class="text-n500">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $page = get_input('page', 'int', 1, 'get', ['min' => 1]);
                                $limit = 3; // records per page
                                
                                $total_result=$db->query("SELECT COUNT(*) as total FROM enquiry");
                                $total_row = $total_result->fetch(PDO::FETCH_ASSOC);

                                $total_records = (int)$total_row['total'];
                                $total_pages = (int)ceil($total_records / $limit);
                                if($total_pages > 0 && $page > $total_pages) {
                                    $page = $total_pages;
                                }
                                $offset = ($page - 1) * $limit;

                                $j = $offset + 1;

                                $e1=$db->query("select * from enquiry order by e_id desc LIMIT $offset, $limit");
                                while($e=$e1->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                                <tr>
                                <td><?php echo $j; $j++; ?></td>
                                <td><?php echo $e['name']; ?></td>
                                <td><?php echo $e['email']; ?></td>
                                <td><?php echo $e['contact']; ?></td>
                                <td><?php echo $e['course']; ?></td>
                                <td><?php echo $e['message']; ?></td>
                                <td>
                                    <a href="?e_id=<?php echo $e['e_id']; ?>&page=<?php echo $page; ?>"
                                    onclick="return confirm('Are you sure you want to delete this feedback?');"
                                    class="delete-item fs-5"
                                    style="color:red;">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                </tr>
                                <?php
                                }
                                if($total_records === 0) {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">No enquiries found.</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            </table>
                            <?php if($total_pages > 1) { ?>
                                <ul class="post-pagination enquiry-pagination">
                                    <li class="pagination-nav <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                        <?php if($page > 1) { ?>
                                            <a href="?page=<?php echo $page - 1; ?>" aria-label="Previous page"><i class="fa fa-angle-left"></i></a>
                                        <?php } else { ?>
                                            <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                        <?php } ?>
                                    </li>
                                    <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                                        <li class="<?php echo ($i === $page) ? 'active' : ''; ?>">
                                            <?php if($i === $page) { ?>
                                                <span><?php echo $i; ?></span>
                                            <?php } else { ?>
                                                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                    <li class="pagination-nav <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <?php if($page < $total_pages) { ?>
                                            <a href="?page=<?php echo $page + 1; ?>" aria-label="Next page"><i class="fa fa-angle-right"></i></a>
                                        <?php } else { ?>
                                            <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                        <?php } ?>
                                    </li>
                                </ul>
                            <?php } ?>
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
