<?php

session_start();

$hostname = $_SERVER['HTTP_HOST'];
if ($hostname === 'policy-weaving.cs.wisc.edu') {
  define('MALHOST', 'http://blackoutjack.com/malicious/');
  define('TGTHOST', 'https://policy-weaving.cs.wisc.edu/target/');
  if (mysql_connect("mysql.cs.wisc.edu", "policy_weaver", "crash")) {
    mysql_select_db("policy_weaving");
  }

  define('INCDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'target', 'inc', '')));
} else {
  define('MALHOST', 'http://malicious/');
  define('TGTHOST', 'http://target/');
  if (mysql_connect("localhost", "storer", "crash")) {
    mysql_select_db("target");
  }

  define('INCDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'inc', '')));
}


?>
