<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

if ($_GET["team1"] == "")
	$team1 = "Unknown";
else
	$team1 = $_GET["team1"];

if ($_GET["team2"] == "")
	$team2 = "Unknown";
else
	$team2 = $_GET["team2"];

echo "<form name=\"deleteactual\" action=\"processdeleteact.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "Delete the actual score for " . $team1 . " v " . $team2 . "?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
