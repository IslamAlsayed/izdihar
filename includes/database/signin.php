<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';
$message = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        if ($requestType == 'signin') {
            global $connect;
            global $message;

            $data = json_decode(file_get_contents('php://input'), true);
            $email = isset($data['email']) ? trim($data['email']) : '';
            $password = isset($data['password']) ? trim($data['password']) : '';

            // التحقق من صحة البيانات
            if (empty($email) || empty($password)) {
                sendErrorResponse('البيانات غير صالحة');
            }

            $hashPassword = sha1($password);

            $check = "SELECT * FROM `users` WHERE email='$email' AND password='$hashPassword'";
            $result = mysqli_query($connect, $check);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if ($user) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];
                    $message = ['status' => 'success', 'message' => 'لقد تم تسجيل الدخول بنجاح.'];
                    echo json_encode($message);
                    exit();
                }
            } else {
                $message = ['status' => 'error', 'message' => 'البريد الإلكتروني أو كلمة المرور عير صحيحة!'];
                echo json_encode($message);
                exit();
            }
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
