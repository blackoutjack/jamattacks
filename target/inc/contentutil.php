<?

function ValidateEmail($str) {
  if ($str == '') {
    return false;
  }
  $regEmail = '/^[\w|\.]+@\w+[\.\w+]+$/';
  if (!preg_match($regEmail, $str)) {
    return false;
  }
  return true;
}

function LoadParam($name, &$params, $default=null) {
  $val = isset($params[$name]) ? $params[$name] : $default;
  return $val;
}

// Escape values to embed in JavaScript strings.
function StrEscape($text, $quote='"') {
  $text = str_replace('\\', '\\\\', $text);
  $text = str_replace($quote, "\\$quote", $text);
  $text = str_replace("\n", '\\n', $text);
  $text = str_replace("\r", '\\r', $text);
  return $text;
}

// Escape values to embed in HTML attributes.
function AttrEscape($text, $quote='"') {
  $text = str_replace('\\', '\\\\', $text);
  $text = str_replace($quote, "\\$quote", $text);
  return $text;
}

function SQLEscape($text) {
  return mysql_real_escape_string($text);
}

// Encode a value for use in X(HT)ML. If $breaks is true, replace line
// breaks with XHTML <br/> tags.
function XMLEncode($text, $breaks=false) {
  $text = htmlspecialchars($text);
  if ($breaks) {
    $text = str_replace("\n", '<br/>', $text);
  }
  return $text;
}

?>
