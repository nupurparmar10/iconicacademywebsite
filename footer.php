<footer class="main-footer background-black">
            <div class="main-footer__bg background-black" style="background-image: url(assets/images/shapes/footer-bg-1-1.png);"></div>
            <!-- /.main-footer__bg -->
            <div class="main-footer__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="footer-widget footer-widget--about text-center" >
                                <a href="index" class="footer-widget__logo">
                                    <img src="assets/images/logo-light.png" width="155" style="min-width: 282px; min-height: 120px;">
                                </a>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-2">
                            <div class="footer-widget footer-widget--links">
                                <h2 class="footer-widget__title">Links</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="about">About</a></li>
                                    <li><a href="allcourses">Courses</a></li>
                                    <li><a href="faq">FAQ   </a></li>
                                    <li><a href="contact">Contact</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-3">
                            <div class="footer-widget footer-widget--contact">
                                <h2 class="footer-widget__title">Contact</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__info">
                                    <?php
                                    $c=$db->query("Select value from contact_info where c_id='1'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li>Email-ID : <a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='2'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li>Contact No. : <a href="mailto:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a></li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='8'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li>Address : <a href="#"><?php echo $c['value']; ?></a></li>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='11'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <li>Toll Free No. : <a href="#"><?php echo $c['value']; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul><!-- /.list-unstyled -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-3">
                            <div class="footer-widget footer-widget--time">
                                <?php
                                    $c=$db->query("Select value from contact_info where c_id='7'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                ?>
                                <h2 class="footer-widget__title">Timing</h2>
                                <p class="footer-widget__text"><?php echo $c['value']; ?></p>
                                <?php
                                    }
                                ?>
                                <!-- /.footer-widget__text -->
                                <div class="footer-widget__social">
                                    <?php
                                    $c=$db->query("Select value from contact_info where c_id='3'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <a href="<?php echo $c['value']; ?>">
                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='4'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <a href="<?php echo $c['value']; ?>">
                                        <i class="fab fa-facebook" aria-hidden="true"></i>
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='5'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <a href="<?php echo $c['value']; ?>">
                                        <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                        <span class="sr-only">Pinterest</span>
                                    </a>
                                    <?php
                                    }
                                    $c=$db->query("Select value from contact_info where c_id='6'")->fetch(PDO::FETCH_ASSOC);
                                    if($c['value']!='')
                                    {
                                    ?>
                                    <a href="<?php echo $c['value']; ?>">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                        <span class="sr-only">Instagram</span>
                                    </a>
                                    <?php
                                    }
                                    ?>
                                </div><!-- /.footer-widget__social -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-footer__top -->
            <div class="main-footer__bottom">
                <div class="container">
                    <div class="main-footer__bottom__inner">
                        <p class="main-footer__copyright">
                            &copy; Copyright <?php echo htmlspecialchars(date("Y"), ENT_QUOTES, 'UTF-8'); ?> Iconic Hair & Beauty School | All Rights Reserved.  Developed By <a href="http://www.technoknitters.com" target='_blank' style="font-weight:bold;" >Technoknitters</a>
                        </p>
                    </div><!-- /.main-footer__inner -->
                </div><!-- /.container -->
            </div><!-- /.main-footer__bottom -->
        </footer>
        <?php
        $c=$db->query("Select value from contact_info where c_id='10'")->fetch(PDO::FETCH_ASSOC);
        if($c['value']!='')
        {
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=<?php echo $c['value']; ?>&text=Hello, how can we help you?" style="position:fixed;width:60px;height:60px;	bottom:40px;left:40px;	background-color:#25d366;color:white;border-radius:50px;text-align:center; font-size:30px;box-shadow: 2px 2px 3px #999;  z-index:100;" target="_blank">
        <i class="fa fa-whatsapp" style="color:white;margin-top:16px;" ></i>
        </a>
        <?php } ?>