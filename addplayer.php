<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title"); ?>

<?php

echo "<form name=\"addplayer\" action=\"processaddplayer.php\" method=\"post\">";
echo "Enter the name of the new player";
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"player\" />";
echo "<br>";
echo "<br>";
echo "Enter starting Brucie Bonuses";
echo "<br>";
echo "<br>";
echo "<input type=\"text\" name=\"brucies\" value=\"0\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
