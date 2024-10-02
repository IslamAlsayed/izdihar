<?php
include './connect.php';
include './includes/functions/helpers.php';
session_start();

if (isset($_SESSION['user_id'])) {
    setFlashMessage('success', 'تم تسجيل الخروج بنحاح.');

    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    header('Location: ./');
    exit();
} else {
    setFlashMessage('error', 'لم يتم تسحيل الخروج.');

    header('Location: ./');
    exit();
}
