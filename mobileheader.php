<div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index" aria-label="logo image"><img src="assets/images/logo-light.png" width="155" alt=""></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <?php
                $c=$db->query("Select value from contact_info where c_id='1'")->fetch(PDO::FETCH_ASSOC);
                if($c['value']!='')
                {
                ?>
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a>
                </li>
                <?php
                }
                $c=$db->query("Select value from contact_info where c_id='2'")->fetch(PDO::FETCH_ASSOC);
                if($c['value']!='')
                {
                ?>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:<?php echo $c['value']; ?>"><?php echo $c['value']; ?></a>
                </li>
                <?php
                }
                ?>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__social">
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
            </div><!-- /.mobile-nav__social -->
        </div>
        <!-- /.mobile-nav__content -->
    </div>