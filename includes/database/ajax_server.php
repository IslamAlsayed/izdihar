<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';

$message = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        $id = $_POST['id'] ?? null;
        if ($requestType == 'plan_insert' || $requestType == 'plan_update') {
            handleRetirementPlan($requestType);
        } elseif ($requestType == 'trash_plan') {
            handleTrash('retirement_plan', $id);
        } elseif ($requestType == 'budget_insert' || $requestType == 'budget_update') {
            handleBudget($requestType);
        } elseif ($requestType == 'trash_budget') {
            handleTrash('budgets', $id);
        } elseif ($requestType == 'debt') {
            handleDebt();
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

function handleRetirementPlan($requestType)
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

    $row = '';
    if ($requestType == 'plan_insert') {
        $row = insertRows('retirement_plan', $data);
    } else if ($requestType == 'plan_update') {
        $user_id = $_SESSION['user_id'];
        $row = updateRows('retirement_plan', $data, ["user_id='$user_id'"]);
    }

    if ($row) {
        $message = ['status' => 'success', 'message' => $requestType == 'plan_insert' ? 'تم إعداد خطة التقاعد.' : 'تم تحديث خطة التقاعد.'];
    } else {
        sendErrorResponse($requestType == 'plan_insert' ? 'فشل الإنشاء.' : 'فشل التحديث.');
    }

    echo json_encode($message);
    exit();
}

function handleTrash($table, $id)
{
    global $connect;
    global $response;
    $user_id = $_SESSION['user_id'];
    // الحذف من ال database
    $deleteQuery = "DELETE FROM `$table` WHERE `id`='$id' AND `user_id`='$user_id'";
    $result = mysqli_query($connect, $deleteQuery);

    if ($result) {
        $response = ['status' => 'success', 'message' => 'تم الحذف بنجاح.'];
    } else {
        $response = ['status' => 'error', 'message' => 'لم يتم الحذف.'];
    }

    echo json_encode($response);
    exit();
}

function handleBudget($requestType)
{
    global $message;

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

    $data = [
        'monthly_income' => $monthly_income,
        'expenses' => json_encode($expenses),
        'total_expenses' => $total_expenses,
        'net_income' => $monthly_income - $total_expenses,
        'selling_goal' => $selling_goal,
        'budget_goal' => $budget_goal,
        'goal_date' => $goal_date,
        'user_id' => $_SESSION['user_id']
    ];

    $row = '';
    if ($requestType == 'budget_insert') {
        $row = insertRows('budgets', $data);
    } else if ($requestType == 'budget_update') {
        $user_id = $_SESSION['user_id'];
        $row = updateRows('budgets', $data, ["user_id='$user_id'"]);
    }

    if ($row) {
        $message = ['status' => 'success', 'message' => $requestType == 'budget_insert' ? 'تم إعداد الميزانية.' : 'تم تحديث الميزانية.'];
    } else {
        sendErrorResponse($requestType == 'budget_insert' ? 'فشل الإنشاء.' : 'فشل التحديث.');
    }

    header('Content-Type: application/json');
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

    $user_id = $_SESSION['user_id'];

    $data = [
        'debt_goal' => $debt_goal,
        'expenses' => $expenses,
        'monthly_payment' => $monthly_payment,
        'duration' => $duration,
        'user_id' => $_SESSION['user_id'],
    ];

    $row = insertRows('debts', $data);

    usleep(500);
    // تحديث الميزانية بعد انشاء الدين
    updateBudgetAfterDebtDeletion($user_id);

    if ($row) {
        $message = ['status' => 'success', 'message' => 'لقد تم إعداد دينك.'];
    } else {
        sendErrorResponse('فشل في إنشاء الدين.');
    }

    echo json_encode($message);
    exit();
}

function updateBudgetAfterDebtDeletion($user_id)
{
    // استرجاع الميزانية الحالية
    $user_budget = selectRows('*', 'budgets', "user_id=$user_id", '', '1');
    $user_debts = selectRows('*', 'debts', "user_id=$user_id", '', '*');

    $total_monthly_payment = 0;
    foreach ($user_debts as $debt) {
        $total_monthly_payment += $debt['monthly_payment'];
    }

    if ($user_budget) {
        // تحديث الديون في الميزانية
        $new_expenses = json_decode($user_budget['expenses'], true);
        $new_expenses['debts'] = $total_monthly_payment; // تحديث الديون في الميزانية
        $new_expenses_json = json_encode($new_expenses);

        // حساب اجمالي الديون والمصروفات
        $total_expenses = array_sum($new_expenses);
        $net_income = $user_budget['monthly_income'] - $total_expenses;

        $goal_date = ceil($user_budget['selling_goal'] / $net_income);

        // تحديث اجمالي المصروفات في الميزانية
        $update_data = [
            'expenses' => $new_expenses_json,
            'total_expenses' => $total_expenses,
            'net_income' => $net_income,
            'goal_date' => $goal_date,
        ];

        // تحديث البيانات
        $budget = updateRows('budgets', $update_data, ["user_id=$user_id"]);

        if (!$budget) {
            sendErrorResponse('فشل في تحديث الميزانية بعد حذف الدين.');
        }
    } else {
        sendErrorResponse('لم يتم العثور على الميزانية.');
    }
}

function handleRegister()
{
    global $connect;
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
