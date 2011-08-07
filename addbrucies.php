<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title"); ?>

<?php

echo "<form name=\"addbrucies\" action=\"processaddbrucies.php\" method=\"post\">";
echo "Enter the number of Brucie Bonuses to add for all players";
echo "<br>";
echo "<br>";
echo "Mark the checkbox to reset all Brucie Bonuses back to zero";
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"brucies\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"checkbox\" name=\"reset\" value=\"reset\"> Reset";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
