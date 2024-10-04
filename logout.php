<?php
include './connect.php';
include './includes/functions/helpers.php';
session_start();

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();

    setFlashMessage('success', 'تم تسجيل الخروج بنحاح.');
    header('Location: ./');
    exit();
} else {
    setFlashMessage('error', 'لم يتم تسحيل الخروج.');

    header('Location: ./home.php');
    exit();
}
