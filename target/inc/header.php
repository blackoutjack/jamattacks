<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
<meta charset="UTF-8">
<title><?=isset($title) ? $title : $_SERVER['REQUEST_URI']?></title>
<link rel="stylesheet" href="<?=TGTROOT?>style.css"></link>
<?=isset($header) ? $header : ''?>
</head>
<body>
<div id="outer">
