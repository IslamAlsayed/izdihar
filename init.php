<?php
session_start();
include 'connect.php';

$database   = 'includes/database/';
$functions  = 'includes/functions/';
$templates  = 'includes/templates/';

$css        = 'layout/css/';
$js         = 'layout/js/';
$image      = 'layout/downloads/images/';
$upload     = 'upload/';
$education  = 'layout/downloads/education/';
$article    = 'layout/downloads/education/articles/';
$logo       = 'layout/downloads/logo/';

include $functions . 'helpers.php';
include $database . 'database.php';
include $templates . 'header.php';

if (!isset($noNavbar)) {
    include $templates . 'navbar.php';
}

$site = selectRows('*', 'site', '', '', '1');
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user = selectRows('*', 'users', "id='$user_id'", '', '1');

$user_plan = [];
if ($user_id) {
    $user_plan = selectRows('*', 'retirement_plan', "user_id='$user_id'", '', '1');
}