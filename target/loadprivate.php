<?php
include('declare.php');

// Allow access by any user.
if (isset($_SESSION['user'])) {
  $filepath = realpath(PRIVATEDIR.$_REQUEST['resource']);
  if ($filepath && strpos($filepath, PRIVATEDIR) === 0) {
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    readfile($filepath);
    exit;
  }
}
header('HTTP/1.0 404 Not Found');
