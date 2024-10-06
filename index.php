<?php
$pageTitle  = 'تسجيل الدخول';
$noNavbar = '';
include 'init.php';

if (isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
?>

<section class="authForm signin">
    <div class="form-content">
        <div class="image">
            <img src="<?= $image ?>Tablet login-bro.png" alt="">
        </div>
        <div class="form">
            <?php if (!empty($message['message'])) { ?>
            <div class="customAlert <?= $message['status'] ?>"><?= $message['message'] ?></div>
            <?php } ?>

            <label class="error_validation"></label>

            <h3>أهلا بعودتك!</h3>
            <h2>تسجيل الدخول</h2>

            <form id="signin_user">
                <div class="group">
                    <input type="email" class="email" name="email" id="email" value="admin@gmail.com" placeholder=" " required />
                    <label for="email">الإيميل</label>
                </div>
                <div class="group">
                    <input type="password" name="password" id="password" value="123456" placeholder=" " required />
                    <label for="password">كلمة المرور</label>
                </div>
                <div class="group">
                    <button type="submit" name="signin" id="signin" class="btn btn-main">تسجيل الدخول</button>
                </div>

                <div class="create_account">
                    <span>لا أملك حساب؟</span>
                    <a href="./register.php">أنشاء حساب</a>
                </div>
            </form>
        </div>
    </div>
</section>