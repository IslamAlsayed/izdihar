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
        } elseif ($requestType == 'edit') {
            handleEdit($id);
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

        $query = "UPDATE `debts` SET `expenses`='$expenses', `created_at` = DATE_ADD(`created_at`, INTERVAL 1 MONTH) WHERE `id`='$id'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $check = "SELECT *,SUM(expenses) as total_expenses FROM `debts` WHERE `id`='$id'";
            $result = mysqli_query($connect, $check);
            $debt = mysqli_fetch_assoc($result);
            sendSuccessResponse($debt, 'تم الدفع بنجاح.');
        } else {
            sendErrorResponse('لم يتم التحقق.');
        }
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

function handleEdit($id) {}

function sendSuccessResponse($data, $message)
{
    $response = '';
    if ($data != null) {
        $response = ['status' => 'success', 'data' => $data, 'message' => $message];
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
