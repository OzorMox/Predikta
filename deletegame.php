<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title"); ?>

<?php

echo "Delete this game?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<form name=\"deletegame\" action=\"processdeletegame.php?game=" . $_GET["game"] . "\" method=\"post\">";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
