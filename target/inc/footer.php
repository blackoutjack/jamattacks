<br/>
<br/>
<br/>
<div id="links">
<?
if (isset($links) && is_array($links)) {
  foreach ($links as $linktext => $linkurl) {
?>
<a href="<?=htmlspecialchars($linkurl)?>"><?=htmlspecialchars($linktext)?></a> |
<?
  }
}
?>
<a href="<?=TGTHOST?>home">home</a>
</div><!-- /links -->
</div><!-- /outer -->
</body>
</html>
