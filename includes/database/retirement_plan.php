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
            if ($requestType == 'insert') {
                $row = insertRows('retirement_plan', $data);
            } else if ($requestType == 'update') {
                $user_id = $_SESSION['user_id'];
                $row = updateRows('retirement_plan', $data, ["user_id='$user_id'"]);
            }

            if ($row) {
                $message = ['status' => 'success', 'message' => $requestType == 'insert' ? 'تم تخزين خطة التقاعد.' : 'تم تحديث خطة التقاعد.'];
            } else {
                sendErrorResponse($requestType == 'insert' ? 'فشل الإنشاء.' : 'فشل التحديث.');
            }

            echo json_encode($message);
            exit();
        } elseif ($requestType == 'delete') {
            $id = $_POST['id'];
            global $connect;
            global $response;
            $user_id = $_SESSION['user_id'];

            // الحذف من ال database
            $deleteQuery = "DELETE FROM `retirement_plan` WHERE `id`='$id' AND `user_id`='$user_id'";
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
