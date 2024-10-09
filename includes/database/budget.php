<?php
session_start();
include '../../connect.php';
include '../../includes/database/database.php';
$message = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['request'])) {
        $requestType = $_GET['request'];
        if ($requestType == 'insert' || $requestType == 'update') {
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
            if ($requestType == 'insert') {
                $row = insertRows('budgets', $data);
            } else if ($requestType == 'update') {
                $user_id = $_SESSION['user_id'];
                $row = updateRows('budgets', $data, ["user_id='$user_id'"]);
            }

            if ($row == true) {
                $message = ['status' => 'success', 'message' => $requestType == 'insert' ? 'تم إعداد الميزانية.' : 'تم تحديث الميزانية.'];
            } else {
                sendErrorResponse($requestType == 'insert' ? 'فشل الإنشاء.' : 'فشل التحديث.');
            }

            header('Content-Type: application/json');
            echo json_encode($message);
            exit();
        } elseif ($requestType == 'delete') {
            $id = $_POST['id'];
            global $connect;
            global $response;
            $user_id = $_SESSION['user_id'];

            // الحذف من ال database
            $deleteQuery = "DELETE FROM `budgets` WHERE `id`='$id' AND `user_id`='$user_id'";
            $result = mysqli_query($connect, $deleteQuery);

            if ($result) {
                $response = ['status' => 'success', 'message' => 'تم الحذف بنجاح.'];
            } else {
                $response = ['status' => 'error', 'message' => 'لم يتم الحذف.'];
            }

            echo json_encode($response);
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
