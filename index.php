<?php
$pageTitle = 'Sign in';
$noNavbar = '';
include 'init.php';

if (isset($_SESSION['username'])) {
    header('Location: ./home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signin'])) {
        $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : '';
        $hashPassword = sha1($password);

        $check = "SELECT * FROM `users` WHERE email='$email' AND password='$hashPassword'";
        $result = mysqli_query($connect, $check);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['currency'] = 'SAR';
                setFlashMessage('success', 'تم تسجيل الدخول بنجاح.');
                header('Location: ./home.php');
                exit();
            }
        } else {
            setFlashMessage('error', 'البريد الإلكتروني أو كلمة المرور عير صحيحة!');
        }
    }
}
$message = getFlashMessage();
?>

<section class="authForm signin">
    <div class="form-content">
        <div class="image">
            <img src="<?= $image ?>account.png" alt="">
        </div>
        <div class="form">
            <?php if (!empty($message['message'])) { ?>
                <div class="customAlert <?= $message['status'] ?>"><?= $message['message'] ?></div>
            <?php } ?>

            <h3>أهلا بعودتك!</h3>
            <h2>تسجيل الدخول</h2>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="group">
                    <input type="email" class="email" name="email" id="email" value="admin@gmail.com" placeholder=" " required />
                    <label for="email">الإيميل</label>
                </div>
                <div class="group">
                    <input type="password" name="password" id="password" value="test123" placeholder=" " required />
                    <label for="password">كلمة المرور</label>
                </div>

                <div class="links">
                    <div class="remember_me">
                        <div class="checkbox-wrapper-12">
                            <div class="cbx">
                                <input type="checkbox" name="remember_me" id="remember_me">
                                <label for="cbx-12"></label>
                                <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>

                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <filter id="goo-12">
                                        <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                        <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                        <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                    </filter>
                                </defs>
                            </svg>
                        </div>

                        <label for="remember_me">تذكروني</label>
                    </div>
                    <a href="#" class="forget_password">نسيت كلمة المرور؟</a>
                </div>
                <div class="group">
                    <button type="submit" name="signin" class="btn btn-main">تسجيل الدخول</button>
                </div>

                <div class="create_account">
                    <span>لا أملك حساب؟</span>
                    <a href="./register.php">أنشاء حساب</a>
                </div>
            </form>
        </div>
    </div>
</section>