<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "Unlock " . $_GET["game1"] . " v " . $_GET["game2"] . "?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<form name=\"unlock\" action=\"processunlock.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
