<?php

$errors = array();

$referer = LoadParam('referer', $_REQUEST);
$requesturi = LoadParam('REQUEST_URI', $_SERVER, '');
if (substr($requesturi, 0, 1) === '/') {
  $requesturi = substr($requesturi, 1);
}
$action = TGTHOST.$requesturi;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ok = true;
  $login = LoadParam('login', $_POST);
  if ($login !== null) {
    $usr = LoadParam('username', $_POST);
    if ($usr === null) {
      $errors[] = "No username provided<br/>";
      $ok = false;
    }
    $pwd = LoadParam('password', $_POST);
    if ($pwd === null) {
      $errors[] = "No password provided<br/>";
      $ok = false;
    }
    if ($ok) {
      $usrsql = SQLEscape($usr); 
      $pwdsql = SQLEscape(sha1($pwd));

      $res = mysql_query("SELECT uid, admin FROM users WHERE name='$usrsql' AND password='$pwdsql'");
      $cnt = mysql_num_rows($res);
      if ($cnt == 1) {
        list($uid, $admin) = mysql_fetch_row($res);
        $_SESSION['user'] = $uid;
        $_SESSION['username'] = $usr;
        $_SESSION['admin'] = $admin;
        
        if ($referer !== null) {
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
$logout = LoadParam('logout', $_REQUEST);
if ($logout !== null) {
  unset($_SESSION['user']);
  unset($_SESSION['username']);
  unset($_SESSION['admin']);
  $errors[] = "Logged out";
} else if (isset($_SESSION['user'])) {
  $loggedin = true;
  $errors[] = "Logged in as ".$_SESSION['username'];
}

?>
<h1><?=isset($logintitle) ? XMLEncode($logintitle) : "Target Server Login"?></h1>
<?
if (sizeof($errors) > 0) {
?>
<p id="error">
<?=implode('<br/>', $errors)?>
</p>
<?
}
if ($loggedin) {
?>
<form name="logout" method="post" action="<?=$action?>">
<input class="btn" name="logout" type="submit" value="Log Out"></input>
</form>
<?
} else {
?>
<form name="login" method="post" action="<?=AttrEscape($action)?>">
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
if ($referer !== null) {
?>
<input name="referer" type="hidden" value="<?=AttrEscape($referer)?>"></input>
<?
}
?>
<input class="btn" name="login" type="submit" value="Log in"></input>
<br/>
</form>
<?
}
?>
