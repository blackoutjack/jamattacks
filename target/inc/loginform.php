<?php

$errors = array();

$referer = false;
if (isset($_REQUEST['referer'])) {
  $referer = $_REQUEST['referer'];
}
$requesturi = $_SERVER['REQUEST_URI'];
if (substr($requesturi, 0, 1) === '/') {
  $requesturi = substr($requesturi, 1);
}
$action = TGTHOST.$requesturi;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        
        if ($referer !== false) {
          header('Location: '.$referer);
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

include(INCDIR.'header.php');
?>
<h1><?=isset($logintitle) ? htmlspecialchars($logintitle) : "Target Server Login"?></h1>
<p id="error">
<?=implode('<br/>', $errors)?>
</p>
<?
if ($loggedin) {
?>
<form name="logout" method="post" action="<?=$action?>">
<input class="btn" name="logout" type="submit" value="Log Out"></input>
</form>
<?
} else {
?>
<form name="login" method="post" action="<?=$action?>">
<div class="label">
<label for="username">Username:</label>
</div>
<input class="field" id="username" name="username" type="text"></input>
<br/>
<div class="label">
<label for="password">Password:</label>
</div>
<input class="field" id="password" name="password" type="password"></input>
<br/>
<?
if ($referer !== false) {
?>
<input name="referer" type="hidden" value="<?=htmlspecialchars($referer)?>"></input>
<?
}
?>
<input class="btn" name="login" type="submit" value="Log in"></input>
<br/>
</form>
<?
}
include(INCDIR.'footer.php');
?>
