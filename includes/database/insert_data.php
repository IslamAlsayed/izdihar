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
    $debts_and_expenses = isset($_POST['debts_and_expenses']) ? floatval($_POST['debts_and_expenses']) : 0;
    $goal_retirement = isset($_POST['goal_retirement']) ? floatval($_POST['goal_retirement']) : 0;

    if ($retirement_age <= 0 || $user_old <= 0 || $monthly_amount <= 0 || $goal_retirement <= 0) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'retirement_age' => $retirement_age,
        'user_old' => $user_old,
        'monthly_amount' => $monthly_amount,
        'debts_and_expenses' => $debts_and_expenses,
        'goal_retirement' => $goal_retirement,
        'user_id' => $_SESSION['user_id']
    ];

    $row = insertRows('retirement_plan', $data);

    if ($row) {
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

    if (empty($debt_type) || $debt_amount <= 0 || $debt_monthly <= 0 || $duration <= 0) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'debt_type' => $debt_type,
        'debt_amount' => $debt_amount,
        'debt_monthly' => $debt_monthly,
        'duration' => $duration,
        'user_id' => $_SESSION['user_id'],
    ];

    $row = insertRows('debt', $data);

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

    $monthly_income = isset($_POST['monthly_income']) ? floatval($_POST['monthly_income']) : 0;
    $expenses = isset($_POST['expenses']) ? floatval($_POST['expenses']) : 0;
    $goal_type = isset($_POST['goal_type']) ? trim($_POST['goal_type']) : '';
    $goal_amount = isset($_POST['goal_amount']) ? floatval($_POST['goal_amount']) : 0;
    $duration = isset($_POST['duration']) ? floatval($_POST['duration']) : 0;

    if ($monthly_income <= 0 || $expenses < 0 || $goal_type <= 0 || $goal_amount <= 0 || $duration <= 0) {
        sendErrorResponse('البيانات غير صالحة');
    }

    $netIncome = $monthly_income - $expenses;

    $current_amount = 0;

    while ($current_amount < $goal_amount) {
        $current_amount += $netIncome;
    }

    $data = [
        'current_amount' => $current_amount,
        'monthly_income' => $monthly_income,
        'expenses' => $expenses,
        'net_income' => $netIncome,
        'target_type' => $goal_type,
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

function sendErrorResponse($errorMessage)
{
    $message = ['status' => 'error', 'message' => $errorMessage];
    echo json_encode($message);
    exit();
}
