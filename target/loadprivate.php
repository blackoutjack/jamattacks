<?php
include('declare.php');

$loggedin = false;
if (!isset($_SESSION['user'])) {
  header('Location: /home');
  exit;
}
$privpath = realpath('prv');
$filepath = realpath($privpath.DIRECTORY_SEPARATOR.$_REQUEST['resource']);
if ($filepath && strpos($privpath, $filepath) == 0) {
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  readfile($filepath);
} else {
  header("HTTP/1.0 404 Not Found");
}
