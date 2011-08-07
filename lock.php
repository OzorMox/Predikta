<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

if ($_GET["game1"] == "")
	$game1 = "Unknown";
else
	$game1 = $_GET["game1"];

if ($_GET["game2"] == "")
	$game2 = "Unknown";
else
	$game2 = $_GET["game2"];

echo "Lock " . $game1 . " v " . $game2 . "?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<form name=\"lock\" action=\"processlock.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
