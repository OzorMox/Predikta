<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title"); ?>

<?php

echo "<form name=\"setbrucies\" action=\"processsetbrucies.php?player=" . $_GET["player"] . "\" method=\"post\">";
echo "Enter the number of Brucie Bonuses to add for this player";
echo "<br>";
echo "A negative number will remove Brucies";
echo "<br>";
echo "<br>";
echo "Mark the checkbox to reset this player's Brucie Bonuses back to zero";
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
