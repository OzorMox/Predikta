<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "Warning: All fixtures with results set will be deleted and Brucies reset after updating the points for " . $_GET["month"];
echo "<br>";
echo "<br>";
echo "Brucie Says: THIS ACTION CANNOT BE UNDONE!";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<form name=\"updatepoints\" action=\"processupdate.php?month=" . $_GET["month"] . "\" method=\"post\">";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
