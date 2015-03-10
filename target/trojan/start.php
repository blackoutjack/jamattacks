<?php
include('../declare.php');
include(INCDIR.'contentutil.php');

$title = "Attack pattern prototype: Trojan";
include(INCDIR.'header.php');

// Get a list of attack payloads from the malicious server.
$mal = curl_init();
curl_setopt($mal, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($mal, CURLOPT_RETURNTRANSFER, TRUE); 
curl_setopt($mal, CURLOPT_COOKIESESSION, TRUE); 
curl_setopt($mal, CURLOPT_HEADER, FALSE); 
curl_setopt($mal, CURLOPT_COOKIEFILE, 'cookiefile'); 
curl_setopt($mal, CURLOPT_COOKIEJAR, 'cookiefile'); 
curl_setopt($mal, CURLOPT_COOKIE, session_name().'='.session_id()); 
curl_setopt($mal, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($mal, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
curl_setopt($mal, CURLOPT_URL, MALROOT.'trojan/scriptindex'); 

// Closing the session is necessary when testing on a local server that
// hosts both the target and malicious sites.
session_write_close();
$xml = curl_exec($mal);
session_start();

$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadXML($xml);
$pllist = $doc->getElementsByTagName('payload');

?>
<h1>Trojan</h1>
<p class="instructions">
The links below each specify a different attack payload to be included
along with a legitimate application (which is always the same).
</p>

<?
// Output a link for each obfuscation of each payload.
for ($i=0; $i<$pllist->length; $i++) {
  $plnode = $pllist->item($i);
  $pl = $plnode->getAttribute('name');
?>
<h3 id="<?=AttrEscape($pl)?>" ><?=XMLEncode($pl)?></h3>
<?
  $comtags = $plnode->getElementsByTagName('comment');
  $comment = $comtags->length > 0 ? $comtags->item(0)->nodeValue : null;
  if ($comment !== null) {
?>
<p class="comment"><?=XMLEncode($comment)?></p>
<?
  }
  $obfus = $plnode->getElementsByTagName('obfuscation');
  for ($j=0; $j<$obfus->length; $j++) {
    $obnode = $obfus->item($j);
    $ob = $obnode->getAttribute('name');
?>
| <a href="<?=TGTROOT?>trojan/app?payload=<?=AttrEscape(urlencode($pl))?>&obfu=<?=AttrEscape(urlencode($ob))?>"><?=XMLEncode($ob)?></a>
<?
  }
}

$links = array(
  'attack' => TGTROOT."trojan/app",
);
include(INCDIR.'footer.php');
?>
