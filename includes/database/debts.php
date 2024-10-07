<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';

$message = ['status' => '', 'message' => ''];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        $id = $_POST['id'];
        if ($requestType == 'check') {
            handleCheck($id);
        } elseif ($requestType == 'trash') {
            handleTrash($id);
        } else {
            sendErrorResponse('طلب غير معروف.');
        }
    } else {
        sendErrorResponse('طلب غير معروف.');
    }
}

function handleCheck($id)
{
    global $connect;

    $check = "SELECT * FROM `debts` WHERE `id`='$id'";
    $result = mysqli_query($connect, $check);
    $debt = mysqli_fetch_assoc($result);

    if ($debt) {
        $expenses = $debt['expenses'] - $debt['monthly_payment'];

        // حساب القسط المتبقي
        $rest_division = $debt['expenses'] % $debt['monthly_payment'];
        $installment = $rest_division > 0 ? $rest_division : $debt['monthly_payment'];

        // تحديث الميزانية
        updateBudgetAfterDebtDeletion($installment, $_SESSION['user_id']);

        usleep(500); // تأخير بسيط

        // تحديث بيانات الدين
        $query = "UPDATE `debts` SET `expenses`='$expenses', `created_at` = DATE_ADD(`created_at`, INTERVAL 1 MONTH) WHERE `id`='$id'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            sendSuccessResponse($expenses, 'تم الدفع بنجاح.');
        } else {
            sendErrorResponse('لم يتم التحقق.');
        }
    } else {
        sendErrorResponse('لم يتم العثور على الدين.');
    }
}

function handleTrash($id)
{
    global $connect;
    $user_id = $_SESSION['user_id'];

    // حذف الدين
    $deleteQuery = "DELETE FROM `debts` WHERE `id`='$id' AND `user_id`='$user_id'";
    $result = mysqli_query($connect, $deleteQuery);

    if ($result) {
        sendSuccessResponse(null, 'تم حذف الدين بنجاح.');
    } else {
        $response = ['status' => 'error', 'message' => 'لم يتم الحذف.'];
    }

    echo json_encode($response);
    exit();
}

function updateBudgetAfterDebtDeletion($rest_division, $user_id)
{
    // استرجاع الميزانية الحالية
    $user_budget = selectRows('*', 'budgets', "user_id=$user_id", '', '1');

    if ($user_budget) {
        // تحديث الديون في الميزانية
        $new_expenses = json_decode($user_budget['expenses'], true);
        $new_expenses['debts'] += intval($rest_division); // تحديث الديون في الميزانية
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

function sendSuccessResponse($expenses, $message)
{
    $response = '';
    if ($expenses != null) {
        $response = ['status' => 'success', 'data' => ['expenses' => $expenses], 'message' => $message];
    } else {
        $response = ['status' => 'success', 'message' => $message];
    }
    echo json_encode($response);
    exit();
}

function sendErrorResponse($errorMessage)
{
    $message = ['status' => 'error', 'message' => $errorMessage];
    echo json_encode($message);
    exit();
}
