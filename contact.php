<?php
$pageTitle = 'تواصل معنا';
include 'init.php';

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}
?>

<section class="services-content">
    <div class="head">
        <h2 class="headSection">تواصل معنا</h2>
        <h3>نحن قادرون على تمهيد الطريق لنجاح عملك.</h3>
        <p>يرجى إعلامنا إذا كان لديك أي أسئلة، أو تريد ترك تعليق لنا، أو ترغب في معرفة المزيد عنا </p>
        <p>الحل الأمثل لإدارة شؤونك المالية والتخطيط لمستقبلك المالي بكل سهولة واحترافية. هدفنا هو تمكينك من اتخاذ قرارات مالية مدروسة تضمن لك الرخاء المالي في كل مرحلة من مراحل حياتك.</p>
    </div>

    <div class="content">
        <div class="image">
            <img src="<?= $image  . 'mi.jpeg' ?>" alt="">
        </div>
        <div class="form">
            <label class="error_validation"></label>
            <form action="https://formspree.io/f/xknajvka" method="POST">
                <div class="group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" id="email" placeholder=" " required>
                    <label for="email">الإيميل</label>
                </div>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder=" ">
                    <label for="username">الإسم</label>
                </div>
                <div class="group">
                    <i class="fab fa-whatsapp"></i>
                    <input type="text" name="whatsapp" id="whatsapp" placeholder=" ">
                    <label for="whatsapp">رقم الواتساب</label>
                </div>
                <div class="group">
                    <textarea name="message" id="message" placeholder=" " required></textarea>
                    <label for="message">الرسالة</label>
                </div>

                <div class="group">
                    <button type="submit" name="contact" class="btn btn-dark">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <div class="contact-tool">
        <div class="col">
            <span>رقم الواتساب</span>
            <a href="mailto:"><?= $site['phone'] ?></a>
        </div>
        -
        <div class="col">
            <span>البريد الإلكتروني</span>
            <a href="mailto:" class="email"><?= $site['email'] ?></a>
        </div>
    </div>
</section>

<?php include './includes/templates/footer.php'; ?>