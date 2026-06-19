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

echo "<form name=\"date\" action=\"processdate.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "Change the date for " . $team1 . " v " . $team2;
echo "<br>";
echo "<br>";
$dateValue = isset($_GET['date']) ? date('Y-m-d', strtotime($_GET['date'])) : date('Y-m-d');
$timeValue = isset($_GET['date']) ? date('H:i', strtotime($_GET['date'])) : '12:00';
echo '<input type="date" name="date" value="' . htmlspecialchars($dateValue) . '" /> ';
echo '<input type="time" name="time" value="' . htmlspecialchars($timeValue) . '" step="1800" />';
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
