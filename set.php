<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php
//create session
session_start();

//connect to the database
include("connect.php");

$playerdata = mysql_query("SELECT brucies FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysql_fetch_array($playerdata);

$bruciesaysdata = mysql_query("SELECT bruciesays FROM bruciesays ORDER BY RAND() LIMIT 1");

$bruciesaysrow = mysql_fetch_array($bruciesaysdata);

if ($bruciesaysrow['bruciesays'] == "")
{
    $bruciesays = "Nothing to say yet!";
}
else
{
    $bruciesays = $bruciesaysrow['bruciesays'];
}

include("title");

if ($_GET["team1"] == "")
	$team1 = "Unknown";
else
	$team1 = $_GET["team1"];

if ($_GET["team2"] == "")
	$team2 = "Unknown";
else
	$team2 = $_GET["team2"];
echo "<form name=\"set\" action=\"processset.php?game=" . $_GET["game"] . "&player=" . $_GET["player"] . "\" method=\"post\">";
echo "Brucie Says: " . $bruciesays;
echo "<br>";
echo "<br>";
echo "Enter your prediction for " . $team1 . " v " . $team2;
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"score1\" size=\"2\" />";
echo "-";
echo "<input type=\"text\" name=\"score2\" size=\"2\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"checkbox\" name=\"brucie\" value=\"brucie\"> Brucie Bonus";
echo "<br>";
echo "<br>";
echo "You have " . $playerrow['brucies'] . " Brucies left. Don't forget to use them all by the end of the month!";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
