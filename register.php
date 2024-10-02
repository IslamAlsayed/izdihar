<?php
$pageTitle = 'Register';
$noNavbar = '';
include 'init.php';

if (isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}
$message = getFlashMessage();
?>

<?php if (!empty($message['message'])) { ?>
<div class="customAlert absolute <?= $message['status'] ?>"><?= $message['message'] ?></div>
<?php } ?>

<section class="authForm register">
    <div class="form-content">
        <div class="image">
            <img src="<?= $image ?>account.png" alt="">
        </div>
        <div class="form">
            <?php if (!empty($message['message'])) { ?>
            <div class="customAlert <?= $message['status'] ?>"><?= $message['message'] ?></div>
            <?php } ?>
            <h3>أهلا بعودتك !</h3>
            <h2>إنشاء حساب جديد</h2>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="group">
                    <input type="text" name="username" id="username" placeholder=" " required />
                    <label for="username">الاسم</label>
                </div>
                <div class="group">
                    <input type="email" class="email" name="email" id="email" placeholder=" " required />
                    <label for="email">البريد الالكتروني</label>
                </div>
                <div class="groups">
                    <div class="group">
                        <input type="password" name="password" id="password" placeholder=" " required />
                        <label for="password">كلمة المرور</label>
                    </div>
                    <div class="group">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required />
                        <label for="password_confirmation">تأكيد كلمة المرور</label>
                    </div>
                </div>
                <div class="group">
                    <select name="currency" id="currency" required>
                        <option value="">العملة</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <div class="group">
                    <button type="submit" disabled name="register" class="btn btn-main">إنشاء</button>
                </div>

                <div class="create_account">
                    <span>لدي حساب بالفعل?</span>
                    <a href="./">تسجيل دخول</a>
                </div>
            </form>
        </div>
    </div>
</section>