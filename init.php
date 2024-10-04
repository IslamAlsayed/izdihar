<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
$avatar     = 'layout/downloads/avatars/';
$logo       = 'layout/downloads/logo/';

include $functions . 'helpers.php';
include $database . 'database.php';
include $templates . 'header.php';

if (!isset($noNavbar)) {
    include $templates . 'navbar.php';
}

$site = selectRows('*', 'site', '', '', '1');
$user_id = isset($_SESSION['user_id']);
$user = selectRows('*', 'users', "id='$user_id'", '', '1');

$user_plan = [];
if ($user_id) selectRows('*', 'retirement_plan', "user_id='$user_id'", '', '1');

if ($user_plan) {
    echo $user_plan['user_id'];
}
