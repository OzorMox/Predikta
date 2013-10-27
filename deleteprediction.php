<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

//connect to the database
include("connect.php");

include("title");

if ($_GET["team1"] == "")
	$team1 = "Unknown";
else
	$team1 = $_GET["team1"];

if ($_GET["team2"] == "")
	$team2 = "Unknown";
else
	$team2 = $_GET["team2"];

echo "<form name=\"deleteprediction\" action=\"processdeletepred.php?game=" . $_GET["game"] . "&player=" . $_GET["player"] . "&team1=" . $_GET["team1"] . "&team2=" . $_GET["team2"] . "\" method=\"post\">";
echo "Delete your prediction for " . $team1 . " v " . $team2 . "?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm, you will then be prompted to enter a new prediction";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
