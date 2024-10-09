<?php
$pageTitle = 'إنشاء حساب';
$noNavbar = '';
include './init.php';

if (isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
?>

<section class="authForm register">
    <div class="form-content">
        <div class="image">
            <img src="<?= $image ?>Tablet login-amico.png" alt="">
        </div>
        <div class="form">
            <h3>أهلا بعودتك !</h3>
            <h2>إنشاء حساب جديد</h2>

            <form id="register_form">
                <label class="error_validation"></label>
                <div class="group">
                    <input type="text" name="username" id="username" />
                    <label for="username">الإسم</label>
                </div>
                <div class="group">
                    <input type="email" class="email" name="email" id="email" />
                    <label for="email">البريد الالكتروني</label>
                </div>
                <div class="groups">
                    <div class="group">
                        <input type="password" name="password" id="password" />
                        <label for="password">كلمة المرور</label>
                    </div>
                    <div class="group">
                        <input type="password" name="password_confirmation" id="password_confirmation" />
                        <label for="password_confirmation">تأكيد كلمة المرور</label>
                    </div>
                </div>

                <div class="group">
                    <button type="submit" class="btn btn-main">إنشاء</button>
                </div>
            </form>

            <div class="create_account">
                <span>لدي حساب بالفعل?</span>
                <a href="./">تسجيل دخول</a>
            </div>
        </div>
    </div>
</section>

<script src="<?= $js . 'register.js' ?>"></script>