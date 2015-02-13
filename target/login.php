<?php
include "declare.php";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ok = true;
  if (isset($_POST['login'])) {
    if (!isset($_POST['username'])) {
      $errors[] = "No username provided<br/>";
      $ok = false;
    }
    if (!isset($_POST['password'])) {
      $errors[] = "No password provided<br/>";
      $ok = false;
    }
    if ($ok) {
      $usr = $_POST['username'];
      $usrsql = mysql_real_escape_string($usr); 
      $pwdsql = mysql_real_escape_string(sha1($_POST['password']));

      $res = mysql_query("SELECT uid, admin FROM users WHERE name='$usrsql' AND password='$pwdsql'");
      $cnt = mysql_num_rows($res);
      if ($cnt == 1) {
        list($uid, $admin) = mysql_fetch_row($res);
        $_SESSION['user'] = $uid;
        $_SESSION['username'] = $usr;
        $_SESSION['admin'] = $admin;
        
        if (isset($_POST['referer'])) {
          header('Location: '.$_POST['referer']);
          exit;
        }
      } else if ($cnt > 1) {
        $errors[] = "Corrupt user database, unable to login";
      } else {
        $errors[] = "Invalid login info";
      }
    }
  }
}
$loggedin = false;
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['user']);
  unset($_SESSION['username']);
  unset($_SESSION['admin']);
  $errors[] = "Logged out";
} else if (isset($_SESSION['user'])) {
  $loggedin = true;
  $errors[] = "Logged in as ".$_SESSION['username'];
}

$action = TGTHOST."login";

?>
<html>
<head>
<title>Target Website Login</title>
<link rel="stylesheet" href="style.css"></link>
</head>
<body>
<p id="error">
<?=implode('<br/>', $errors)?>
</p>
<?
if ($loggedin) {
?>
<form name="logout" method="post" action="<?=$action?>">
<input name="logout" type="submit" value="Log Out"></input>
</form>
<?
} else {
?>
<form name="login" method="post" action="<?=$action?>">
<label for="username">Username:</label>
<input id="username" name="username" type="text"></input>
<br/>
<label for="password">Password:</label>
<input id="password" name="password" type="password"></input>
<br/>
<?
if (isset($_REQUEST['referer'])) {
?>
<input name="referer" type="hidden" value="<?=htmlentities($_REQUEST['referer'])?>"></input>
<?
}
?>
<input name="login" type="submit" value="Log In"></input>
<br/>
</form>
<?
}
if (isset($_REQUEST['referer'])) {
?>
<a href="<?=htmlentities($_REQUEST['referer'])?>">back</a> |
<?
}
?>
<a href="<?=TGTHOST?>home">target server home</a>
</body>
</html>
