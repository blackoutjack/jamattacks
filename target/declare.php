<?php

session_start();

$hostname = $_SERVER['HTTP_HOST'];
if ($hostname === 'policy-weaving.cs.wisc.edu') {
  define('MALHOST', 'http://blackoutjack.com/');
  define('TGTHOST', 'https://policy-weaving.cs.wisc.edu/');
  define('MALROOT', MALHOST.'malicious/');
  define('TGTROOT', TGTHOST.'target/');
  // Use HostMonster's SSL certificate when necessary.
  define('MALALTROOT', 'https://host167.hostmonster.com/~blackou1/malicious/');
  if (mysql_connect('mysql.cs.wisc.edu', 'policy_weaver', 'crash')) {
    mysql_select_db('policy_weaving');
  }

  define('ROOTDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'target', '')));

} else if ($hostname === 'target') {
  define('MALHOST', 'http://malicious/');
  define('TGTHOST', 'http://target/');
  define('MALROOT', MALHOST);
  define('TGTROOT', TGTHOST);
  define('MALALTROOT', MALROOT);
  if (mysql_connect('localhost', 'storer', 'crash')) {
    mysql_select_db('target');
  }

  define('ROOTDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], '')));

} else {
  echo('Unexpected host name: '.htmlspecialchars($hostname));
  exit;
}

define('INCDIR', ROOTDIR.'inc'.DIRECTORY_SEPARATOR);
define('PRIVATEDIR', ROOTDIR.'prv'.DIRECTORY_SEPARATOR);

?>
