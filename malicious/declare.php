<?php

session_start();

$hostname = $_SERVER['HTTP_HOST'];
if ($hostname === 'blackoutjack.com' || $hostname === 'www.blackoutjack.com') {
  define('MALHOST', 'http://blackoutjack.com/malicious/');
  define('TGTHOST', 'https://policy-weaving.cs.wisc.edu/target/');

  define('INCDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'malicious', 'inc', '')));
} else {
  define('MALHOST', 'http://malicious/');
  define('TGTHOST', 'http://target/');

  define('INCDIR', implode(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'inc', '')));
}

?>
