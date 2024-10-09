</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <p>روابط مهمة</p>

                <ul>
                    <li><a href="./home.php">الرئيسية</a></li>
                    <li><a href="./about.php">من نحن</a></li>
                    <li><a href="./services.php?page=privacy">الخصوصية</a></li>
                    <li><a href="./services.php?page=conditions">الشروط والأحكام</a></li>
                </ul>
            </div>

            <div class="col">
                <p>مساعدة</p>
                <ul>
                    <li>
                        <a href="mailto:<?= $site['email'] ?>">
                            <i class="far fa-envelope"></i>
                            <span class="email"><?= $site['email'] ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="./contact.php">
                            <i class="far fa-comments"></i>
                            <span>تواصل معنا</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="image">
            <img src="<?= $image . 'Mention-bro.png' ?>" alt="">
        </div>
    </div>
</footer>
</body>

</html>