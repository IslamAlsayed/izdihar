<?php
$pageTitle = 'إنشاء حساب';
include './init.php';

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
            <img src="<?= $image ?>one.jpeg" alt="">
        </div>
        <div class="form">
            <?php if (!empty($message['message'])) { ?>
            <div class="customAlert <?= $message['status'] ?>"><?= $message['message'] ?></div>
            <?php } ?>
            <h3>أهلا بعودتك !</h3>
            <h2>إنشاء حساب جديد</h2>

            <label class="error_validation"></label>
            <form id="register_user">
                <div class="group">
                    <input type="text" name="username" id="username" placeholder=" " />
                    <label for="username">الاسم</label>
                </div>
                <div class="group">
                    <input type="email" class="email" name="email" id="email" placeholder=" " />
                    <label for="email">البريد الالكتروني</label>
                </div>
                <div class="groups">
                    <div class="group">
                        <input type="password" name="password" id="password" placeholder=" " />
                        <label for="password">كلمة المرور</label>
                    </div>
                    <div class="group">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " />
                        <label for="password_confirmation">تأكيد كلمة المرور</label>
                    </div>
                </div>
                <div class="group">
                    <select name="currency" id="currency">
                        <option value="">العملة</option>
                        <option value="egp">egp</option>
                        <option value="sar">sar</option>
                    </select>
                </div>

                <div class="group">
                    <button type="submit" id="register" class="btn btn-main">إنشاء</button>
                </div>

                <div class="create_account">
                    <span>لدي حساب بالفعل?</span>
                    <a href="./">تسجيل دخول</a>
                </div>
            </form>
        </div>
    </div>
</section>