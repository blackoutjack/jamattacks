<?php
include('../declare.php');

$errors = array();

if (isset($_POST['deleteall']) && $_POST['deleteall']) {
  mysql_query("DELETE FROM stored WHERE 1");
}
if (isset($_POST['delete']) && $_POST['delete']) {
  foreach ($_POST as $name => $del) {
    if (strpos($name, 'chk') === 0) {
      $id = substr($name, 3);
      if (is_numeric($id)) {
        mysql_query("DELETE FROM stored WHERE id=$id");
        $errors[] = "Deleted value ".$id;
      } else {
        $errors[] = "Unexpected checkbox name: ".$name;
      }
    }
  }
}

$values = array();
$valueres = mysql_query("SELECT id, session, value FROM stored WHERE 1 ORDER BY id");
if ($valueres) {
  while ($vals = mysql_fetch_assoc($valueres)) {
    $values[] = $vals;
  }
}

$title = "Attack pattern prototypes: Stored XSS";
include(INCDIR.'header.php');
?>
<h1>Private session information</h1>
<?
if (sizeof($errors) > 0) {
?>
<p id="error"><?=implode('<br/>', array_map('htmlspecialchars', $errors))?></p>
<?
}
?>
<form action="">
<input type="text" name="value" value="Input value here"></input>
<input type="submit" value="Submit"></input>
</form>
<p id="session">Session id: <?=session_id()?></p>
Here is a list of previously submitted values:
<form method="post" action="view">
<ul>
<input type="submit" name="delete" value="Remove checked"></input>
<input type="submit" name="deleteall" value="Remove all"></input>
<?
foreach ($values as $vals) {
?>
<li>
  <input type="checkbox" name="chk<?=$vals['id']?>" ></input>
  <?=$vals['id']?>
  <br/>raw: <?=$vals['value']?>
  <br/>safe: <?=htmlspecialchars($vals['value'])?>
</li>
<?
}
?>
</ul>
</form>
<?
$links = array(
  'stored XSS start' => TGTROOT.'stored/start',
);
include(INCDIR.'footer.php');
?>
