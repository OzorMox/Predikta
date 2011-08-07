<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>

<?php

include("title");

echo "Logged in as <b>" . $_GET["username"] . "</b>";
echo "<br>";
echo "<br>";

if ($_GET["warn"] == "yes")
{
	echo "Warning: You are using the default password";
	echo "<br>";
	echo "<br>";
	echo "<a href=password.php title=\"Change your password now\">Change Password</a>";
	echo "<br>";
	echo "<br>";
}

?>

<a href="index.php">Continue</a>

</center>
</body>

</html>
