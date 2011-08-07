<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title");

if ($_GET["game1"] == "")
	$game1 = "Unknown";
else
	$game1 = $_GET["game1"];

if ($_GET["game2"] == "")
	$game2 = "Unknown";
else
	$game2 = $_GET["game2"];
echo "<form name=\"set\" action=\"processset.php?game=" . $_GET["game"] . "&player=" . $_GET["player"] . "\" method=\"post\">";
echo "Enter your prediction for " . $game1 . " v " . $game2;
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
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
