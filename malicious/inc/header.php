<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?=isset($title) ? $title : $_SERVER['REQUEST_URI']?></title>
<link rel="stylesheet" href="<?=MALROOT?>style.css"></link>
<?=isset($header) ? $header : ''?>
</head>
<body>
<div id="outer">
