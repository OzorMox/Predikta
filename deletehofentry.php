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

echo "<form name=\"deletehofentry\" action=\"processdeletehof.php?entry=" . $_GET["entry"] . "\" method=\"post\">";
echo "Delete this hall of fame entry?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"halloffame.php\">Back</a>";

?>

</center>
</body>

</html>
