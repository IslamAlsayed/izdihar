<nav class="navbar">
    <a href="./home.php" class="logo">
        <h2>ازدهــــار</h2>
        <i class="fa-solid fa-chart-area"></i>
    </a>

    <div class="bars" id="bars">
        <i class="fas fa-bars active"></i>
    </div>

    <div class="menu" id="menu">
        <ul>
            <li><a href="./home.php" class="<?= setActive('home') ?>">الرئيسية</a></li>
            <li><a href="./about.php" class="<?= setActive('about') ?>">من نحن</a></li>

            <div class="options dropdown">
                <b>
                    <i class="fas fa-sort-down"></i>
                    الخدمات
                </b>

                <ul class="dropList">
                    <li>
                        <a href="./services.php?page=services" class="<?= setPageActive('services') ?>">
                            <span>حميع الخدمات</span>
                            <i class="fas fa-server"></i>
                        </a>
                    </li>

                    <li>
                        <a href="./services.php?page=education" class="<?= setPageActive('education') ?>">
                            <span>مصادر تعليمية</span>
                            <i class="fas fa-book-open-reader"></i>
                        </a>
                    </li>

                    <li>
                        <a href="./services.php?page=budget" class="<?= setPageActive('budget') ?>">
                            <span>أعداد الميزانية</span>
                            <i class="fas fa-sheet-plastic"></i>
                        </a>
                    </li>

                    <li>
                        <a href="./services.php?page=debts" class="<?= setPageActive('debts') ?>">
                            <span>إدارة الديون</span>
                            <i class="fas fa-list-check"></i>
                        </a>
                    </li>

                    <li>
                        <a href="./services.php?page=plan" class="<?= setPageActive('plan') ?>">
                            <span>خطة التقاعد</span>
                            <i class="fas fa-money-check-dollar"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <li><a href="./contact.php" class="<?= setActive('contact') ?>">التواصل</a></li>
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
</nav>