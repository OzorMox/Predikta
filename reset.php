<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "<form name=\"reset\" action=\"processreset.php\" method=\"post\">";
echo "Warning: All fixtures and messages will be deleted and all points will be reset to zero";
echo "<br>";
echo "<br>";
echo "Select the competition type";
echo "<br>";
echo "<br>";
echo "<table style=\"border-style:none;\">";
echo "<tr>";
echo "<td style=\"border-style:none;\"><input type=\"radio\" name=\"competition\" value=\"league\" checked=\"checked\"></td><td style=\"border-style:none;\">League</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"border-style:none;\"><input type=\"radio\" name=\"competition\" value=\"cup\"></td><td style=\"border-style:none;\">Cup</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
