<div class="topbar-one">
            <div class="container-fluid">
                <div class="topbar-one__inner">
                    <ul class="list-unstyled topbar-one__info">
                        <?php
                        $c=$db->query("Select value from contact_info where c_id='1'")->fetch(PDO::FETCH_ASSOC);
                        if($c['value']!='')
                        {
                        ?>
                        <li class="topbar-one__info__item">
                            <i class="fas fa-envelope topbar-one__info__icon"></i>
                            <a href="mailto:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a>
                        </li>
                        <?php
                        }
                        $c=$db->query("Select value from contact_info where c_id='2'")->fetch(PDO::FETCH_ASSOC);
                        if($c['value']!='')
                        {
                        ?>
                        <li class="topbar-one__info__item">
                            <i class="fas fa-phone topbar-one__info__icon"></i>
                            <a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a>
                        </li>
                        <?php
                        }
                        $c=$db->query("Select value from contact_info where c_id='11'")->fetch(PDO::FETCH_ASSOC);
                        if($c['value']!='')
                        {
                        ?>
                        <li class="topbar-one__info__item">
                            <i class="fas fa-phone topbar-one__info__icon"></i>
                            <a href="tel:<?php echo $c['value']; ?>">Toll Free No. - <?php echo $c['value']; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul><!-- /.list-unstyled topbar-one__info -->
                    <div class="topbar-one__right">
                        <?php
                            $c=$db->query("Select value from contact_info where c_id='7'")->fetch(PDO::FETCH_ASSOC);
                            if($c['value']!='')
                            {
                        ?>
                        <p class="topbar-one__text"><?php echo $c['value']; ?></p><!-- /.topbar-one__text -->
                        <?php
                            }
                        ?>
                        <div class="topbar-one__social">
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
                        </div><!-- /.topbar-one__social -->
                    </div><!-- /.topbar-one__right -->
                </div><!-- /.topbar-one__inner -->
            </div><!-- /.container-fluid -->
        </div><!-- /.topbar-one -->


        <header class="main-header sticky-header sticky-header--normal">
            <div class="container-fluid">
                <div class="main-header__inner">
                    <div class="main-header__logo">
                        <a href="index">
                            <img src="assets/images/logo-dark.png" alt="Solox HTML" width="156">
                        </a>
                    </div><!-- /.main-header__logo -->

                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">
                            <li class="dropdown">
                                <a href="">Our Courses</a>
                                <ul>
                                    <li><a href="upcourse">Upload Course</a></li>
                                    <li><a href="delcourse">Update Course</a></li>
                                </ul>
                            </li>    
                            <li class="dropdown">
                                <a href="">Instagram Post</a>
                                <ul>
                                    <li><a href="upinsta">Upload Post</a></li>
                                    <li><a href="delinsta">Update Post</a></li>
                                </ul>
                            </li>                         
                            <li><a href="index1">Enquiry Form</a></li>
                            <li><a href="contact_info">Contact Info</a></li>
                            <li><a href="changepassword">Change Password</a></li>
                            <li><a href="index?val=set">Logout</a></li>
                        </ul>
                    </nav><!-- /.main-header__nav -->
                    <div class="main-header__right">
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- /.mobile-nav__toggler -->
                        <!-- /.thm-btn main-header__btn -->
                    </div><!-- /.main-header__right -->
                </div><!-- /.main-header__inner -->
            </div><!-- /.container-fluid -->
        </header><!-- /.main-header -->
