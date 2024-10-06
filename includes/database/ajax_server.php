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

    $data = json_decode(file_get_contents('php://input'), true);
    $retirement_age = isset($data['retirement_age']) ? floatval($data['retirement_age']) : 0;
    $user_age = isset($data['user_age']) ? floatval($data['user_age']) : 0;
    $debts_and_expenses = isset($data['debts_and_expenses']) ? floatval($data['debts_and_expenses']) : 0;
    $monthly_income = isset($data['monthly_income']) ? floatval($data['monthly_income']) : 0;
    $retirement_goal = isset($data['retirement_goal']) ? floatval($data['retirement_goal']) : 0;

    if ($retirement_age <= 0 || $user_age <= 0 || $debts_and_expenses <= 0 || $monthly_income <= 0 || $retirement_goal <= 0) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'retirement_age' => $retirement_age,
        'user_age' => $user_age,
        'monthly_income' => $monthly_income,
        'debts_and_expenses' => $debts_and_expenses,
        'retirement_goal' => $retirement_goal,
        'user_id' => $_SESSION['user_id']
    ];

    $row = insertRows('retirement_plan', $data);

    if ($row == true) {
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

    $data = json_decode(file_get_contents('php://input'), true);
    $debt_goal = isset($data['debt_goal']) ? trim($data['debt_goal']) : '';
    $expenses = isset($data['expenses']) ? floatval($data['expenses']) : 0;
    $monthly_payment = isset($data['monthly_payment']) ? floatval($data['monthly_payment']) : 0;
    $duration = isset($data['duration']) ? floatval($data['duration']) : 0;

    // التحقق من القيم المدخلة
    if (empty($debt_goal) || $expenses <= 0 || $monthly_payment < 0 || $duration < 0) {
        sendErrorResponse('كل الحقول يجب أن تكون صحيحة');
    }

    $data = [
        'debt_goal' => $debt_goal,
        'expenses' => $expenses,
        'monthly_payment' => $monthly_payment,
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
    global $connect;

    $data = json_decode(file_get_contents('php://input'), true);
    $monthly_income = isset($data['monthly_income1']) ? floatval($data['monthly_income1']) : 0;
    $expenses = isset($data['expenses']) ? json_decode($data['expenses'], true) : [];
    $total_expenses = isset($data['total_expenses']) ? floatval($data['total_expenses']) : 0;
    $selling_goal = isset($data['selling_goal']) ? floatval($data['selling_goal']) : 0;
    $budget_goal = isset($data['budget_goal']) ? trim($data['budget_goal']) : '';
    $goal_date = isset($data['goal_date']) ? intval($data['goal_date']) : 0;

    // تحقق من صحة البيانات
    if ($monthly_income <= 0 || empty($expenses) || $total_expenses <= 0 || $selling_goal <= 0 || empty($budget_goal) || $goal_date < 0) {
        sendErrorResponse('البيانات غير صالحة');
    }

    $user_id = $_SESSION['user_id'];
    $user_retirement_plan = selectRows('*', 'retirement_plan', "user_id=$user_id", '', '1');

    $data = [
        'monthly_income' => $monthly_income,
        'expenses' => json_encode($expenses),
        'total_expenses' => $total_expenses,
        'net_income' => $user_retirement_plan['monthly_income'] - $total_expenses,
        'selling_goal' => $selling_goal,
        'budget_goal' => $budget_goal,
        'goal_date' => $goal_date,
        'user_id' => $_SESSION['user_id']
    ];

    $row = insertRows('budgets', $data);

    if ($row) {
        $message = ['status' => 'success', 'message' => 'لقد تم إعداد الميزانية.'];
    } else {
        sendErrorResponse('فشل الإنشاء: ' . mysqli_error($connect));
    }

    header('Content-Type: application/json');
    echo json_encode($message);
    exit();
}

function handleRegister()
{
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

    // إعداد البيانات
    $data = [
        'username' => $username,
        'email' => $email,
        'password' => sha1($password),
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
