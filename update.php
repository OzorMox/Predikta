<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "Warning: All fixtures will be deleted after updating the points for the selected month";
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
