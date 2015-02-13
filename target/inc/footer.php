<br/>
<br/>
<br/>
<div id="links">
<?
if (isset($links) && is_array($links)) {
  foreach ($links as $linktext => $linkurl) {
?>
<a href="<?=$linkurl?>"><?=$linktext?></a> |
<?
  }
}
?>
<a href="<?=TGTHOST?>home">home</a>
</div><!-- /links -->
</div><!-- /outer -->
</body>
</html>
