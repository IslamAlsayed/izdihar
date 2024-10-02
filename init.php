<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'connect.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$database  = 'includes/database/';
$functions  = 'includes/functions/';
$templates  = 'includes/templates/';

$css        = 'layout/css/';
$js         = 'layout/js/';
$image      = 'layout/downloads/images/';
$education  = 'layout/downloads/education/';
$article  = 'layout/downloads/education/articles/';
$avatar     = 'layout/downloads/avatars/';
$logo       = 'layout/downloads/logo/';

include $functions . 'helpers.php';
include $database . 'database.php';
include $templates . 'header.php';

if (!isset($noNavbar)) {
    include $templates . 'navbar.php';
}

$site = selectRows('*', 'site', '', '', '1');
