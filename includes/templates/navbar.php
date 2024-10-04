<nav class="navbar">
    <a href="./home.php" class="logo">
        <img src="<?= $logo ?>logo.jpeg" alt="">
    </a>

    <div class="bars" id="bars">
        <i class="fas fa-bars active"></i>
    </div>

    <div class="menu" id="menu">
        <ul>
            <li><a href="./home.php" class="<?= setActive('home') ?>">الرئيسية</a></li>
            <li><a href="./about.php" class="<?= setActive('about') ?>">من نحن</a></li>
            <li><a href="./contact.php" class="<?= setActive('contact') ?>">تواصل</a></li>
            <li><a href="./services.php" class="<?= setActive('services') ?>">خدمات</a></li>

            <div class="options dropdown">
                <i class="fas fa-caret-down"></i>
                <ul class="dropList">
                    <li>
                        <a href="./services.php?page=services" class="<?= setPageActive('services') ?>">
                            <span>خدمات</span>
                            <i class="fas fa-server"></i>
                        </a>
                    </li>
                    <li>
                        <a href="./services.php?page=offers" class="<?= setPageActive('offers') ?>">
                            <span>عروض الاستثمار</span>
                            <i class="fas fa-hand-holding-dollar"></i>
                        </a>
                    </li>
                    <li>
                        <a href="./services.php?page=education" class="<?= setPageActive('education') ?>">
                            <span>التعليم والتوجية</span>
                            <i class="fas fa-book-open-reader"></i>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['plan_details']) && $_SESSION['plan_details'] == 'yes') { ?>
                        <li>
                            <a href="./services.php?page=plan_details" class="<?= setPageActive('plan_details') ?>">
                                <span>تفاصيل خطة التقاعد</span>
                                <i class="fas fa-map"></i>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="./services.php?page=plan" class="<?= setPageActive('plan') ?>">
                                <span>خطة التقاعد</span>
                                <i class="fas fa-map"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="./services.php?page=debts_details" class="<?= setPageActive('debts_details') ?>">
                            <span>إدارة الديون</span>
                            <i class="fas fa-list-check"></i>
                        </a>
                    </li>
                    <li>
                        <a href="./services.php?page=budget" class="<?= setPageActive('budget') ?>">
                            <span>تفاصيل الميزانية</span>
                            <i class="fas fa-money-check-dollar"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="user dropdown">
                <i class="fas fa-user"></i>

                <ul class="dropList">
                    <li>
                        <a href="./profile.php" class="<?= setActive('profile') ?>">
                            <span>حسابي</span>
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="disabled">
                            <span>الأعدادات</span>
                            <i class="fas fa-gear"></i>
                        </a>
                    </li>
                    <li>
                        <a href="./logout.php">
                            <span>تسجيل الخروج</span>
                            <i class="fas fa-arrow-right-from-bracket fa-rotate-180"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</nav>