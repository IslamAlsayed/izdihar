<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'izdihar';

try {
  $connect = mysqli_connect($host, $user, $password, $database);
  // echo 'You Is Connect Is Database';
} catch (PDOException $error) {
  echo 'You Is Not Connect Is Database.. ' . $error->getMessage();
}
