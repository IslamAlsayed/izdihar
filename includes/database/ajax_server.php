<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';

$message = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        if ($requestType == 'plan') {
            handleRetirementPlan();
        } elseif ($requestType == 'debt') {
            handleDebt();
        } elseif ($requestType == 'budget') {
            handleBudget();
        } elseif ($requestType == 'register') {
            handleRegister();
        } elseif ($requestType == 'signin') {
            handleSignin();
        } else {
            sendErrorResponse('طلب غير معروف.');
        }
    } else {
        sendErrorResponse('طلب غير معروف.');
    }
}

function handleRetirementPlan()
{
    global $message;

    $retirement_age = isset($_POST['retirement_age']) ? floatval($_POST['retirement_age']) : 0;
    $user_old = isset($_POST['user_old']) ? floatval($_POST['user_old']) : 0;
    $monthly_amount = isset($_POST['monthly_amount']) ? floatval($_POST['monthly_amount']) : 0;
    $goal_retirement = isset($_POST['goal_retirement']) ? floatval($_POST['goal_retirement']) : 0;
    $goal_type = isset($_POST['goal_type']) ? trim($_POST['goal_type']) : '';

    if ($retirement_age <= 0 || $user_old <= 0 || $monthly_amount <= 0 || $goal_retirement <= 0 || empty($goal_type)) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'retirement_age' => $retirement_age,
        'user_old' => $user_old,
        'monthly_amount' => $monthly_amount,
        'goal_retirement' => $goal_retirement,
        'goal_type' => $goal_type,
        'user_id' => $_SESSION['user_id']
    ];

    $row = insertRows('retirement_plan', $data);

    if ($row) {
        $_SESSION['plan_details'] = 'yes';
        $message = ['status' => 'success', 'message' => 'تم إعداد خطة التقاعد.'];
    } else {
        sendErrorResponse('فشل الإنشاء.');
    }

    echo json_encode($message);
    exit();
}

function handleDebt()
{
    global $message;

    $debt_type = isset($_POST['debt_type']) ? trim($_POST['debt_type']) : '';
    $debt_amount = isset($_POST['debt_amount']) ? floatval($_POST['debt_amount']) : 0;
    $debt_monthly = isset($_POST['debt_monthly']) ? floatval($_POST['debt_monthly']) : 0;
    $duration = isset($_POST['duration']) ? floatval($_POST['duration']) : 0;

    if (empty($debt_type) || $debt_amount <= 0) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'debt_type' => $debt_type,
        'debt_amount' => $debt_amount,
        'debt_monthly' => $debt_monthly,
        'duration' => $duration,
        'user_id' => $_SESSION['user_id'],
    ];

    $row = insertRows('debts', $data);

    if ($row) {
        $message = ['status' => 'success', 'message' => 'لقد تم إعداد دينك.'];
    } else {
        sendErrorResponse('فشل في إنشاء الدين.');
    }

    echo json_encode($message);
    exit();
}

function handleBudget()
{
    global $message;

    $monthly_amount = isset($_POST['monthly_amount']) ? floatval($_POST['monthly_amount']) : 0;
    $expenses = isset($_POST['expenses']) ? floatval($_POST['expenses']) : 0;
    // $goal_type = isset($_POST['goal_type']) ? trim($_POST['goal_type']) : '';
    $goal_amount = isset($_POST['goal_amount']) ? floatval($_POST['goal_amount']) : 0;
    $duration = isset($_POST['duration']) ? intval($_POST['duration']) : 0;

    // تحقق من صحة البيانات
    if ($monthly_amount <= 0 || $expenses < 0 || $goal_amount <= 0 || $duration <= 0) {
        sendErrorResponse('البيانات غير صالحة');
    }

    // حساب الدخل الصافي
    $netIncome = $monthly_amount - $expenses;
    $current_amount = 0;

    // تأكد من أن الدخل الصافي موجب
    if ($netIncome > 0) {
        while ($current_amount < $goal_amount) {
            $current_amount += $netIncome;

            // إذا كنت ترغب في وضع حد لحساب المبلغ الحالي، يمكنك إضافة شرط هنا
            if ($current_amount >= $goal_amount) {
                break;
            }
        }
    }

    // يمكنك الاحتفاظ بمبلغ الدخل الصافي كقيمة نهائية إذا كنت تحتاج لذلك
    $current_amount = min($current_amount, $goal_amount); // التأكد من أن current_amount لا يتجاوز الهدف

    while ($current_amount < $goal_amount) {
        $current_amount += $netIncome;
    }

    $data = [
        'monthly_amount' => $monthly_amount,
        'expenses' => $expenses,
        'target_amount' => $goal_amount,
        'duration' => $duration,
        'currency' => $_SESSION['currency'],
        'user_id' => $_SESSION['user_id']
    ];

    $row = insertRows('budget', $data);

    if ($row) {
        $message = ['status' => 'success', 'message' => 'لقد تم إعداد الميزانية.'];
    } else {
        sendErrorResponse('فشل الإنشاء.');
    }

    echo json_encode($message);
    exit();
}

function handleRegister()
{
    global $message;

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $password_confirmation = isset($_POST['password_confirmation']) ? trim($_POST['password_confirmation']) : '';
    $currency = isset($_POST['currency']) ? trim($_POST['currency']) : '';

    // التحقق من صحة البيانات
    if (empty($username) || empty($email) || empty($password) || empty($password_confirmation)) {
        sendErrorResponse('البيانات غير صالحة');
    }

    if ($password !== $password_confirmation) {
        sendErrorResponse('كلمة المرور وتأكيد كلمة المرور لا تتطابقان.');
    }

    // إعداد البيانات
    $data = [
        'username' => $username,
        'email' => $email,
        'password' => sha1($password),
        'currency' => $currency,
    ];

    $row = insertRows('users', $data);

    if ($row) {
        $message = ['status' => 'success', 'message' => 'لقد تم إنشاء الحساب بنجاح.'];
    } else {
        sendErrorResponse('فشل الإنشاء.');
    }

    echo json_encode($message);
    exit();
}

function handleSignin()
{
    global $connect;
    global $message;

    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

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
            $_SESSION['currency'] = 'SAR';
            $message = ['status' => 'success', 'message' => 'لقد تم إنشاء الحساب بنجاح.'];
            echo json_encode($message);
            exit();
        }
    } else {
        $message = ['status' => 'error', 'message' => 'البريد الإلكتروني أو كلمة المرور عير صحيحة!'];
        echo json_encode($message);
        exit();
    }
}

function sendErrorResponse($errorMessage)
{
    $message = ['status' => 'error', 'message' => $errorMessage];
    echo json_encode($message);
    exit();
}
