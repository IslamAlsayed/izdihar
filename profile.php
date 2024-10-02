<?php
ob_start();
$pageTitle = 'حسابي الشخصي';
include 'init.php';

$message = ['status' => '', 'message' => ''];

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}

$do = isset($_GET['do']) ? $_GET['do'] : 'index';

$user_id = $_SESSION['user_id'];
$user = selectRows('*', 'users', "id=$user_id", '', '1');
$key = $_GET['page'] ?? '1';
?>

<?php if (!empty($message['message'])) { ?>
<div class="customAlert absolute <?= $message['status'] ?>"><?= $message['message'] ?></div>
<?php } ?>

<?php if ($do == 'index') { ?>

<section class="profile">
    <div class="image">
        <img src="<?= $avatar . 'profile.jpeg' ?>" alt="">
    </div>
    <div class="info">
        <form action="./profile.php?do=update" method="POST">
            <div class="group">
                <input type="text" name="username" value="<?= $user['username'] ?>">
            </div>
            <div class="group">
                <input type="email" name="email" class="email" value="<?= $user['email'] ?>">
            </div>
            <div class="actions">
                <button type="submit" name="update" class="btn">
                    <span>تحديث</span>
                    <i class="fas fa-retweet"></i>
                </button>
                <a href="./contact.php" class="btn">
                    <span>تواصل معنا</span>
                    <i class="fas fa-paper-plane"></i>
                </a>
                <a href="./logout.php" class="btn">
                    <span>تسجيل خروج</span>
                    <i class="fas fa-right-from-bracket"></i>
                </a>
                <button class="btn" id="delete_profile">
                    <span>حذف حسابي</span>
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </form>
    </div>
</section>

<script>
let delete_profile = document.getElementById('delete_profile');
delete_profile.addEventListener('click', (e) => {
    e.preventDefault();
    const result = confirm('هل أنت متأكد أنك تريد حذف حسابك؟');

    if (result) {
        location.href = './profile.php?do=delete';
    }
});
</script>

<?php } elseif ($do == 'update') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $connect;

        if (isset($_POST['update'])) {
            $username = isset($_POST['username']) && !empty($_POST['username']) ? $_POST['username'] : '';
            $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : '';

            $user_id = $_SESSION['user_id'];
            $query = "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                setFlashMessage('success', 'تم التحديث بنجاح.');
            } else {
                setFlashMessage('success', 'لم يتم التحديث بنجاح.');
            }

            header('Location: ./profile.php');
            exit();
        }
    }
} elseif ($do == 'delete') {
    if ($_SESSION['username']) {
        $user_id = $_SESSION['user_id'];

        $query = "DELETE FROM users WHERE id='$user_id'";
        $result = mysqli_query($connect, $query);

        session_unset();
        session_destroy();

        if ($result) {
            setFlashMessage('success', 'تم حذف الحساب بنجاح.');
            header('Location: ./register.php');
            exit();
        } else {
            setFlashMessage('error', 'لم يتم حذف الحساب بنجاح.');
            header('Location: ./profile.php');
            exit();
        }
    }
}