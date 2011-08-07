<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>

<?php

include("title");

if ($_GET["error"] == "")
	echo "Error: Unspecified";
else
	echo "Error: " . $_GET["error"];

?>

<br>
<br>
<a href="index.php">Back</a>

</center>
</body>

</html>
