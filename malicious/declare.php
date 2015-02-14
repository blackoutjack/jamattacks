<?php

session_start();

$hostname = $_SERVER['HTTP_HOST'];
if ($hostname == 'policy-weaving.cs.wisc.edu') {
  define('MALHOST', 'http://blackoutjack.com/malicious/');
  define('TGTHOST', 'https://policy-weaving.cs.wisc.edu/target/');
} else {
  define('MALHOST', 'http://malicious/');
  define('TGTHOST', 'http://target/');
}

define('INCDIR', $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR);
?>
