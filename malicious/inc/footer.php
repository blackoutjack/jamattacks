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
<a href="<?=TGTROOT?>home">target server home</a>
</div><!-- /links -->
</div><!-- /outer -->
</body>
</html>
