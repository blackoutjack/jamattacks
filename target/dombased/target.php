<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototypes: DOM-based XSS</title>
</head>
<body>
<h1>Private session information</h1>
<p id="session">Session id: <?=session_id()?></p>
<script type="text/javascript">
var name = window.name;
document.write("window.name: " + name);
</script>
</body>
</html>
