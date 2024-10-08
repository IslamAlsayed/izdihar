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
            <h3>أهلا بعودتك!</h3>
            <h2>تسجيل الدخول</h2>

            <form id="signin_form">
                <label class="error_validation"></label>
                <div class="group">
                    <input type="email" class="email" name="email" id="email" />
                    <label for="email">الإيميل</label>
                </div>
                <div class="group">
                    <input type="password" name="password" id="password" />
                    <label for="password">كلمة المرور</label>
                </div>
                <div class="group">
                    <button type="submit" class="btn btn-main">تسجيل الدخول</button>
                </div>
            </form>

            <div class="create_account">
                <span>لا أملك حساب؟</span>
                <a href="./register.php">أنشاء حساب</a>
            </div>
        </div>
    </div>
</section>

<script src="<?= $js . 'signin.js' ?>"></script>