<?php
$pageTitle = 'حسابي الشخصي';
include 'init.php';

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit();
}

$message = ['status' => '', 'message' => ''];

$do = isset($_GET['do']) ? $_GET['do'] : 'index';

$user_id = $_SESSION['user_id'];
$user = selectRows('*', 'users', "id=$user_id", '', '1');
?>

<?php if (!empty($message['message'])) { ?>
<div class="customAlert absolute <?= $message['status'] ?>"><?= $message['message'] ?></div>
<?php } ?>

<?php if ($do == 'index') { ?>

<section class="profile">
    <div class="image">
        <img src="<?= $upload . $user['image'] ?>" alt="">
    </div>
    <div class="info">
        <form id="profile_form" action="./profile.php?do=update" method="POST" enctype="multipart/form-data">
            <div class="group">
                <input type="text" name="username" value="<?= $user['username'] ?>">
            </div>
            <div class="group">
                <input type="email" name="email" value="<?= $user['email'] ?>">
            </div>
            <div class="group">
                <label for="image">رفع صورة <i class="fas fa-upload"></i></label>
                <input type="file" name="image" id="image">
            </div>
            <div class="actions">
                <button type="submit" name="update" id="profile_submit" class="btn disabled">
                    <span>تحديث</span>
                    <i class="fas fa-retweet"></i>
                </button>
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

            // التحقق مما إذا كانت الصورة قد تم رفعها
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // تأكد من الحصول على اسم الملف
                $original_image_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];

                // إنشاء اسم بسيط للصورة باستخدام uniqid
                $image_extension = pathinfo($original_image_name, PATHINFO_EXTENSION); // الحصول على امتداد الصورة
                $image = uniqid() . '.' . $image_extension; // اسم فريد

                $upload_director = './upload/';
                // التأكد من وجود المجلد، إذا لم يكن موجودًا، يتم إنشاؤه
                if (!is_dir($upload_director)) {
                    mkdir($upload_director, 0755, true);
                }

                // نقل الملف المرفوع إلى المجلد المحدد
                move_uploaded_file($tmp_name, $upload_director . $image);

                // تحديث قاعدة البيانات مع الصورة
                $query = "UPDATE users SET username='$username', email='$email', image='$image' WHERE id='$user_id'";
            } else {
                $user_image = $user['image'];
                // تحديث قاعدة البيانات بدون تغيير الصورة
                $query = "UPDATE users SET username='$username', email='$email', image='$user_image' WHERE id='$user_id'";
            }

            $result = mysqli_query($connect, $query);

            if ($result) {
                setFlashMessage('success', 'تم التحديث بنجاح.');
            } else {
                setFlashMessage('error', 'لم يتم التحديث بنجاح.');
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

?>

<script src="<?= $js . 'script.js' ?>"></script>