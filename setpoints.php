<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "<form name=\"setpoints\" action=\"processsetpoints.php?player=" . $_GET["player"] . "&month=" . $_GET["month"] . "\" method=\"post\">";
echo "Enter the points this player has for this month";
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"points\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
