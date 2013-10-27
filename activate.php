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

echo "<form name=\"set\" action=\"processactivate.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "Enter the actual score for " . $team1 . " v " . $team2;
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"score1\" size=\"2\" />";
echo "-";
echo "<input type=\"text\" name=\"score2\" size=\"2\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
