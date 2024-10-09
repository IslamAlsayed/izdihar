<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';
$message = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        if ($requestType == 'register') {
            global $message;

            $data = json_decode(file_get_contents('php://input'), true);
            $username = isset($data['username']) ? trim($data['username']) : '';
            $email = isset($data['email']) ? trim($data['email']) : '';
            $password = isset($data['password']) ? trim($data['password']) : '';
            $password_confirmation = isset($data['password_confirmation']) ? trim($data['password_confirmation']) : '';

            // التحقق من صحة البيانات
            if (empty($username) || empty($email) || empty($password) || empty($password_confirmation)) {
                sendErrorResponse('البيانات غير صالحة');
            }

            if ($password !== $password_confirmation) {
                sendErrorResponse('كلمة المرور وتأكيد كلمة المرور لا تتطابقان.');
            }

            // التحقق من وجود البريد الإلكتروني
            $email = mysqli_real_escape_string($connect, $email);
            $check = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($connect, $check);

            if ($result && mysqli_num_rows($result) > 0) {
                sendErrorResponse('هذا البريد الإلكتروني مستخدم.');
            }

            // إعداد البيانات
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => sha1($password),
            ];

            $row = insertRows('users', $data);

            if ($row == true) {
                $message = ['status' => 'success', 'message' => 'لقد تم إنشاء الحساب بنجاح.'];
            } else {
                sendErrorResponse('فشل الإنشاء.');
            }

            echo json_encode($message);
            exit();
        } else {
            sendErrorResponse('طلب غير معروف.');
        }
    } else {
        sendErrorResponse('طلب غير معروف.');
    }
}

function sendErrorResponse($errorMessage)
{
    $message = ['status' => 'error', 'message' => $errorMessage];
    echo json_encode($message);
    exit();
}
